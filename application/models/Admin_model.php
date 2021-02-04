<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }

  // ---------------------------------------------------------------------------
  // GET DATA FROM DATABASE
  public function getRoleId()
  {
    return $this->db->get('role_id')->result_array();
  }


  public function getJkel()
  {
    return $this->db->get('jenis_pelanggan')->result_array();
  }


  public function getJkelByID($id)
  {
    return $this->db->get_where('jenis_pelanggan', ['id_jenis_pelanggan' => $id])->row_array();
  }


  public function getJabatanByID($id)
  {
    return $this->db->get_where('role_id', ['role_id' => $id])->row_array();
  }

  // GET DATA FROM DATABASE
  // ---------------------------------------------------------------------------




  // ---------------------------------------------------------------------------
  // FORM VALIDATION

  public function validasiTambahPegawai()
  {
    $this->form_validation->set_rules('nama', 'Nama', 'required', [
      'required' => 'Nama tidak boleh kosong!'
    ]);
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[pegawai.email]', [
      'required' => 'Email tidak boleh kosong!',
      'valid_email' => 'Email tidak valid!'
    ]);
    $this->form_validation->set_rules('nohp', 'Nomor HP', 'required|numeric|min_length[11]|max_length[13]', [
      'required' => 'No HP tidak boleh kosong!'
    ]);
    $this->form_validation->set_rules('jkel', 'Jenis Kelamin', 'required', [
      'required' => 'Jenis Kelamin tidak boleh kosong!'
    ]);
    $this->form_validation->set_rules('role_id', 'Jabatan', 'required', [
      'required' => 'Jabatan tidak boleh kosong!'
    ]);
  }




  public function validasiEditPegawai()
  {
    $this->form_validation->set_rules('nama', 'Nama', 'required', [
      'required' => 'Nama tidak boleh kosong!'
    ]);
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
      'required' => 'Email tidak boleh kosong!',
      'valid_email' => 'Email tidak valid!'
    ]);
    $this->form_validation->set_rules('nohp', 'Nomor HP', 'required|numeric|min_length[11]|max_length[13]', [
      'required' => 'No HP tidak boleh kosong!'
    ]);
    $this->form_validation->set_rules('jkel', 'Jenis Kelamin', 'required', [
      'required' => 'Jenis Kelamin tidak boleh kosong!'
    ]);
    $this->form_validation->set_rules('role_id', 'Jabatan', 'required', [
      'required' => 'Jabatan tidak boleh kosong!'
    ]);
  }

  // FORM VALIDATION
  // ---------------------------------------------------------------------------



  // ---------------------------------------------------------------------------
  // INSERT DATA TO DATABASE

  //upload gambar
  public function upload()
  {
    $nameFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //Cek apkah ada gambar yg diupload
    if ($error === 4) {
      return false;
    }

    //cek apakah yang diupload adalh gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $nameFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      return false;
    }

    //cek apakah ukuran sesuai
    if ($ukuranFile > 2000000) {
      return false;
    }

    //lolos pengecekan gambar, maka gambar siap diupload
    //generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= "$ekstensiGambar";
    move_uploaded_file($tmpName, './public/image/pegawai/' . $namaFileBaru);

    return $namaFileBaru;
  }




  //insert baru data petugas
  public function insertPegawai()
  {

    $dataGambar = $this->upload();

    if ($dataGambar != false) {
      $gambar = $dataGambar;
    } else {
      $gambar = 'default.png';
    }

    $data = [
      'nama' => $this->input->post('nama', true),
      'email' => $this->input->post('email', true),
      'nohp' => $this->input->post('nohp', true),
      'jkel' => $this->input->post('jkel', true),
      'role_id' => $this->input->post('role_id', true),
      'password' => password_hash(1234, PASSWORD_DEFAULT),
      'active' => (($this->input->post('activePegawai') == null) ? 0 : 1),
      'gambar' => $gambar
    ];

    $this->db->insert('pegawai', $data);
    return $this->db->affected_rows();
  }

  // INSERT DATA TO DATABASE
  // ---------------------------------------------------------------------------







  public function validasiJasa()
  {
    $this->form_validation->set_rules('jasa', 'Title', 'required', [
      'required' => 'Title tidak boleh kosong!'
    ]);
    $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', [
      'required' => 'Deskripsi tidak boleh kosong!'
    ]);
    $this->form_validation->set_rules('harga', 'Harga', 'required|numeric', [
      'required' => 'Harga tidak boleh kosong!'
    ]);
  }
}
