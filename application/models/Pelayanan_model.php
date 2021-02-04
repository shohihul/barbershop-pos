<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelayanan_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set("Asia/Jakarta");
  }


  // ---------------------------------------------------------------------------
  // GET DATA FROM DATABASE
  public function getJenisPelanggan()
  {
    return $this->db->get('jenis_pelanggan')->result_array();
  }


  public function getJenisPelangganByID($id)
  {
    return $this->db->get_where('jenis_pelanggan', ['id_jenis_pelanggan' => $id])->row_array();
  }


  public function get_live_search($keyword)
  {
    $query = "SELECT * FROM pelanggan
              WHERE id_pelanggan LIKE '%$keyword%'
              OR nama LIKE '%$keyword%'
              OR nohp LIKE '%$keyword%'
              ORDER BY id_pelanggan DESC 
              LIMIT 10";
    return $this->db->query($query)->result_array();
  }


  public function getMember()
  {
    $this->db->order_by('member_sejak', 'DESC');
    return $this->db->get('pelanggan')->result_array();
  }


  public function getPelangganByID($id)
  {
    return $this->db->get_where('pelanggan', ['id_pelanggan' => $id])->row_array();
  }



  public function getPelangganAntri()
  {
    $query = "SELECT *
              FROM pelanggan JOIN kunjungan
              ON pelanggan.id_pelanggan = kunjungan.id_pelanggan
              WHERE kunjungan.sudah_antri = 0 
              AND kunjungan.sudah_selesai = 0
              ORDER BY kunjungan.check_in ASC";
    return $this->db->query($query)->result_array();
  }


  public function getPelangganLayanan($id)
  {
    $query = "SELECT *
              FROM pelanggan JOIN kunjungan
              ON pelanggan.id_pelanggan = kunjungan.id_pelanggan
              WHERE kunjungan.id_kunjungan = '$id'
              AND kunjungan.sudah_antri = 0 
              AND kunjungan.sudah_selesai = 0";
    return $this->db->query($query)->row_array();
  }



  public function getPelangganPembayaranByID($id)
  {
    $query = "SELECT *
              FROM pelanggan JOIN kunjungan
              ON pelanggan.id_pelanggan = kunjungan.id_pelanggan
              WHERE kunjungan.id_kunjungan = '$id'
              AND kunjungan.sudah_antri = 1 
              AND kunjungan.sudah_selesai = 0";
    return $this->db->query($query)->row_array();
  }



  public function getPelangganInvoice()
  {
    $this->db->where('sudah_antri', 1);
    $this->db->where('sudah_selesai', 1);
    $this->db->order_by('check_out', 'DESC');
    return $this->db->get('kunjungan')->result_array();
  }


  public function getPelangganInvoiceByID($id)
  {
    $this->db->where('sudah_antri', 1);
    $this->db->where('sudah_selesai', 1);
    $this->db->where('id_kunjungan', $id);
    return $this->db->get('kunjungan')->row_array();
  }



  public function getPelayananByIDKunjungan($id)
  {
    $this->db->where('id_kunjungan', $id);
    return $this->db->get('pelayanan')->result_array();
  }




  public function getHargaJasaByID($id)
  {
    $r = $this->db->get_where('jasa', ['id_jasa' => $id])->row_array();
    return $r['harga'];
  }



  public function getJasaByID($id)
  {
    $r = $this->db->get_where('jasa', ['id_jasa' => $id])->row_array();
    return $r;
  }




  public function getPegawaiByID($id)
  {
    return $this->db->get_where('pegawai', ['id_pegawai' => $id])->row_array();
  }



  public function getPelangganPembayaran()
  {
    $this->db->where('sudah_antri', 1);
    $this->db->where('sudah_selesai', 0);
    return $this->db->get('kunjungan')->result_array();
  }

  // GET DATA FROM DATABASE
  // ---------------------------------------------------------------------------






  // ---------------------------------------------------------------------------
  // FORM VALIDATION
  public function validasiTambahMember()
  {
    $this->form_validation->set_rules('nama', 'Nama', 'required', [
      'required' => 'Nama tidak boleh kosong!'
    ]);
    $this->form_validation->set_rules('jpel', 'Jenis Pelanggan', 'required', [
      'required' => 'Jenis Pelanggan tidak boleh kosong!'
    ]);
    $this->form_validation->set_rules('nohp', 'Nomor HP', 'numeric|min_length[11]|max_length[12]', [
      'required' => 'Nomor HP tidak boleh kosong!',
      'max_length' =>'Format Nomor HP 0812xxxxxxxx'
    ]);
  }


  // FORM VALIDATION
  // ---------------------------------------------------------------------------






  // ---------------------------------------------------------------------------
  // INSERT TO DB
  public function insertMember()
  {
    $id_pelanggan = (date("ymdHis", time()));
    $this->db->where('id_pelanggan', $id_pelanggan);
    $pelanggan = $this->db->get('pelanggan')->row_array();

    if ($pelanggan == null) {
      $data = [
        'id_pelanggan' => $id_pelanggan,
        'nama' => $this->input->post('nama', true),
        'jenis_pelanggan' => $this->input->post('jpel', true),
        'nohp' => $this->input->post('nohp', true),
        'ig' => $this->input->post('ig', true),
        'vc_kumulatif' => 0,
        'role_id' => 5,
        'member_sejak' => (date("Y-m-d H:i:s", time()))
      ];

      $this->db->insert('pelanggan', $data);
      return $this->db->affected_rows();
    } else {
      $id_pelanggan = (date("ymdHis", time()));
      $this->db->where('id_pelanggan', $id_pelanggan);
      $pelanggan = $this->db->get('pelanggan')->row_array();

      if ($pelanggan == null) {
        $data = [
          'id_pelanggan' => $id_pelanggan,
          'nama' => $this->input->post('nama', true),
          'jenis_pelanggan' => $this->input->post('jpel', true),
          'nohp' => $this->input->post('nohp', true),
          'ig' => $this->input->post('ig', true),
          'vc_kumulatif' => 0,
          'role_id' => 5,
          'member_sejak' => (date("Y-m-d H:i:s", time()))
        ];

        $this->db->insert('pelanggan', $data);
        return $this->db->affected_rows();
      } else {
        return 0;
      }
    }
  }

  // INSERT TO DB
  // ---------------------------------------------------------------------------

}
