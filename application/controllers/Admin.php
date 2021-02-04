<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    date_default_timezone_set("Asia/Jakarta");
    $this->load->model('Admin_model', 'admin');
  }


  // DATA PEGAWAI
  public function index()
  {
    $data = [
      'title' => 'Pegawai',
      'pegawai' => $this->db->get('pegawai')->result_array()
    ];

    $this->load->view('template/header', $data);
    $this->load->view('admin/index');
    $this->load->view('template/footer');
  }


  // TAMBAH PEGAWAI
  public function tambah_pegawai()
  {
    $data = [
      'title' => 'Pegawai',
      'url_title' => site_url('admin'),
      'subtitle' => 'Tambah Pegawai',
      'role_id' => $this->admin->getRoleId(),
      'jkel' => $this->admin->getJkel()
    ];

    $this->admin->validasiTambahPegawai();

    if ($this->form_validation->run() == false) {
      $this->load->view('template/header', $data);
      $this->load->view('admin/tambah_pegawai');
      $this->load->view('template/footer');
    } else {
      if ($this->admin->insertPegawai() > 0) {
        $this->session->set_flashdata('pesan', 'Success|Data pegawai baru berhasil ditambahkan|success');
        redirect('admin');
      } else {
        $this->session->set_flashdata('pesan', 'Failed|Data pegawai baru gagal ditambahkan|error');
        redirect('admin');
      }
    }
  }



  // Change Pegawai Active
  public function changeactive()
  {
    $id_pegawai = $this->input->post('id');
    $data = [
      'id_pegawai' => $id_pegawai,
      'active' => 1
    ];
    $result = $this->db->get_where('pegawai', $data);


    if ($result->num_rows() < 1) {
      $data = [
        'active' => 1
      ];
      $this->db->where('id_pegawai', $id_pegawai);
      $this->db->update('pegawai', $data);
      $this->session->set_flashdata('pesan', 'Success|Akun diaktifkan|success');
    } else {
      $data = [
        'active' => 0
      ];
      $this->db->where('id_pegawai', $id_pegawai);
      $this->db->update('pegawai', $data);
      $this->session->set_flashdata('pesan', 'Success|Akun dinonaktifkan|success');
    }
  }



  //Edit Pegawai
  public function update_pegawai()
  {
    $id_pegawai = $this->input->post('id_pegawai', true);
    $pegawai = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();

    $emailLama = $pegawai['email'];
    $emailBaru = $this->input->post('email', true);
    $this->db->where('email', $emailBaru);
    $resultEmail = $this->db->get('pegawai');

    $gambarLama = $pegawai['gambar'];
    if ($_FILES['gambar']['error'] === 4) {
      $gambar = $gambarLama;
    } else {
      $file = './public/image/pegawai/' . $gambarLama . '';
      if($gambarLama !== 'default.png'){
      unlink($file);
      }
      $gambar = $this->admin->upload();
    }

    if ($emailBaru != $emailLama) {
      if ($resultEmail->num_rows() < 1) {
        $email = $emailBaru;
      } else {
        $this->session->set_flashdata('pesan', 'Failed|Email sudah terdaftar!|error');
        redirect('admin');
      }
    } else {
      $email = $emailLama;
    }

    $data = [
      'nama' => $this->input->post('nama', true),
      'email' => $email,
      'nohp' => $this->input->post('nohp', true),
      'gambar' => $gambar,
      'jkel' => $this->input->post('jkel', true),
      'role_id' => $this->input->post('role_id', true),
    ];

    $this->db->where('id_pegawai', $id_pegawai);
    $this->db->update('pegawai', $data);

    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('pesan', 'Success|Data berhasil diupdate!|success');
      redirect('admin');
    } else {
      $this->session->set_flashdata('pesan', 'Failed|Data gagal diupdate!|error');
      redirect('admin');
    }
  }


  // GET EDIT PEGAWAI
  public function getupdatepegawai()
  {
    $id_pegawai = $this->input->post('id');
    $query = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
    echo json_encode($query);
  }


  // HAPUS PEGAWAI
  public function hapus_pegawai()
  {
    $id = $this->input->post('id');
    $this->db->where('id_pegawai', $id);
    $this->db->delete('pegawai');

    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('pesan', 'Success|Data berhasil dihapus!|success');
    } else {
      $this->session->set_flashdata('pesan', 'Failed|Data gagal dihapus!|error');
    }
  }


  public function jasa()
  {
    $data = [
      'title' => 'Jasa',
      'jasa' => $this->db->get('jasa')->result_array()
    ];

    $this->load->view('template/header', $data);
    $this->load->view('admin/jasa');
    $this->load->view('template/footer');
  }


  public function tambah_jasa()
  {
    $data = [
      'title' => 'Jasa',
      'url_title' => site_url('admin/jasa'),
      'subtitle' => 'Tambah Jasa'
    ];

    $this->admin->validasiJasa();

    if ($this->form_validation->run() == false) {
      $this->load->view('template/header', $data);
      $this->load->view('admin/tambah_jasa');
      $this->load->view('template/footer');
    } else {
      $data = [
        'jasa' => $this->input->post('jasa', true),
        'deskripsi' => $this->input->post('deskripsi', true),
        'harga' => $this->input->post('harga', true),
        'diskon' => ($this->input->post('diskon', true) == null) ? 0 : $this->input->post('diskon', true),
        'tanggal_dibuat' => (date("Y-m-d H:i:s", time()))
      ];

      $this->db->insert('jasa', $data);

      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('pesan', 'Success|Data berhasil ditambahkan!|success');
        redirect('admin/tambah_jasa');
      } else {
        $this->session->set_flashdata('pesan', 'Failed|Data gagal ditambahkan!|error');
        redirect('admin/tambah_jasa');
      }
    }
  }


  public function hapus_jasa()
  {
    $id_jasa = $this->input->post('id', true);
    $this->db->where('id_jasa', $id_jasa);
    $this->db->delete('jasa');

    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('pesan', 'Success|Data berhasil dihapus!|success');
    } else {
      $this->session->set_flashdata('pesan', 'Failed|Data gagal dihapus!|error');
    }
  }


  public function get_jasa()
  {
    $id = $this->input->post('id', true);
    echo json_encode($this->db->get_where('jasa', ['id_jasa' => $id])->row_array());
  }


  public function update_jasa()
  {
    $id_jasa = $this->input->post('id_jasa', true);
    $data = [
      'jasa' => $this->input->post('jasa', true),
      'deskripsi' => $this->input->post('deskripsi', true),
      'harga' => $this->input->post('harga', true),
      'diskon' => $this->input->post('diskon', true),
      'terakhir_diubah' => (date("Y-m-d H:i:s", time()))
    ];

    $this->db->where('id_jasa', $id_jasa);
    $this->db->update('jasa', $data);

    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('pesan', 'Success|Data berhasil diupdate!|success');
      redirect('admin/jasa');
    } else {
      $this->session->set_flashdata('pesan', 'Failed|Data gagal diupdate!|error');
      redirect('admin/jasa');
    }
  }
}
