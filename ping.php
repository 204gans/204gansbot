<?php
header("Content-Type:application/json");
require('conn.php');

if(!empty($_GET['ping']))
{
	$ping=$_GET['ping'];

define('ADDRESS', "${ping}");
{
        $address="=address=";
        $address.=ADDRESS;

        $API->write('/ping',false);
        $API->write($address,false); 
        $API->write('=count=10',false);
        $API->write('=interval=1'); 
        $READ = $API->read(false);
        $hasil = json_encode($READ);
        echo $hasil;
    $API->disconnect();
}
}