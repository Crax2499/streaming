<?php

class Conexion{
	static public function conectar(){
		$link = new PDO("mysql:host=localhost;dbname=favstream",
			            "favstream",
			            "7aLke0OMCZKk7fAcmr00");
		$link->exec("set names utf8");
		return $link;
	}
}