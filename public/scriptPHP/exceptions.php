<?php

require SCRIPTPHPPATH. DIRECTORY_SEPARATOR.'objets/myException.class.php';

function throwmyException($message = null,$code = null) {
		throw new Exception($message,$code);
}

/************************EXEMPLE UTILISATION ************ DO NOT SEND !

ob_start();
    try {
    	try {
    	$contents = @file_get_contents($url, $use_include_path, $context, $offset) OR throwmyException();
    	} catch ( Exception $theOriginalZendException) {
    		
    		
    		/*  Bizarrement cette portion de code me sort 1 : buffer et Exceptions ne sont pas compatibles ?
    		  
    		ob_start();
    		echo $theOriginalZendException;
    		$stacktraceZendException = ob_end_flush();
    		
    		$stacktrace_tab = explode(' ',$stacktraceZendException);
    		$cheminAcacher = $stacktrace_tab[4];
    		$derniereValeurAafficher = count($cheminAcacher);
    		$stacktrace[$i] = "*********--*********_(M)_**********--***********".$cheminAcacher[$derniereValeurAafficher];
    		$i = 5;
    		while ( isset($stacktrace[$i]) && $stacktrace_tab[$i] != NULL ){
    			if($stacktrace_tab[$i] == "#".$i)	$flag = $i + 1;
    			if($flag == $i){
    				$cheminAcacher = explode ('/',$stacktrace_tab[$i]);
    				$derniereValeurAafficher = count($cheminAcacher);
    				$stacktrace[$i] = "*********--*********_(M)_**********--***********".$cheminAcacher[$derniereValeurAafficher];
    			}
    			++$i;
    		}
    		$theOriginalZendException = implode(' ',$stacktrace_tab);
    		
    		*/
    		/*
    		
    		echo "<table><tr><td><p>".$theOriginalZendException."</p></td></tr><table>";
    		throw new myException($message,$code);
    	}
    } catch (myException $e ) {
			ob_end_clean();
    	//$e->traceLaSondeEcho();
    	$contents = "";
		}
		
		*/
		