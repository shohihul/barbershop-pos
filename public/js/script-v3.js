// DATA TABLE
$(document).ready(function () {
  $('#dataTable').DataTable();
  $('#dataTable2').DataTable();
});


// -----------------------------------------------------------------



//Flash Data
const flashdata = $('.flashdata').data('flashdata');
if (flashdata) {
  const arr = flashdata.split("|");

  Swal.fire({
    title: arr[0],
    text: arr[1],
    icon: arr[2]
  })
}



// -----------------------------------------------------------------


//FLASH DATA TOMBOL HAPUS
$('.tombol-hapus').on('click', function (e) {

  e.preventDefault();
  href = $(this).data('href');
  id = $(this).data('id');
  redirect = $(this).data('redirect');

  console.log(id);

  Swal.fire({
    title: 'Apakah anda yakin?',
    text: "Data yang anda pilih akan dihapus",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, hapus!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: href,
        type: 'post',
        data: { id: id },
        success: function () {
          document.location.href = redirect;
        }
      });
    }
  })

});



// FLASH DATA TOMBOL LOGOUT
$('.tombol-logout').on('click', function (e) {

  e.preventDefault();
  href = $(this).attr('href');

  Swal.fire({
    title: 'Apakah anda yakin?',
    text: "Sesi anda akan diakhiri setelah anda logout",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Logout',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      document.location.href = href;
    }
  })

});



// -----------------------------------------------------------------


//CHANGE ACTIVE STATUS PEGAWAI
$('.check-peg-active').on('click', function () {
  const id_pegawai = $(this).data('idpeg');

  $.ajax({
    url: "http://localhost/pos-app-update/index.php/admin/changeactive",
    type: 'post',
    data: { id: id_pegawai },
    success: function () {
      document.location.href = "http://localhost/pos-app-update/index.php/admin"
    }
  });
});




//AJAX UPDATE PEGAWAI
$(function () {
  $('.tombol-editpegawai').on('click', function () {
    const id_pegawai = $(this).data('id');
    $('.jkel').removeAttr('checked');
    $.ajax({
      url: 'http://localhost/pos-app-update/index.php/admin/getupdatepegawai',
      data: { id: id_pegawai },
      dataType: 'json',
      method: 'post',
      success: function (data) {
        $('#nama').val(data.nama);
        $('#email').val(data.email);
        $('#nohp').val(data.nohp);
        $('#jkel' + data.jkel).attr("checked", "checked");
        $('#role_id').val(data.role_id);
        $('#id_pegawai').val(data.id_pegawai);
      }
    });
  });
});



//AJAX TAMBAH ANTRIAN 
$(function () {
  $('.tombol-tambah-antrian').on('click', function () {
    const id = $(this).data('id');
    console.log(id);
    $('#antrian_id_pelanggan').val(id);
  });
});


// AJAX EDIT MEMBER
$(function () {
  $('.tombol-edit-member').on('click', function () {
    $('.modal-header h5').html('Edit Member');
    $('.jpel').removeAttr('checked');
    $('.modal-body form').attr('action', 'http://localhost/pos-app-update/index.php/pelayanan/update_member');
    const id = $(this).data('id');

    $.ajax({
      url: 'http://localhost/pos-app-update/index.php/pelayanan/get_member',
      data: { id: id },
      dataType: 'json',
      method: 'post',
      success: function (data) {
        $('#id').val(data.id_pelanggan);
        $('#nama').val(data.nama);
        $('#nohp').val(data.nohp);
        $('#ig').val(data.ig);
        $('#jpel' + data.jenis_pelanggan).attr("checked", "checked");
      }
    });
  });
});




// Tombol Pilih Barber
$('.tombol-pilih-barber-layanan').on('click', function () {
  $('#modalBarber .modal-header h5').html('Tambah Barber');
});



// AJAX EDIT BARBER LAYANAN
$(function () {
  $('.tombol-edit-barber-layanan').on('click', function () {
    $('#modalBarber .modal-header h5').html('Edit Barber');
    const id = $(this).data('id');

    $.ajax({
      url: 'http://localhost/pos-app-update/index.php/pelayanan/get_barber',
      data: { id: id },
      dataType: 'json',
      method: 'post',
      success: function (data) {
        $('#barber').val(data.id_barber);
      }
    });
  });
});





$(document).ready(function () {

  load_data();

  function load_data(query) {
    $.ajax({
      url: 'http://localhost/pos-app-update/index.php/pelayanan/live_search',
      method: 'post',
      dataType: 'html',
      data: { query: query },
      success: function (data) {
        $('#result-live-search').html(data);
      }
    });
  }

  $('#live_search').keyup(function () {
    const search = $(this).val();
    if (search != '') {
      load_data(search);
    } else {
      load_data();
    }
  });
});



//AJAX UPDATE JASA
$(function () {
  $('.tombol-edit-jasa').on('click', function () {
    const id = $(this).data('id');

    $.ajax({
      url: 'http://localhost/pos-app-update/index.php/admin/get_jasa',
      data: { id: id },
      dataType: 'json',
      method: 'post',
      success: function (data) {
        $('#id_jasa').val(data.id_jasa);
        $('#jasa').val(data.jasa);
        $('#deskripsi').val(data.deskripsi);
        $('#harga').val(data.harga);
        $('#diskon').val(data.diskon);
      }
    });
  });
});

