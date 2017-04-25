<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;
$app->get('/getprodutos', 'getProdutos');
$app->post('/addproduto','addProduto');
$app->run();

function getConn() {
try{
	return new PDO('mysql:host=localhost;dbname=mercadinho',
		'root',
		'',
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}catch(Exception $e){
	return new PDO('mysql:host=localhost;dbname=mercadinho',
		'root',
		'chalaheadchala2',
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
}

function getProdutos() {
	$stmt = getConn()->query("SELECT * FROM produtos");
	$produtos = $stmt->fetchAll(PDO::FETCH_OBJ);
	echo json_encode($produtos);
}

function addProduto(){
	$request = \Slim\Slim::getInstance()->request();
	$produto = json_decode($request->getBody());
	$sql = "INSERT INTO produtos (cod_barras, produto) values (:cod_barras,':produto')";
	$conn = getConn();
	$stmt = $conn->prepare($sql);
	$stmt->bindParam("cod_barras",$produto->cod_barras);
	$stmt->bindParam("produto",$produto->produto);
	$stmt->execute();
	$produto->id = $conn->lastInsertId();
	echo json_encode($produto);
}

?>