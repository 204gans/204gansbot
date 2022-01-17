<?php
header("Content-Type:application/json");
require('conn.php');

if(!empty($_GET['profil']))
{
    $profil=$_GET['profil'];

    function generateRandomString($length = 25) {
        $characters = '123456789abcdefghijklmnpqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    $myRandomString = generateRandomString(7);
define('SERVER', 'all');
define('COMMENT', 'vc-BotVoucher');
define('PROFILE', "$profil");
{
    // Data user dan password hotspot
    $user = array(1 => array('name' => "$myRandomString", 'password' => "$myRandomString"),
                  );
 
    foreach($user as $tmp)
    {
        $username="=name=";
        $username.=$tmp['name'];
 
        $pass="=password=";
        $pass.=$tmp['password'];
 
        $server="=server=";
        $server.=SERVER;

        $comment="=comment=";
        $comment.=COMMENT;
 
        $profile="=profile=";
        $profile.=PROFILE;
 
        $API->write('/ip/hotspot/user/add',false);
        $API->write($username, false);
        $API->write($pass, false);
        $API->write($server, false);
        $API->write($comment, false);
        $API->write($profile);
 
        $READ = $API->read(false);
        $hasil = json_encode($READ);
        // echo $hasil;

        if ($hasil == '["!trap","=message=failure: already have user with this name for this server","!done"]') {
            echo "ERROR !!! USERNAME HOTSPOT INI SUDAH TERDAFTAR DI MIKROTIK ";
        } else if ($hasil == '["!trap","=message=input does not match any value of profile","!done"]') {
            echo "ERROR !!! PROFIL YANG DIMASUKAN SALAH !!!";
        } else {
            echo $myRandomString;
        }


    }
    $API->disconnect();
}
}	