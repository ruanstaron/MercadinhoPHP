<?php
	//cliente.php

	include('lib/nusoap.php');
	
	$cliente = new nusoap_client('http://localhost/Mercadinho/Servidor.php?wsdl');

	$parametros = array('nome'=>'Ruan', 'idade'=>30);

	$resultado = $cliente->call('exemplo', $parametros);

	echo utf8_encode($resultado);
?>