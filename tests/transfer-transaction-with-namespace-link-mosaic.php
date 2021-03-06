<?php
    require "vendor/autoload.php";

    use Proximax\Model\Transaction\TransferTransaction;
    use Proximax\Model\Deadline;
    use Proximax\Model\Address;
    use Proximax\Model\Message;
    use Proximax\Model\Mosaic;
    use Proximax\Model\Account;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Model\NamespaceId;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.107:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $deadline = new Deadline(1); //1 is time include blockchain, unit hour
    $address = new Address("SCTSYT3SPBID36GQDZRC3E4XOUQGIGF5CGQVZYMV", $networkType);
    $namespaceId = new NamespaceId(array(3020295898,2840468446));
    $mosaic = new Mosaic($namespaceId,10);
    $message = new Message("Hello world");

    $generationHash = "7B631D803F912B00DC0CBED3014BBD17A302BA50B99D233B9C2D9533B842ABDF";

    $transfer = new TransferTransaction($deadline,$address,array($mosaic),$message,$networkType);

    $account = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);
    
    $signed = $account->sign($transfer,$generationHash);
    var_dump($signed);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signed);
    
    
?>