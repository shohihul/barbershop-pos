<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getTodayEarnings()
  {
    $tanggal = (date("Y-m-d H:i:s", time()));
    $query = "SELECT * FROM kunjungan WHERE sudah_antri = 1
              AND sudah_selesai = 1 AND YEAR(check_out) = YEAR('$tanggal')
              AND MONTH(check_out) = MONTH('$tanggal') AND DAY(check_out) = DAY('$tanggal')";
    $income = 0;
    $r = $this->db->query($query)->result_array();

    foreach ($r as $row) {
      $income += $row['tagihan'];
    }

    return $income;
  }

  public function getMonthlyEarnings()
  {
    $tanggal = (date("Y-m-d H:i:s", time()));
    $query = "SELECT * FROM kunjungan WHERE sudah_antri = 1
              AND sudah_selesai = 1 AND MONTH(check_out) = MONTH('$tanggal')";
    $income = 0;
    $r = $this->db->query($query)->result_array();

    foreach ($r as $row) {
      $income += $row['tagihan'];
    }

    return $income;
  }


  public function chartThisYear()
  {
    $tanggal = (date("Y-m-d H:i:s", time()));
    $query = "SELECT * FROM kunjungan WHERE sudah_antri = 1
              AND sudah_selesai = 1 AND YEAR(check_out) = YEAR('$tanggal')
              ORDER BY MONTH(check_out) ASC";
    $income1 = 0;
    $income2 = 0;
    $income3 = 0;
    $income4 = 0;
    $income5 = 0;
    $income6 = 0;
    $income7 = 0;
    $income8 = 0;
    $income9 = 0;
    $income10 = 0;
    $income11 = 0;
    $income12 = 0;

    $r = $this->db->query($query);
    $incomes = [];
    foreach ($r->result_array() as $row) {
      if (explode('-', $row['check_out'])[1] == '01') {
        $income1 += $row['tagihan'];
      } elseif (explode('-', $row['check_out'])[1] == '02') {
        $income2 += $row['tagihan'];
      } elseif (explode('-', $row['check_out'])[1] == '03') {
        $income3 += $row['tagihan'];
      } elseif (explode('-', $row['check_out'])[1] == '04') {
        $income4 += $row['tagihan'];
      } elseif (explode('-', $row['check_out'])[1] == '05') {
        $income5 += $row['tagihan'];
      } elseif (explode('-', $row['check_out'])[1] == '06') {
        $income6 += $row['tagihan'];
      } elseif (explode('-', $row['check_out'])[1] == '07') {
        $income7 += $row['tagihan'];
      } elseif (explode('-', $row['check_out'])[1] == '08') {
        $income8 += $row['tagihan'];
      } elseif (explode('-', $row['check_out'])[1] == '09') {
        $income9 += $row['tagihan'];
      } elseif (explode('-', $row['check_out'])[1] == '10') {
        $income10 += $row['tagihan'];
      } elseif (explode('-', $row['check_out'])[1] == '11') {
        $income11 += $row['tagihan'];
      } elseif (explode('-', $row['check_out'])[1] == '12') {
        $income12 += $row['tagihan'];
      }
    }
    array_push($incomes, $income1);
    array_push($incomes, $income2);
    array_push($incomes, $income3);
    array_push($incomes, $income4);
    array_push($incomes, $income5);
    array_push($incomes, $income6);
    array_push($incomes, $income7);
    array_push($incomes, $income8);
    array_push($incomes, $income9);
    array_push($incomes, $income10);
    array_push($incomes, $income11);
    array_push($incomes, $income12);

    return $incomes;
  }

  public function chartThisMonth()
  {
    $tanggal = (date("Y-m-d H:i:s", time()));
    $query = "SELECT * FROM kunjungan WHERE sudah_antri = 1
              AND sudah_selesai = 1 AND MONTH(check_out) = MONTH('$tanggal')
              ORDER BY DAY(check_out) ASC";
    $incomes = [];

    $r = $this->db->query($query);
    for ($i=0; $i < 31; $i++) {
      $incomes[$i] = 0;
      foreach ($r->result_array() as $key => $val) {

        if (explode('-', $val['check_out'])[2] == $i) {
          $incomes[$i] += $val['tagihan'];
        }
      }
    }

    return $incomes;
  }


  public function customerInQueue()
  {
    $this->db->where('sudah_antri', 0);
    $this->db->where('sudah_selesai', 0);
    return $this->db->get('kunjungan')->num_rows();
  }


  public function customerTarget()
  {
    $this->db->where('sudah_antri', 1);
    $this->db->where('sudah_selesai', 1);
    return $this->db->get('kunjungan')->num_rows();
  }


  public function chartJenis()
  {
    $this->db->where('sudah_selesai', 1);
    $this->db->where('sudah_antri', 1);
    $r = $this->db->get('kunjungan')->result_array();


    $jpel1 = 0;
    $jpel2 = 0;
    $jpel3 = 0;
    $jenisPelanggan = [];

    foreach ($r as $row) {
      if ($row['jenis_pelanggan'] == 1) {
        $jpel1++;
      } elseif ($row['jenis_pelanggan'] == 2) {
        $jpel2++;
      } elseif ($row['jenis_pelanggan'] == 3) {
        $jpel3++;
      }
    }
    array_push($jenisPelanggan, $jpel1);
    array_push($jenisPelanggan, $jpel2);
    array_push($jenisPelanggan, $jpel3);

    return $jenisPelanggan;
  }
}
