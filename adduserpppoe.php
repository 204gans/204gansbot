<?php
header("Content-Type:application/json");
require('conn.php');

if(!empty($_GET['user']))
if(!empty($_GET['pw']))
if(!empty($_GET['profil']))
{
	$user=$_GET['user'];
	$pw=$_GET['pw'];
	$profil=$_GET['profil'];

define('SERVICE', 'pppoe');
define('COMMENT', 'By-Bot');
define('PROFILE', "$profil");
{
    // Data user dan password hotspot
    $user = array(1 => array('name' => "$user", 'password' => "$pw"),
                  );
 
    foreach($user as $tmp)
    {
        $username="=name=";
        $username.=$tmp['name'];
 
        $pass="=password=";
        $pass.=$tmp['password'];
 
        $service="=service=";
        $service.=SERVICE;

        $comment="=comment=";
        $comment.=COMMENT;
 
        $profile="=profile=";
        $profile.=PROFILE;
 
        $API->write('/ppp/secret/add',false);
        $API->write($username, false);
        $API->write($pass, false);
        $API->write($service, false);
        $API->write($comment, false);
        // $API->write($localaddress, false);
        // $API->write($remoteaddress, false);
        $API->write($profile);
 
        $READ = $API->read(false);
        $hasil = json_encode($READ);
        
        if ($hasil == '["!trap","=message=input does not match any value of profile","!done"]') {
            echo "ERROR !!! KESALAHAN PENULISAN PROFILE";
        } else if ($hasil == '["!trap","=message=failure: secret with the same name already exists","!done"]') {
            echo "ERROR !!! AKUN PPPOE SUDAH TERDAFTAR";
        } else {
            echo "SUKSES";
        }
    }
    $API->disconnect();
}
}