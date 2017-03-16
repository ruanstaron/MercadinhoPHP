<?php

	//servidor.php
	include('lib/nusoap.php');
	
	// instancia o servidor
	$servidor = new nusoap_server();

	//configura o wsdl
	$servidor->configureWSDL('urn:Servidor');
	$servidor->wsdl->schemaTargetNamespace = 'urn:Servidor';

	//função de teste
	function cadastra ($cod_barras, $produto){
		$sql = "INSERT INTO produtos(cod_barras, produto) VALUES(".$cod_barras.",'".$produto."')";
		$resul = executaSql($sql);
		return $resul;
	}

	function lista ($id){
		$sql = "SELECT * FROM produtos WHERE id=".$id;
		$resul = executaSql($sql);
		$dados = $resul->fetch_array();
		return "id: ".$dados['id']." cod_barras: ".$dados['cod_barras']." Produto: ".$dados['produto'];
	}

	function executaSql($sql){
		$link = mysqli_connect("localhost", "root", "", "mercadinho");
		 
		if (!$link) {
		    return "error";
		}
		$query = $link->query($sql);
		 
		mysqli_close($link);
		return $query;
	}
	
	//registrar a função no webservice
	$servidor->register(
			'cadastra',
			array('cod_barras'=>'xsd:int',
					'produto'=>'xsd:string'),
			array('retorno'=>'xsd:string'),
			'urn:Servidor.cadastra',
			'urn:Servidor.cadastra',
			'rpc',
			'encoded',
			'Apenas um exemplo de webservice'
		);
	$servidor->register(
			'lista',
			array('id'=>'xsd:int'),
			array('retorno'=>'xsd:string'),
			'urn:Servidor.lista',
			'urn:Servidor.lista',
			'rpc',
			'encoded',
			'Apenas um exemplo de webservice'
		);

	//capturar um dado que vem de uma requisição de cliente, primeiramente verifica se a variável $HTTP_RAW_POST_DATA existe.
	// $HTTP_RAW_POST_DATA = isset ($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$servidor->service(file_get_contents('php://input'));
?>