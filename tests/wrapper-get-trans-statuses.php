<?php
    require "vendor/autoload.php";
    use NEM\Model\Config;
    use NEM\Sdk\Transaction;
    use NEM\Infrastructure\Network;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://bctestnet1.xpxsirius.io:3000";
    $wsReconnectionTimeout = 5000;
    $arr_hash = array("555C32CAECA8626A0DBB665CEB708F64C2BF7E8C8C4B6E5FB6FEA0C23EA13C94", "DB86BC55973059FFBFB4C55FD5D442984F45EFC2526C275A36B0946D529EDDE8");
    $netType = Network::getIdfromName("PublicTest");

    if ($netType){
        $config = $config->NewConfig($baseUrl,$netType,$wsReconnectionTimeout);
    }
    $Transaction = new Transaction;
    $transaction = $Transaction->GetTransactionsStatuses($config,$arr_hash);
    var_dump($transaction);
?>