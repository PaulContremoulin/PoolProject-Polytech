<?php
class Session {
    public static function is_user($login) {
    	/** is_user : char [] => bool
    	donnée : chaîne de caractère qui correspond au login
    	Résultat : renvoie True si le login est présent sur le serveur et que le login rentré correspond à celui stocké sur le serveur **/
        return (!empty($_SESSION['login']) && ($_SESSION['login'] == $login));
    }
    public static function is_admin() {
    	/** is_admin : => bool
    	Résultat : renvoie True si il s'agit d'un admin, false sinon **/
		return (!empty($_SESSION['admin']) && $_SESSION['admin']);
	}
}
?>
