<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pesanan_masuk extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function pesanan()
  {
    $this->db->select('*');
    $this->db->from('tbl_transaksi');
    $this->db->where('status_order=0');
    $this->db->order_by('id_transaksi', 'desc');
    return $this->db->get()->result();
  }

}
