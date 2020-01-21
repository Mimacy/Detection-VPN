<?php

$ip = gethostbyname($_SERVER["REMOTE_ADDR"]);
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_URL, 'http://check.getipintel.net/check.php?ip='.$ip.'&contact=AdresseEmail@VotreDomaine.com');
 $result = curl_exec($ch);
 curl_close($ch);

if($result == '0'){
 echo "IP résidentielle / non classifiée (c'est-à-dire Safe IP)";
}
else if($result == '1'){
 echo "Détection d'un VPN ou PROXY ou VPS ou Serveur dédié ou hébergeur hosting...";
}
else {
 echo "Connexion inconnue";
}
?>
