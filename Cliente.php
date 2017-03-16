<?php
	//cliente.php

	include('lib/nusoap.php');
	
	$cliente = new nusoap_client('http://localhost/Mercadinho/Servidor.php?wsdl');

	//$parametros = array('cod_barras'=>106, 'produto'=>'coca-cola');

	//$resultado = $cliente->call('cadastra', $parametros);

	$parametros = array('id'=>4);

	$resultado = $cliente->call('lista', $parametros);
	echo utf8_encode($resultado);
?>