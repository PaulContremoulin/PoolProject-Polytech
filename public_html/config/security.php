<?php

class Security{
		
	private static $seed = 'coltazekhan3'; //chaine à concaténer
	
	public static function getSeed() {  //getter de la chaine à concaténer
		return self::$seed;
	}
	
	public static function chiffrer($mdp_en_clair) {
	  $mdp_crypte = $mdp_en_clair . Security::getSeed();
	  $mdp_crypte = hash('sha256', $mdp_en_clair);
	  return $mdp_crypte;
	}

	public static function generateRandomHex() {
		// Generate a 32 digits hexadecimal number
		$numbytes = 16; // Because 32 digits hexadecimal = 16 bytes
		$bytes = openssl_random_pseudo_bytes($numbytes); 
		$hex   = bin2hex($bytes);
		return $hex;
	}
}
?>
