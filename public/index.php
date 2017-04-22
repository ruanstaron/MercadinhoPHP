<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;
$app->get('/getprodutos', 'getProdutos');
$app->run();

function getConn() {
	return new PDO('mysql:host=localhost;dbname=mercadinho',
		'root',
		'chalaheadchala2',
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

function getProdutos() {
	$stmt = getConn()->query("SELECT * FROM produtos");
	$produtos = $stmt->fetchAll(PDO::FETCH_OBJ);
	echo "{Produtos:".json_encode($produtos)."}";
}

?>