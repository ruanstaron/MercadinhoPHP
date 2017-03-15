<?php

	//servidor.php
	include('lib/nusoap.php');

	// instancia o servidor
	$servidor = new nusoap_server();

	//configura o wsdl
	$servidor->configureWSDL('urn:Servidor');
	$servidor->wsdl->schemaTargetNamespace = 'urn:Servidor';

	//função de teste
	function exemplo ($nome, $idade){
		return ($nome.' -> '.$idade);
	}

	//registrar a função no webservice
	$servidor->register(
			'exemplo',
			array('nome'=>'xsd:string',
					'idade'=>'xsd:int'),
			array('retorno'=>'xsd:string'),
			'urn:Servidor.exemplo',
			'urn:Servidor.exemplo',
			'rpc',
			'encoded',
			'Apenas um exemplo de webservice'
		);

	//capturar um dado que vem de uma requisição de cliente, primeiramente verifica se a variável $HTTP_RAW_POST_DATA existe.
	// $HTTP_RAW_POST_DATA = isset ($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$servidor->service(file_get_contents('php://input'));
?>