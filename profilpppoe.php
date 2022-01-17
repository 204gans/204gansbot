<?php
require('conn.php');
$userhotspot = $API->comm('/ppp/profile/print');
$json = json_encode($userhotspot);
$result = json_decode($json, true);
// echo $json;
foreach ($result as $data) {
    echo 'Profil : '. $data['name'] . '</br>';
}
$API->disconnect();
