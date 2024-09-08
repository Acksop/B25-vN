<?php

class Exceptions {
	public $logExceptions;
	
	public function __construct(){
		//The One Do On Nothing Else...
		//$this->logExceptions = new Array();
	}
	
	public function addException( myException $Exception ){
		$this->logExceptions[] = $Exception->getContenuDeClasse();
	}
	
	public function AfficheLeTraceur_des_exceptions(){
		//sortie HTML
		$i=0;
		echo "<p>";
		foreach($this->logExceptions as $exception){
			echo "b&eacute;mol-".$i;
			foreach($exception as $laCle=>$laValeur){
				echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;".$laCle."&#45;&#62;".$laValeur;
			}
			echo "<br />";
			++$i;
		}
		echo "</p>";
	}
	
	
}