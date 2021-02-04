<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelayanan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    date_default_timezone_set("Asia/Jakarta");
    $this->load->model('Pelayanan_model', 'pelayanan');
  }




  // -----------------------------------------------------------------------
  // ANTRIAN

  // Antrian
  public function index()
  {
    $data = [
      'title' => 'Pelayanan',
      'pelangganAntri' => $this->pelayanan->getPelangganAntri(),
      'barber' => $this->db->get_where('pegawai', ['role_id' => 3])->result_array(),
      'jasa' => $this->db->get('jasa')->result_array(),
      'pelanggan' => $this->pelayanan->getPelangganPembayaran()
    ];

    $this->session->unset_userdata('id_kunjungan_add_layanan');
    $this->session->unset_userdata('id_kunjungan_pembayaran');

    $this->load->view('template/header', $data);
    $this->load->view('pelayanan/index');
    $this->load->view('template/footer');
  }



  public function hapus_antrian()
  {
    $id_kunjungan = $this->input->post('id');

    $this->db->where('id_kunjungan', $id_kunjungan);
    $this->db->delete('kunjungan');

    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('pesan', 'Success|Data berhasil dihapus!|success');
    } else {
      $this->session->set_flashdata('pesan', 'Failed|Data gagal dihapus!|error');
    }
  }



  public function live_search()
  {
    $output = '';
    $query = '';
    if ($this->input->post('query')) {
      $query = $this->input->post('query');
    }
    $data = $this->pelayanan->get_live_search($query);
    $output .= '
    <div class="table-responsive">
    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>#</th>
          <th>ID Member</th>
          <th>Nama</th>
          <th>No Telp</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>';

    if ($data) {
      $i = 1;
      foreach ($data as $d) {
        $id_pelanggan = $d['id_pelanggan'];
        $output .= '
              <tr>
                <td> ' . $i++ . ' </td>
                <td> ' . $id_pelanggan . ' </td>
                <td> ' . $d["nama"] . ' </td>
                <td> ' . $d["nohp"] . ' </td>
                <td> <a href="' . site_url("pelayanan/tambah_antrian_by_url/" . $id_pelanggan . "")  . '" class="btn btn-sm btn-success tombol-tambah-antrian">Tambah Antrian</a> </td>
              </tr>
          ';
      }
    } else {
      $output .= '
          <tr>
            <td colspan="5"> No Data Found</td>
          </tr>
        ';
    }


    $output .= '</tbody>
                </table>
                </div>
                ';
    echo $output;
  }




  public function add_layanan($id)
  {

    $data = [
      'title' => 'Pelayanan',
      'url_title' => site_url('pelayanan'),
      'subtitle' => 'Tambah Layanan',
      'pelanggan' => $this->pelayanan->getPelangganLayanan($id),
      'id_kunjungan' => $id
    ];

    $this->load->view('template/header', $data);
    $this->load->view('pelayanan/add_layanan');
    $this->load->view('template/footer');
  }




  public function pilih_barber_layanan()
  {
    $this->form_validation->set_rules('barber', 'Barber', 'required', [
      'required' => 'Barber tidak boleh kosong!'
    ]);
    $url = $this->input->post('url');


    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('pesan', 'Failed|Pilih barber terlebih dahulu!|error');
      redirect($url);
    } else {
      $id_kunjungan = $this->input->post('id_kunjungan', true);
      $pegawai = $this->pelayanan->getPegawaiByID($this->input->post('barber', true));
      $data = [
        'id_barber' =>  $pegawai['id_pegawai'],
        'nama_barber' => $pegawai['nama']
      ];

      $this->db->where('id_kunjungan', $id_kunjungan);
      $this->db->update('kunjungan', $data);

      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('pesan', 'Success|Barber berhasil dipilih!|success');
        redirect($url);
      } else {
        $this->session->set_flashdata('pesan', 'Failed|Barber gagal dipilih!|error');
        redirect($url);
      }
    }
  }




  public function add_jasa()
  {
    $url = $this->input->post('url');
    $harga = $this->pelayanan->getHargaJasaByID($this->input->post('jasa'));
    $data = [
      'id_kunjungan' => $this->input->post('id_kunjungan', true),
      'id_jasa' => $this->input->post('jasa'),
      'harga_jasa' => $harga
    ];

    $this->db->insert('pelayanan', $data);
    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('pesan', 'Success|Layanan berhasil ditambahkan!|success');
      redirect($url);
    } else {
      $this->session->set_flashdata('pesan', 'Failed|Layanan gagal ditambahkan!|error');
      redirect($url);
    }
  }



  public function hapus_layanan()
  {
    $id_pelayanan = $this->input->post('id');
    $this->db->where('id_pelayanan', $id_pelayanan);
    $this->db->delete('pelayanan');

    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('pesan', 'Success|Pelayanan berhasil dihapus|success');
    } else {
      $this->session->set_flashdata('pesan', 'Failed|Pelayanan gagal dihapus|error');
    }
  }


  public function proses_antrian()
  {
    $id_kunjungan = $this->input->post('id_kunjungan', true);

    $data = [
      'sudah_antri' => 1,
    ];

    $this->db->where('id_kunjungan', $id_kunjungan);
    $this->db->update('kunjungan', $data);

    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('pesan', 'Success|Data berhasil ditambahkan|success');
      redirect('pelayanan');
    } else {
      $this->session->set_flashdata('pesan', 'Failed|Data gagal ditambahkan|error');
      redirect('pelayanan/add_layanan');
    }
  }

  // ANTRIAN
  // -----------------------------------------------------------------------





  // -----------------------------------------------------------------------
  // MEMBER AREA

  // Member Area
  public function member_area()
  {
    $data = [
      'title' => 'Member',
      'member' => $this->pelayanan->getMember(),
      'barber' => $this->db->get_where('pegawai', ['role_id' => 3])->result_array(),
      'jasa' => $this->db->get('jasa')->result_array()
    ];
    $this->load->view('template/header', $data);
    $this->load->view('pelayanan/member');
    $this->load->view('template/footer');
  }



  // Tambah Member
  public function tambah_member()
  {
    $data = [
      'title' => 'Member',
      'url_title' => site_url('pelayanan/member_area'),
      'subtitle' => 'Tambah Member',
      'jkel' => $this->pelayanan->getJenisPelanggan()
    ];

    $this->pelayanan->validasiTambahMember();

    if ($this->form_validation->run() == false) {
      $this->load->view('template/header', $data);
      $this->load->view('pelayanan/tambah_member');
      $this->load->view('template/footer');
    } else {
      if ($this->pelayanan->insertMember() > 0) {
        $this->session->set_flashdata('pesan', 'Success|Data member berhasil ditambahkan!|success');
        redirect('pelayanan/member_area');
      } else {
        $this->session->set_flashdata('pesan', 'Failed|Data member gagal ditambahkan!|error');
        redirect('pelayanan/tambah_member');
      }
    }
  }

  public function update_member()
  {
    $id = $this->input->post('id', true);

    $data = [
      'nama' => $this->input->post('nama', true),
      'nohp' => $this->input->post('nohp', true),
      'ig' => $this->input->post('ig', true),
      'jenis_pelanggan' => $this->input->post('jpel', true)
    ];

    $this->db->where('id_pelanggan', $id);
    $this->db->update('pelanggan', $data);

    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('pesan', 'Success|Data member berhasil diupdate!|success');
      redirect('pelayanan/member_area');
    } else {
      $this->session->set_flashdata('pesan', 'Failed|Data member gagal diupdate!|error');
      redirect('pelayanan/tambah_member');
    }
  }



  // Get Member For Ajax
  public function get_member()
  {
    $id = $this->input->post('id');
    $member = $this->db->get_where('pelanggan', ['id_pelanggan' => $id])->row_array();
    echo json_encode($member);
  }



  public function get_barber()
  {
    $id = $this->input->post('id');
    $barber = $this->db->get_where('kunjungan', ['id_kunjungan' => $id])->row_array();
    echo json_encode($barber);
  }



  // Tambah Antrian
  public function tambah_antrian($id_pelanggan)
  {
    $this->form_validation->set_rules('layanan1', 'Pelayanan', 'required', [
      'required' => 'Pelayanan tidak boleh kosong!'
    ]);

    $data = [
      'pelanggan' => $this->pelayanan->getPelangganByID($id_pelanggan),
      'pegawai' => $this->pelayanan->getPegawaiByID($this->input->post('barber', true)),
      'title' => 'Member',
      'url_title' => site_url('pelayanan/member_area'),
      'subtitle' => 'Tambah Antrian',
      'jasa' => $this->db->get('jasa')->result_array(),
      'barber' => $this->db->get_where('pegawai', ['role_id' => 3])->result_array()
    ];

    if ($this->form_validation->run() == false) {
      $this->load->view('template/header', $data);
      $this->load->view('pelayanan/tambah_antrian');
      $this->load->view('template/footer');
    } else {
      $pelanggan = $this->pelayanan->getPelangganByID($this->input->post('id_pelanggan'));
      $pegawai = $this->pelayanan->getPegawaiByID($this->input->post('barber'));
      $data = [
        'id_pelanggan' => $pelanggan['id_pelanggan'],
        'nama_pelanggan' => $pelanggan['nama'],
        'nohp_pelanggan' => $pelanggan['nohp'],
        'id_barber' => ($pegawai['id_pegawai'] !== null) ? $pegawai['id_pegawai'] : '',
        'nama_barber' => ($pegawai['nama'] !== null) ? $pegawai['nama'] : '',
        'tagihan' => 0,
        'bayar' => 0,
        'jenis_pelanggan' => $pelanggan['jenis_pelanggan'],
        'sudah_antri' => 0,
        'sudah_selesai' => 0,
        'check_in' => (date("Y-m-d H:i:s", time())),
        'check_out' => null
      ];

      $this->db->insert('kunjungan', $data);
      $insert_id = $this->db->insert_id();
      if ($insert_id > 0) {
        $dataJasa1 = [
          'id_kunjungan' => $insert_id,
          'id_jasa' => $this->input->post('layanan1', true),
          'harga_jasa' => $this->pelayanan->getHargaJasaByID($this->input->post('layanan1', true))
        ];

        $this->db->insert('pelayanan', $dataJasa1);

        if ($this->db->affected_rows() > 0) {
          if ($this->input->post('layanan2', true) == null) {
            $this->session->set_flashdata('pesan', 'Success|Member berhasil ditambahkan ke antrian!|success');
            redirect('pelayanan');
          } else {
            $dataJasa2 = [
              'id_kunjungan' => $insert_id,
              'id_jasa' => $this->input->post('layanan2', true),
              'harga_jasa' => $this->pelayanan->getHargaJasaByID($this->input->post('layanan2', true))
            ];

            $this->db->insert('pelayanan', $dataJasa2);
            if ($this->db->affected_rows() > 0) {
              $this->session->set_flashdata('pesan', 'Success|Member berhasil ditambahkan ke antrian!|success');
              redirect('pelayanan');
            } else {
              $this->session->set_flashdata('pesan', 'Failed|Member gagal ditambahkan ke antrian!|error');
              redirect('pelayanan/member_area');
            }
          }
        }
      } else {
        $this->session->set_flashdata('pesan', 'Failed|Member gagal ditambahkan ke antrian!|error');
        redirect('pelayanan/member_area');
      }
    }
  }





  public function tambah_antrian_by_url($id_pelanggan)
  {
    $pelanggan = $this->pelayanan->getPelangganByID($id_pelanggan);
    $data = [
      'id_pelanggan' => $pelanggan['id_pelanggan'],
      'nama_pelanggan' => $pelanggan['nama'],
      'nohp_pelanggan' => $pelanggan['nohp'],
      'id_barber' => 0,
      'nama_barber' => '',
      'tagihan' => 0,
      'bayar' => 0,
      'jenis_pelanggan' => $pelanggan['jenis_pelanggan'],
      'sudah_antri' => 0,
      'sudah_selesai' => 0,
      'check_in' => (date("Y-m-d H:i:s", time())),
      'check_out' => null
    ];

    $this->db->insert('kunjungan', $data);
    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('pesan', 'Success|Data berhasil ditambahkan!|success');
      redirect('pelayanan');
    } else {
      $this->session->set_flashdata('pesan', 'Failed|Data gagal ditambahkan!|error');
      redirect('pelayanan');
    }
  }






  // Hapus Member
  public function hapus_member()
  {
    $id_pelanggan = $this->input->post('id', true);

    $this->db->where('id_pelanggan', $id_pelanggan);
    $this->db->delete('pelanggan');

    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('pesan', 'Success|Member berhasil dihapus!|success');
    } else {
      $this->session->set_flashdata('pesan', 'Failed|Member gagal dihapus!|error');
    }
  }

  // MEMBER AREA
  // -----------------------------------------------------------------------










  // -----------------------------------------------------------------------
  // PEMBAYARAN

  public function pembayaran($id_kunjungan)
  {

    $data = [
      'title' => 'Pelayanan',
      'url_title' => site_url('pelayanan'),
      'subtitle' => 'Tambah Layanan',
      'pelanggan' => $this->pelayanan->getPelangganPembayaranByID($id_kunjungan),
      'id_kunjungan' => $id_kunjungan
    ];

    $this->load->view('template/header', $data);
    $this->load->view('pelayanan/pembayaran');
    $this->load->view('template/footer');
  }



  public function bayar()
  {
    $this->form_validation->set_rules('bayar', 'Bayar', 'required|numeric', [
      'required' => 'Bayar tidak boleh kosong!',
      'numeric' => 'Hanya angka'
    ]);
    $url = $this->input->post('url');

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('pesan', 'Failed|Data pembayaran gagal dicatat|error');
      redirect($url);
    } else {
      $id_kunjungan = $this->input->post('id_kunjungan', true);
      $tagihan = $this->input->post('tagihan', true);
      $bayar = $this->input->post('bayar', true);

      if (($bayar - $tagihan) < 0) {
        $this->session->set_flashdata('pesan', 'Failed|Data pembayaran gagal dicatat|error');
        redirect($url);
      } else {
        $data = [
          'tagihan' => $tagihan,
          'bayar' => $bayar,
          'sudah_selesai' => 1,
          'check_out' => (date("Y-m-d H:i:s", time()))
        ];

        $this->db->where('id_kunjungan', $id_kunjungan);
        $this->db->update('kunjungan', $data);

        if ($this->db->affected_rows() > 0) {
          $this->session->set_flashdata('pesan', 'Success|Pembayaran berhasil dicatat|success');
          redirect('pelayanan/history_detail/' . $id_kunjungan . '');
        } else {
          $this->session->set_flashdata('pesan', 'Failed|Pembayaran gagal dicatat|error');
          redirect($url);
        }
      }
    }
  }





  public function history()
  {
    $data = [
      'title' => 'History',
      'pelanggan' => $this->pelayanan->getPelangganInvoice()
    ];


    $this->load->view('template/header', $data);
    $this->load->view('pelayanan/history');
    $this->load->view('template/footer');
  }



  public function history_detail($id)
  {
    $data = [
      'title' => 'History',
      'url_title' => site_url('pelayanan/history'),
      'subtitle' => 'History Detail',
      'pelanggan' => $this->pelayanan->getPelangganInvoiceByID($id),
      'services' => $this->pelayanan->getPelayananByIDKunjungan($id)
    ];


    $this->load->view('template/header', $data);
    $this->load->view('pelayanan/history_detail');
    $this->load->view('template/footer');
  }



  public function report_detail($id)
  {
    $data = [
      'title' => 'History',
      'url_title' => site_url('pelayanan/history'),
      'subtitle' => 'History Detail',
      'pelanggan' => $this->pelayanan->getPelangganInvoiceByID($id),
      'services' => $this->pelayanan->getPelayananByIDKunjungan($id)
    ];


    $this->load->view('pelayanan/report_detail', $data);
  }
  // PEMBAYARAN
  // -----------------------------------------------------------------------

}
