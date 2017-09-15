<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;

//Retorna todos os produtos
$app->get('/getprodutos', function (){
	$stmt = getConn()->query("SELECT cod_barras, descricao FROM produtos ORDER BY cod_barras");
	$produtos = $stmt->fetchAll(PDO::FETCH_OBJ);
	echo json_encode($produtos);
});

//Cadastra um produto
$app->post('/addprodutos', function ($request, $response, $args){
	$produtos = $request->getParsedBody();
	foreach ($produtos['produto'] as $result) {
		if (verificaCod_barras($result['cod_barras']) == 1) {
			gravaBanco($result);
		}
	}
});
$app->run();

function getConn() {
	return new PDO('mysql:host=mysql.hostinger.com.br;dbname=u657718053_merca',
		'u657718053_root',
		'xinxila2017',
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

function verificaCod_barras($cod_barras){
	$stmt = getConn()->query("SELECT cod_barras FROM produtos WHERE cod_barras = ".$cod_barras);
	$produto = $stmt->fetch(PDO::FETCH_OBJ);
	if (empty($produto->cod_barras)) {
		return 1;
	} else{
		return 0;
	}
}

function gravaBanco($produto){
	$sql = "INSERT INTO produtos (cod_barras, descricao) values ('".$produto['cod_barras']."','".$produto['descricao']."')";
	$conn = getConn();
	$stmt = $conn->prepare($sql);
	$stmt->execute();
}
?>