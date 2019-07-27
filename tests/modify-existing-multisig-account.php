<?php
    require "vendor/autoload.php";

    use NEM\Model\Deadline;
    use NEM\Model\Mosaic;
    use NEM\Model\Account;
    use NEM\Sdk\Transaction;
    use NEM\Model\Config;
    use NEM\Infrastructure\Network;
    use NEM\Model\MultisigCosignatoryModification;
    use NEM\Model\MultisigCosignatoryModificationType;
    use NEM\Model\Transaction\ModifyMultisigAccountTransaction;
    use NEM\Model\Transaction\AggregateTransaction;
    use NEM\Model\Transaction\LockFundsTransaction;
    use NEM\Model\Transaction\CosignatureTransaction;
    use NEM\Utils\Utils;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://bctestnet1.xpxsirius.io:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("PublicTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $multisigPublicKey = "E25F5E9B56973E53B7D1EE4017175A632D5E92807FA6615E9EA12498CE3DDAEB";
	// Cosignature public keys
	$cosignatoryOnePrivateKey      = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
	$cosignatoryTwoPrivateKey      = "B55478C892A6476760C5E77E443FE411F2D62B0F42496FC12EDB37F3306F8D69";
	$cosignatoryToRemovePublicKey = "952C2E8302D2C657BC96A6FC8D72018A55F8B521A3AFC7903C88023D92CEF205";
	// Minimal approval count
	$minimalApproval = -1;
	// Minimal removal count
    $minimalRemoval = -1;


    $multisigAccount = (new Account)->newAccountFromPublicKey($multisigPublicKey,$networkType);
    $cosignerOneAccount = (new Account)->newAccountFromPrivateKey($cosignatoryOnePrivateKey,$networkType);
    $cosignerTwoAccount = (new Account)->newAccountFromPrivateKey($cosignatoryTwoPrivateKey,$networkType);
    $cosignerRemoveAccount = (new Account)->newAccountFromPublicKey($cosignatoryToRemovePublicKey,$networkType);

    $deadline = new Deadline(1); //1 is time include blockchain, unit hour
    $multisigCosignatoryModifications = array(
        new MultisigCosignatoryModification(
            MultisigCosignatoryModificationType::REMOVE,
            $cosignerRemoveAccount
        )
    );

    $multisigTransaction = new ModifyMultisigAccountTransaction(
        new Deadline(1),
        $minimalApproval,
        $minimalRemoval,
        $multisigCosignatoryModifications,
        $networkType
    );

    $multisigTransaction->ToAggregate($multisigAccount);

    $aggregateBoundedTransaction = new AggregateTransaction(
        new Deadline(1),
        array($multisigTransaction),
        $networkType
    );
    $aggregateBoundedTransaction->createBonded();
    $signedAggregateBoundedTransaction = $cosignerOneAccount->sign($aggregateBoundedTransaction);

    $mosaic = new Mosaic("xpx",10000000); //deposit mosaic
    $duration = (new Utils)->fromBigInt(100);
    $lockFundsTrx = new LockFundsTransaction(
        new Deadline(1),
        $mosaic,
        $duration,
        $signedAggregateBoundedTransaction,
        $networkType
    );

    $signedTransaction = $cosignerOneAccount->sign($lockFundsTrx);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signedTransaction);
    sleep(30);// 30 seconds


    $transaction = new Transaction;
    $transaction->AnnounceAggregateBondedTransaction($config, $signedAggregateBoundedTransaction);
    sleep(30);// 30 seconds

    $signatureTwoCosignatureTransaction = new CosignatureTransaction($aggregateBoundedTransaction);
    $signatureTwoCosignatureTransaction->setHash($signedAggregateBoundedTransaction->getHash());
    $signedSignatureTwoCosignatureTransaction = $cosignerTwoAccount->signCosignatureTransaction($signatureTwoCosignatureTransaction);
    $transaction = new Transaction;
    $transaction->AnnounceAggregateBondedCosignatureTransaction($config, $signedSignatureTwoCosignatureTransaction);
    sleep(30);// 30 seconds

?>