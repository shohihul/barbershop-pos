<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    date_default_timezone_set("Asia/Jakarta");
    $this->load->model('Dashboard_model', 'dash');
  }


  public function index()
  {
    $tanggal = (date("Y-m-d H:i:s", time()));
    $data = [
      'title' => 'Overview',
      'date' => $tanggal,
      'todayEarnings' => $this->dash->getTodayEarnings(),
      'monthlyEarnings' => $this->dash->getMonthlyEarnings(),
      'customerTarget' => $this->dash->customerTarget(),
      'customerInQueue' => $this->dash->customerInQueue(),
      'monthly_income' => $this->dash->chartThisYear(),
      'daily_income' => $this->dash->chartThisMonth(),
      'chart_jenis' => $this->dash->chartJenis()
    ];

    $this->load->view('template/header', $data);
    $this->load->view('dashboard/index');
  }

  public function getincomechart()
  {
    echo json_encode($this->dash->chartThisMonth());
  }


  public function getjenischart()
  {
    echo json_encode($this->dash->chartJenis());
  }
}
