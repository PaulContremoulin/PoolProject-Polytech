<?php
require_once "{$ROOT}{$DS}config{$DS}conf.php"; //ne jamais modifier

class Model{

	public static $pdo;

	public static function Init(){
		$host = Conf::getHostname();
		$dbname = Conf::getDatabase();
		$login = Conf::getLogin();
		$pass = Conf::getPassword();
		try{
			self::$pdo = new PDO("mysql:host=$host;dbname=$dbname",$login,$pass);
		} catch(PDOException $e) {
			echo $e->getMessage(); // affiche un message d'erreur
			die();
		}
	}

	public static function select($para) {

	    $sql = "SELECT * from ".static::$table." WHERE ".static::$primary."=:nom_var";

	    try{

	    	$req_prep = Model::$pdo->prepare($sql);
	    	$req_prep->bindParam(":nom_var", $para);
	    	$req_prep->execute();
	    	$req_prep->setFetchMode(PDO::FETCH_CLASS, 'Model'.static::$table);

	    	if($req_prep->rowCount()>0){
	    		$rslt = $req_prep->fetch();
	    	}else{
	    		$rslt = null;
	    	}

	  		return $rslt;

	  	} catch(PDOException $e) {

	  		echo $e->getMessage();

	  	}
  	}

  	public static function insert($tab){

	    $sql = "INSERT or REPLACE INTO ".static::$table." VALUES(";
	    foreach ($tab as $cle => $valeur){
			$sql .=" :".$cle.",";
		}
		$sql=rtrim($sql,",");
		$sql.=");";

	    try{
	    	$req_prep = Model::$pdo->prepare($sql);
	    	$values = array();
	    	foreach ($tab as $cle => $valeur){
	      		$values[":".$cle] = $valeur;
	    	}
	    	$req_prep->execute($values);
		}catch(PDOException $e) {
			echo $e->getMessage(); // affiche un message d'erreur
		}
  	}

}

Model::Init();

?>
