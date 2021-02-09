<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set("Asia/Jakarta");
    $this->load->model('Auth_model', 'auth');
  }



  public function index()
  {
    $data = [
      'title' => 'Login'
    ];

    $this->auth->validasiLogin();
    $role_id = $this->session->userdata('role_id');


    if ($role_id) {
      if ($role_id == 1) {
        redirect('admin');
      } elseif ($role_id == 2 || $role_id == 4) {
        redirect('dashboard');
      } elseif ($role_id == 3) {
        redirect('pelayanan');
      }
    } else {
      if ($this->form_validation->run() == false) {
        $this->load->view('template/auth_header', $data);
        $this->load->view('auth/index');
        $this->load->view('template/auth_footer');
      } else {
        $this->_login();
      }
    }
  }

  private function _login()
  {
    $email = $this->input->post('email', true);
    $password = $this->input->post('password', true);
    $pegawai = $this->auth->getPegawai($email);


    if ($pegawai) {
      if ($pegawai['ganti_password'] == 1) {
        if (password_verify($password, $pegawai['password'])) {
          if ($pegawai['active'] == 1) {
            $data = [
              'email' => $email,
              'role_id' => $pegawai['role_id']
            ];
            $this->session->set_userdata($data);

            if ($pegawai['role_id'] == 1) {
              redirect('dashboard');
            } elseif ($pegawai['role_id'] == 2 || $pegawai['role_id'] == 4) {
              redirect('dashboard');
            } elseif ($pegawai['role_id'] == 3) {
              redirect('pelayanan');
            }
          } else {
            $this->session->set_flashdata('pesan', 'Failed|Akun dinontaktifkan! Hubungi Web Admin untuk info lebih lanjut|error');
            redirect('auth');
          }
        } else {
          $this->session->set_flashdata('pesan', 'Failed|Password tidak sesuai|error');
          redirect('auth');
        }
      } else {
        $data = [
          'activationPegawai' => $email
        ];
        $this->session->set_userdata($data);
        $this->session->set_flashdata('pesan', 'Ubah Password|Pertama kali Login? Aktifkan terlebih dahulu akun dengan mengubah password anda!|warning');
        redirect('auth/change_password_p');
      }
    } else {
      $this->session->set_flashdata('pesan', 'Failed|Akun tidak ditemukan|error');
      redirect('auth');
    }
  }




  public function register()
  {
    $data = [
      'title' => 'Register'
    ];

    $this->load->view('template/auth_header', $data);
    $this->load->view('auth/register');
    $this->load->view('template/auth_footer');
  }



  public function forgot_password()
  {
    $data = [
      'title' => 'Forgot Password'
    ];

    $this->load->view('template/auth_header', $data);
    $this->load->view('auth/forgot_password');
    $this->load->view('template/auth_footer');
  }



  public function change_password_p()
  {
    $data = [
      'title' => 'Change Password'
    ];
    $email = $this->session->userdata('activationPegawai');
    $oldPassword = $this->input->post('oldPassword', true);
    $newPassword = $this->input->post('password1', true);

    if ($email == null) {
      redirect('auth');
    } else {
      $this->auth->validasiChangePasswordP();

      if ($this->form_validation->run() == false) {
        $this->load->view('template/auth_header', $data);
        $this->load->view('auth/change_password_p');
        $this->load->view('template/auth_footer');
      } else {
        if ($this->auth->changePasswordP($email, $oldPassword, $newPassword) > 0) {
          $this->session->set_flashdata('pesan', 'Success|Password berhasil diubah|success');
          $this->session->unset_userdata('activationPegawai');
          redirect('auth');
        } else {
          redirect('auth/change_password_p');
        }
      }
    }
  }



  public function logout()
  {
    $this->session->unset_userdata('role_id');
    $this->session->unset_userdata('email');
    redirect('auth');
  }



  public function blocked()
  {
    $data = [
      'title' => '404 Not Found'
    ];
    $this->load->view('auth/blocked', $data);
  }
}
