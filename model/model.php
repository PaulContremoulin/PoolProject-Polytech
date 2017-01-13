<?php

if (getenv("HTTP_HOST") == "localhost" || getenv("HTTP_HOST") == "127.0.0.1") {
	require_once "{$ROOT}{$DS}config{$DS}conflocal.php"; //ne jamais modifier
}else{
	require_once "{$ROOT}{$DS}config{$DS}conf.php"; //ne jamais modifier
}


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

	    $sql = "REPLACE INTO ".static::$table." VALUES(";
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

<<<<<<< HEAD

    public static function getAllOrder($att,$order){
	    $SQL="SELECT * FROM ".static::$table." ORDER BY ".$att." ".$order.";";
=======
	public static function getAll(){
	    $SQL="SELECT * FROM ".static::$table.";";
>>>>>>> 01ed49a1451c8bb9b1189a751e19b4daa2032d3e
	    try{
	 		$rep = Model::$pdo->query($SQL);
	    	$rep->setFetchMode(PDO::FETCH_CLASS, 'Model'.static::$table);
	    	return $rep->fetchAll();
	    } catch(PDOException $e) {
			if (Conf::getDebug()) {
				echo $e->getMessage(); // affiche un message d'erreur
			} else {
				echo 'Une erreur est survenue <a href="www.google.com"> retour a la page d\'accueil </a>';
			}
			die();
		}   
    }

<<<<<<< HEAD
	public static function getAll(){
	    $SQL="SELECT * FROM ".static::$table.";";
=======
    public static function getAllOrder($att,$order){
	    $SQL="SELECT * FROM ".static::$table." ORDER BY ".$att." ".$order.";";
>>>>>>> 01ed49a1451c8bb9b1189a751e19b4daa2032d3e
	    try{
	 		$rep = Model::$pdo->query($SQL);
	    	$rep->setFetchMode(PDO::FETCH_CLASS, 'Model'.static::$table);
	    	return $rep->fetchAll();
	    } catch(PDOException $e) {
			if (Conf::getDebug()) {
				echo $e->getMessage(); // affiche un message d'erreur
			} else {
				echo 'Une erreur est survenue <a href="www.google.com"> retour a la page d\'accueil </a>';
			}
			die();
		}   
    }
<<<<<<< HEAD

=======
>>>>>>> 01ed49a1451c8bb9b1189a751e19b4daa2032d3e

	function delete($para) {
	$sql = "DELETE FROM ".static::$table." WHERE ".static::$primary."=:nom_var";
	try{
	  $req_prep = Model::$pdo->prepare($sql);
	  $req_prep->bindParam(":nom_var", $para);
	  $req_prep->execute();
	  return 0;
	} catch(PDOException $e) {
	  if (Conf::getDebug()) {
	    echo $e->getMessage(); // affiche un message d'erreur
	  }
	  return -1;
	  die();
	}
	}

	function update($tab, $old) {
		$sql = "UPDATE ".static::$table." SET";
		foreach ($tab as $cle => $valeur){
			$sql .=" ".$cle."=:new".$cle.",";
		}
		$sql=rtrim($sql,",");
		$sql.=" WHERE ".static::$primary."=:oldid;";
		try{
		  $req_prep = Model::$pdo->prepare($sql);
		  $values = array();
		  foreach ($tab as $cle => $valeur){
		  		$values[":new".$cle] = $valeur;
		  }
		  $values[":oldid"] = $old;
		  $req_prep->execute($values);
		  $obj = Model::select($tab[static::$primary]);
		  return $obj;
		} catch(PDOException $e) {
		  if (Conf::getDebug()) {
		    echo "PROBLEME"; // affiche un message d'erreur
		  }
		  return -1;
		  die();
		}
	}

}

Model::Init();
?>
