<?php
ini_set('max_execution_time', 0);
ini_set('memory_limit', -1);
set_time_limit(0);
define(IP_ADDRES, "INSERT YOU MACHINE IP ADDRES");
if(isset($_GET['min_range']) and isset($_GET['max_range']) and isset($_GET['ip'])){
    $min_range = $_GET['min_range'];
    $max_range = $_GET['max_range'];
    $ip_scan = $_GET['ip'];
    if(is_null($max_range) or is_null($min_range) or is_null($ip_scan) or $ip_scan == 'localhost' or $ip_scan == '127.0.0.1' or $ip_scan == 'unix://' or $ip_scan == IP_ADDRES){
    echo 'Value null';
    }else{
     //scanner
        while($min_range <= $max_range){
            $start = @fsockopen($ip_scan, $min_range, $errno, $errstr, 2);
            if(is_resource($start)){
            echo '<h2>' . $ip_scan . ':' . $min_range . ' ' . '(' . getservbyport($min_range, 'tcp') . ') The port is open!.</h2>' . "\n";
            }else{
                echo '<h2>' . $ip_scan . ':' . $min_range . ' Not results.</h2>' . "\n";
            }
            $min_range++;
        }
    }
}

/* Created by giuliadev */
/* admin@zgiuly.info for bug */

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Port scanner</title
</head>
<body>
    
</body>
</html>