<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }



  // ---------------------------------------------------------------------------
  // GET DATA FROM DATABASE
  public function getPegawai($email)
  {
    return $this->db->get_where('pegawai', ['email' => $email])->row_array();
  }

  // GET DATA FROM DATABASE
  // ---------------------------------------------------------------------------




  // ---------------------------------------------------------------------------
  // MANIPULATION FROM DATABASE
  public function changePasswordP($email, $oldPassword, $newPassword)
  {
    $pegawai = $this->db->get_where('pegawai', ['email' => $email])->row_array();

    if (password_verify($oldPassword, $pegawai['password']) == true) {
      if ($oldPassword != $newPassword) {
        $data = [
          'password' => password_hash($newPassword, PASSWORD_DEFAULT),
          'ganti_password' => 1
        ];
        $this->db->where('email', $email);
        $this->db->update('pegawai', $data);
        return $this->db->affected_rows();
      } else {
        $this->session->set_flashdata('pesan', 'Failed|Password baru tidak boleh sama dengan password lama!|error');
        return 0;
      }
    } else {
      $this->session->set_flashdata('pesan', 'Failed|Password lama tidak sesuai!|error');
      return 0;
    }
  }

  // MANIPULATION FROM DATABASE
  // ---------------------------------------------------------------------------





  // ---------------------------------------------------------------------------
  // FORM VALIDATION
  public function validasiLogin()
  {
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
      'required' => 'Email tidak boleh kosong!',
      'valid_email' => 'Email salah'
    ]);
    $this->form_validation->set_rules('password', 'Password', 'required', [
      'required' => 'Password tidak boleh kosong!'
    ]);
  }


  public function validasiChangePasswordP()
  {
    $this->form_validation->set_rules('oldPassword', 'Password Lama', 'required', [
      'required' => 'Password Lama tidak boleh kosong!'
    ]);
    $this->form_validation->set_rules('password1', 'Password Baru', 'required|min_length[3]|trim|matches[password2]', [
      'required' => 'Password Baru tidak boleh kosong!'
    ]);
    $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|trim|matches[password1]', [
      'required' => 'Konfirmasi Password tidak boleh kosong!'
    ]);
  }
  // FORM VALIDATION
  // ---------------------------------------------------------------------------


}
