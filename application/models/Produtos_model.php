<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Produtos_model extends CI_Model {
  
  function __construct() {
    parent::__construct();
  }
  /*
  * Lista todos os registros da tabela
  *
  */
  function getAll() {
    $this->db->order_by("cod_barras", "asc");
    $query = $this->db->get('produtos');
        return $query->result();
  }

  function getProduto($opcao, $produto){
    $this->db->order_by($opcao, "asc");
    $where = $opcao." LIKE '%".$produto."%'";
    $this->db->where($where);
    $query = $this->db->get('produtos');
        return $query->result();
  }
}