<?php
	
	require 'config/config.php';
	session_start();
	
	function autoloader( $classe ){
		$classe = str_replace('\\', '/', $classe );
		#Model/Clientes.class.php || trat.php
		foreach ( array( 'class.php', 'trait.php' ) as $extensao ){
			if( file_exists( "app/$classe.$extensao" ) ){
				require_once "app/$classe.$extensao";
			}
		}
		
	}
	
	spl_autoload_register('autoloader');