<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="flashdata" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $subtitle ?></h1>
    <a href="<?= site_url('pelayanan/report_detail/' . $pelanggan['id_kunjungan'] . '') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Invoice</a>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Invoice Customer #<?= $pelanggan['id_kunjungan'] ?></h6>
    </div>
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <p>Nama Customer : <b><?= $pelanggan['nama_pelanggan'] ?></b></p>
        <p>Barber : <b><?= $pelanggan['nama_barber'] ?></b></p>
      </div>
      <div class="d-flex justify-content-between">
        <p>Check in: <b><?= $pelanggan['check_in'] ?></b></p>
        <p>Check out : <b><?= $pelanggan['check_out'] ?></b></p>
      </div>
      <hr>
      <div class="d-flex justify-content-between align-items-center">
        <h6 class="mt-2 font-weight-bold text-primary">Rincian Harga</h6>
      </div>
      <!-- Table -->
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Layanan</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Harga</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($services as $s) : ?>
            <?php $pelayanan = $this->pelayanan->getJasaByID($s['id_jasa']) ?>
            <tr>
              <th><?= $i++ ?></th>
              <td><?= $pelayanan['jasa'] ?></td>
              <td><?= $pelayanan['deskripsi'] ?></td>
              <td>Rp <?= $pelayanan['harga'] ?></td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <th colspan="3">Total Harga</th>
            <th>Rp <?= $pelanggan['tagihan'] ?></th>
          </tr>
          <tr>
            <th colspan="3">Bayar</th>
            <th>Rp <?= $pelanggan['bayar'] ?></th>
          </tr>
          <tr>
            <th colspan="3" class="font-weight-bold text-dark">Kembalian</th>
            <th class="font-weight-bold text-dark">Rp <?= ($pelanggan['bayar'] - $pelanggan['tagihan']) ?></th>
          </tr>
        </tbody>
      </table>
      <div class="d-flex justify-content-center">
        <a href="https://wa.me/+62<?= $pelanggan['nohp_pelanggan'] ?>" target="_blank" class="btn btn-success" style="width: 400px;">Kirim Whatsapp</a>
      </div>
    </div>
  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

</div>
<!-- End of Main Content -->