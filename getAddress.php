<?php
require_once './functions.php';
$oldWallet = getWallet();


if(isset($_GET['hisAddress'])){
    $hisAddress=trim($_GET['hisAddress']);
    if (validate($hisAddress)){
        $ourAddress = $oldWallet->getaddressesbyaccount("hisAddress=".$hisAddress)[0];
        if (trim($ourAddress)=="" || !validate($ourAddress, false)){
            try{
                if ($walletpassphrase_old!="") $oldWallet->walletpassphrase($walletpassphrase_old,30);
    //            echo $newaddress = $wallet->getaccountaddress("");
    //            print_r($wallet->getaddressesbyaccount(""));
    //            6Jpr3q6xzim6HG5GWCYjpMjima9BfBbCVm
                $result = "ok";
                $ourAddress = $oldWallet->getnewaddress("hisAddress=".$hisAddress);
                if ($walletpassphrase_old!="") $oldWallet->walletlock();
            } catch (Exception $e) {
                $result = "norpc";
                //TODO send mail.
            }
        } else {
            $result = 'ok';
        }
    } else {
        $result = 'notValid';
    }
} else $result = 'firstTime';