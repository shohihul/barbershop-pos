<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="flashdata" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-primary">Data <?= $title ?></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr class="bg-primary text-white">
              <th>#</th>
              <th>ID Member</th>
              <th>Nama</th>
              <th>Barber</th>
              <th>Tagihan</th>
              <th>Bayar</th>
              <th>Check Out</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <!-- <tfoot>
            <tr class="bg-primary text-white">
              <th>No</th>
              <th>ID Member</th>
              <th>Nama</th>
              <th>Nomor HP</th>
              <th>Instagram</th>
              <th>Jenis Pelanggan</th>
              <th>Aksi</th>
            </tr>
          </tfoot> -->
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($pelanggan as $p) : ?>
              <tr>
                <th><?= $i++ ?></th>
                <td><?= $p['id_pelanggan'] ?></td>
                <td><?= $p['nama_pelanggan'] ?></td>
                <td><?= $p['nama_barber'] ?></td>
                <td><?= $p['tagihan'] ?></td>
                <td><?= $p['bayar'] ?></td>
                <td><?= $p['check_out'] ?></td>
                <td>
                  <a href="<?= site_url('pelayanan/history_detail/' . $p['id_kunjungan'] . '') ?>" class="btn btn-primary btn-sm">Detail</a>
                  <a href="https://api.whatsapp.com/send?phone=+62<?= $p['nohp_pelanggan'] ?>&text=Hai%20kak%20<?= $p['nama_pelanggan'] ?>%2C%20Terima%20Kasih%20ya!%20%F0%9F%8E%8A%F0%9F%8E%89%0Asudah%20mengunakan%20layanan%20Funtastic%20Karisma%20Barbershop%20Jember%F0%9F%92%87%F0%9F%8F%BB%E2%80%8D%E2%99%82%EF%B8%8F%0A%0A%E2%9E%96%E2%9E%96%E2%9E%96%E2%9E%96%E2%9E%96%E2%9E%96%E2%9E%96%E2%9E%96%E2%9E%96%0AYuk%20luangkan%20waktumu%20sebentar%20untuk%20mengisi%20kuisioner%20ini%20yah%E2%9C%A8%0A%0Ahttp%3A%2F%2Fbit.ly%2Fquisionerkarisma%0A%E2%9E%96%E2%9E%96%E2%9E%96%E2%9E%96%E2%9E%96%E2%9E%96%E2%9E%96%E2%9E%96%E2%9E%96%0A%0ABerikan%20kami%20ulasan%20dan%20komentar%0Akarena%20penilaianmu%20sangat%20berarti%F0%9F%99%86%F0%9F%8F%BB%E2%80%8D%E2%99%82%EF%B8%8F%0A%E2%96%AA%EF%B8%8F%E2%96%AA%EF%B8%8F%E2%96%AA%EF%B8%8F%E2%96%AA%EF%B8%8F%E2%96%AA%EF%B8%8F%E2%96%AA%EF%B8%8F%E2%96%AA%EF%B8%8F%E2%96%AA%EF%B8%8F%E2%96%AA%EF%B8%8F%0Ajangan%20lupa%20ajak%20teman%20kamu%2C%20dengan%20gaya%20rambut%20baru%20pasti%20bikin%20penampilan%20kamu%20makin%20stylish.%F0%9F%99%8B%F0%9F%8F%BB%E2%80%8D%E2%99%82%EF%B8%8F%F0%9F%8E%89" target="_blank" class="btn btn-success btn-sm">WA</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

</div>
<!-- End of Main Content -->