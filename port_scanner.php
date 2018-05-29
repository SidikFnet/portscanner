<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Port scanner</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section class="scanned">
    <?php
ini_set('max_execution_time', 0);
ini_set('memory_limit', -1);
set_time_limit(0);
define(IP_ADDRES, "INSERT YOUR MACHINE IP ADDRES");
if(isset($_GET['min_range']) and isset($_GET['max_range']) and isset($_GET['ip'])){
    $min_range = $_GET['min_range'];
    $max_range = $_GET['max_range'];
    $ip_scan = $_GET['ip'];
    if(is_null($max_range) or is_null($min_range) or is_null($ip_scan) or $ip_scan == 'localhost' or $ip_scan == '127.0.0.1' or $ip_scan == 'unix://' or $ip_scan == IP_ADDRES){
    echo "<h1 id='error'>Value null</h1>";
    }else{
     //scanner
        if(file_exists("open0") or file_exists("closed0")){
            unlink("open0/list");
            unlink("closed0/list");
        }
        while($min_range <= $max_range){
            mkdir("open0");
            mkdir("closed0");
            $start = @fsockopen($ip_scan, $min_range, $errno, $errstr, 2);
            if(is_resource($start)){
                $p = getservbyport($min_range, 'tcp');
                file_put_contents("open0/list", "$ip_scan.PHP_EOL.$min_range.PHP_EOL.$p.",FILE_APPEND);
            }else{
                file_put_contents("closed0/list", $ip_scan." ".$min_range." Is closed"."\n",FILE_APPEND);
            }
            $min_range++;
        }
        echo "<h1 id='ok'>Scan completed!</h1>";
    }
}
?>
</section>
<footer><p>Made by &copy; <a id='a' href="https://zgiuly.info">zGiuly</a></p></footer>
</body>
</html>