<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;

//Retorna todos os produtos
$app->get('/getprodutos', function (){
	$stmt = getConn()->query("SELECT * FROM produtos");
	$produtos = $stmt->fetchAll(PDO::FETCH_OBJ);
	echo json_encode($produtos);
});

//Cadastra um produto
$app->post('/addproduto', function ($request, $response, $args){
	$todosOsParametros = $request->getParsedBody();
	$cod_barras = $todosOsParametros['cod_barras'];
	$produto = $todosOsParametros['produto'];
	$sql = "INSERT INTO produtos (cod_barras, produto) values ('".$cod_barras."','".$produto."')";
	$conn = getConn();
	$stmt = $conn->prepare($sql);
	$stmt->execute();
});
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

/*
//GET
$allGetVars = $request->getQueryParams();
foreach($allGetVars as $key => $param){
   //GET parameters list
}

//POST or PUT
$allPostPutVars = $request->getParsedBody();
foreach($allPostPutVars as $key => $param){
   //POST or PUT parameters list
}
Single parameters value:

//Single GET parameter
$getParam = $allGetVars['title'];

//Single POST/PUT parameter
$postParam = $allPostPutVars['postParam'];
*/
?>