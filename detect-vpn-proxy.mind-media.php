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


// ignore the French Internet Providers
if ( getBooleanFAI($_SERVER["REMOTE_ADDR"]) == false ) {

	$ip = gethostbyname($_SERVER["REMOTE_ADDR"]);
	 $ch = curl_init();
	 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 curl_setopt($ch, CURLOPT_URL, 'https://blackbox.ipinfo.app/lookup/'.$ip);
	 $result = curl_exec($ch);
	 curl_close($ch);

	if($result == 'N'){
	 echo "IP résidentielle / non classifiée (c'est-à-dire Safe IP)";
	}
	else if($result == 'Y'){
	 echo "Détection d'un VPN ou PROXY ou VPS ou Serveur dédié ou hébergeur hosting...";
	}
	else {
	 echo "Connexion inconnue";
	}

}
?>
