<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('m_admin'));
    $this->load->model(array('m_pesanan_masuk'));
  }

  function index()
  {
    $data = array(
      'title' => 'Dashboard Admin',
      'total_barang' => $this->m_admin->total_barang(),
      'total_kategori' => $this->m_admin->total_kategori(),
      'isi' => 'admin'
    );
    $this->load->view('layout/wrapper_backend', $data, FALSE);
  }

  function setting()
  {
    $this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required',
    array('required' => '%s Harus Di isi')
    );
    $this->form_validation->set_rules('kota', 'Kota/Kabupaten', 'required',
    array('required' => '%s Harus Di isi')
    );
    $this->form_validation->set_rules('alamat_toko', 'Alamat Toko', 'required',
    array('required' => '%s Harus Di isi')
    );
    $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required',
    array('required' => '%s Harus Di isi')
    );

    if ($this->form_validation->run() == FALSE) {
      $data = array(
        'title' => 'Setting',
        'setting' => $this->m_admin->data_setting(),
        'isi' => 'setting'
      );
      $this->load->view('layout/wrapper_backend', $data, FALSE);
    }else {
      $data = array(
        'id' => 1,
        'lokasi' => $this->input->post('kota'),
        'nama_toko' => $this->input->post('nama_toko'),
        'alamat_toko' => $this->input->post('alamat_toko'),
        'no_telp' => $this->input->post('no_telp'),
      );
      $this->m_admin->edit($data);
      $this->session->set_flashdata('pesan', 'Settingan Berhasil di Update');
      redirect('admin/setting');
    }


  }

  public function pesanan_masuk()
  {
    $data = array(
      'title' => 'Pesanan Masuk',
      'pesanan' => $this->m_pesanan_masuk->pesanan(),
      'isi' => 'pesanan_masuk'
    );
    $this->load->view('layout/wrapper_backend', $data, FALSE);
  }


}
