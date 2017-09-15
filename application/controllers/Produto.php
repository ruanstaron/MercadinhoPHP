<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Produto extends CI_Controller {
	
	public function Index()
	{
		//Recupera a opção do usuário
		$dados['opcao'] = $_GET['opcao'];
		// Recupera os produtos através do model
		if ($_GET['txtBusca'] == null){
			$dados['produtos'] = $this->produtos_model->getAll();
		} else {
			$dados['produtos'] = $this->produtos_model->getProduto($_GET['opcao'], $_GET['txtBusca']);
		}
		// Chama a home enviando um array de dados a serem exibidos
		$this->load->view('header');
		$this->load->view('produto',$dados);
		$this->load->view('footer');
	}
}