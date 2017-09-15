<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Produto extends CI_Controller {
	
	public function Index()
	{
		// Recupera os produtos através do model
		$dados['produtos'] = $this->produtos_model->getAll();
		// Chama a home enviando um array de dados a serem exibidos
		$this->load->view('header');
		$this->load->view('produto',$dados);
		$this->load->view('footer');
	}
}