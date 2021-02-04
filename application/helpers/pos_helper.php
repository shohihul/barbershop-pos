<?php

function is_logged_in()
{
  $ci = get_instance();
  if (!$ci->session->userdata('email')) {
    redirect('auth');
  } else {
    $role_id = $ci->session->userdata('role_id');
    $menu = $ci->uri->segment(1);
    if ($menu == 'admin') {
      $menu = 'Data Master';
    } elseif ($menu == null || $menu == '') {
      $menu = 'Auth';
    }
    $queryMenu = $ci->db->get_where('menu', ['menu' => $menu])->row_array();

    $menu_id = $queryMenu['id_menu'];

    $userAccess = $ci->db->get_where('user_access', [
      'role_id' => $role_id,
      'id_menu' => $menu_id
    ])->row_array();

    if (!$userAccess) {
      redirect('auth/blocked');
    }
  }
}


function check_active_pegawai($id_pegawai)
{
  $ci = get_instance();

  $result = $ci->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
  if ($result['active'] == 1) {
    return "checked='checked'";
  }
}
