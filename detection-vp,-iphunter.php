<?php

function getBooleanFAI($ip) {
 $host = @gethostbyaddr($ip);
 $fai = false;
 if(substr_count($host, 'proxad')) $fai = true;
 if(substr_count($host, 'orange')) $fai = true;
 if(substr_count($host, 'wanadoo')) $fai = true;
 if(substr_count($host, 'sfr')) $fai = true;
 if(substr_count($host, 'club-internet')) $fai = true;
 if(substr_count($host, 'neuf')) $fai = true;
 if(substr_count($host, 'gaoland')) $fai = true;
 if(substr_count($host, 'bbox')) $fai = true;
 if(substr_count($host, 'bouyg')) $fai = true;
 if(substr_count($host, 'numericable')) $fai = true;
 if(substr_count($host, 'tele2')) $fai = true;
 if(substr_count($host, 'videotron')) $fai = true;
 if(substr_count($host, 'belgacom')) $fai = true;
 if(substr_count($host, 'bell.ca')) $fai = true;
 return $fai;
}


$ip = $_SERVER["REMOTE_ADDR"]; //-- IP à consulter

// ignore les FAIs
if ( getBooleanFAI($ip) == false ) {


	$apiKey = 'your_api_key'; // Votre clef API (inscription requise)

	$headers = [
		'X-Key: '.$apiKey,
	];
	$ch = curl_init("https://www.iphunter.info:8082/v1/ip/".$ip);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$output = json_decode(curl_exec($ch), 1);
	$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	 if($output['data']['block'] == 0){
	 	$block = "IP résidentielle / non classifiée (c'est-à-dire Safe IP)";
	 }
	 else if($output['data']['block'] == 1){
	 	$block = "Détection d'un VPN ou PROXY ou VPS ou Serveur dédié ou hébergeur hosting...";
	 }
	 else if($output['data']['block'] == 2){
	 	$block = "IP non résidentielle et résidentielle (avertissement, peut flagrant des personnes innocentes)";
	 }
	 else {
	 	$block = "Connexion inconnu";
	 }

	 echo $block;


}
