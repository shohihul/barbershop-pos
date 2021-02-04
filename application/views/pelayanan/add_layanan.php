<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="flashdata" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><a href="<?= site_url('pos/kasir') ?>"><?= $subtitle ?></h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Page Breadcrumb -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= $url_title ?>"><?= $title ?></a></li>
      <li class="breadcrumb-item active" aria-current="page"><?= $subtitle ?></li>
    </ol>
  </nav>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Layanan Customer</h6>
    </div>
    <div class="card-body">

      <div class=" d-flex justify-content-between">
        <p><b>Nama Pelanggan :</b> <?= $pelanggan['nama']; ?></p>
        <p><b>Check In :</b> <?= $pelanggan['check_in']; ?></p>
      </div>
      <div class="d-flex justify-content-between">

        <?php $barber = $this->pelayanan->getPegawaiByID($pelanggan['id_barber']) ?>
        <p><b>Nama Barber :</b> <?= ($pelanggan['id_barber'] > 0) ? $barber['nama'] . '  <button class="btn btn-warning btn-sm tombol-edit-barber-layanan" data-toggle="modal" data-target="#modalBarber" data-id="' . $pelanggan['id_kunjungan'] . '">Ubah Barber</button>' : '<a href="#" class="badge badge-warning">Barber Belum Dipilih</a>' ?></p>
      </div>

      <hr class="my-4">

      <div class="d-flex justify-content-between align-items-center">
        <h6 class="mt-2 font-weight-bold text-primary">Rincian Harga</h6>
        <h6 class="mt-2 btn btn-primary" data-toggle="modal" data-target="#tambahLayananModal"><i class="fas fa-plus text-white-50"></i> Tambah Layanan</h6>
      </div>
      <!-- Table -->
      <div class="table-responsive">
        <table class="table table-hover" id="dataTable">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Layanan</th>
              <th scope="col">Deskripsi</th>
              <th scope="col">Harga</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1;
            $hargaTotal = 0; ?>
            <?php
            $pelayanan = $this->db->get_where('pelayanan', ['id_kunjungan' => $pelanggan['id_kunjungan']])->result_array();
            foreach ($pelayanan as $pel) :
            ?>
              <tr>
                <td><?= $i++ ?></td>
                <?php $jasa = $this->db->get_where('jasa', ['id_jasa' => $pel['id_jasa']])->row_array(); ?>
                <td><?= $jasa['jasa'] ?></td>
                <td><?= $jasa['deskripsi'] ?></td>
                <?php $harga = ($jasa['harga'] - ($jasa['harga'] * $jasa['diskon'] / 100)) ?>
                <td><?= $harga ?></td>
                <td>
                  <button href="#" data-href="<?= site_url('pelayanan/hapus_layanan') ?>" data-id="<?= $pel['id_pelayanan'] ?>" data-redirect="<?= site_url('pelayanan/add_layanan/' . $id_kunjungan . '') ?>" class="btn btn-danger btn-sm tombol-hapus">Hapus</button>
                </td>
              </tr>
              <?php $hargaTotal += $harga; ?>
            <?php endforeach; ?>
            <tr>
              <td colspan="3"><b>Total Harga</b></td>
              <td class="text text-primary"><b><?= $hargaTotal ?></b></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center mt-4 ">
        <?php if ($pelanggan['id_barber'] == 0) : ?>
          <button class="btn btn-warning tombol-pilih-barber-layanan" style="width: 400px;" data-toggle="modal" data-target="#modalBarber">Tambah Barber</button>

        <?php elseif (!$pelayanan) : ?>

          <button class="btn btn-warning" data-toggle="modal" data-target="#tambahLayananModal" style="width: 400px;" data-toggle="modal" data-target="#modalBarber">Pilih Layanan</button>

        <?php else : ?>
          <form action="<?= site_url('pelayanan/proses_antrian') ?>" method="POST">
            <input type="hidden" name="id_kunjungan" id="id_kunjungan" value="<?= $pelanggan['id_kunjungan'] ?>">
            <input type="hidden" name="tagihan" id="tagihan" value="<?= $hargaTotal ?>">
            <button type="submit" class="btn btn-primary" style="width: 400px;">Layani</button>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

</div>
<!-- End of Main Content -->


<!-- Modal Tambah Lelayanan-->
<div class="modal fade" id="tambahLayananModal" tabindex="-1" aria-labelledby="tambahLayananModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahLayananModalLabel">Tambah Layanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-layanan" action="<?= site_url('pelayanan/add_jasa') ?>" method="POST">
          <?php $urll = 'pelayanan/add_layanan/' . $id_kunjungan . ''; ?>
          <input type="hidden" name="url" id="url" value="<?= $urll ?>">
          <input type="hidden" name="id_kunjungan" value="<?= $pelanggan['id_kunjungan'] ?>">

          <div class="form-group">
            <label for="jasa">Tambah Layanan</label>
            <select class="form-control" id="jasa" name="jasa">
              <option value="">Pilih Layanan</option>
              <?php $tambahjasa = $this->db->get('jasa')->result_array(); ?>
              <?php foreach ($tambahjasa as $tj) : ?>
                <option value="<?= $tj['id_jasa'] ?>"><?= $tj['jasa'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Barber-->
<div class="modal fade" id="modalBarber" tabindex="-1" aria-labelledby="modalBarberLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalBarberLabel">Tambah Barber</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-layanan" action="<?= site_url('pelayanan/pilih_barber_layanan') ?>" method="POST">
          <input type="hidden" name="id_kunjungan" value="<?= $pelanggan['id_kunjungan'] ?>">
          <div class="form-group">
            <?php $urll = 'pelayanan/add_layanan/' . $id_kunjungan . ''; ?>
            <input type="hidden" name="url" id="url" value="<?= $urll ?>">
            <label for="barber">Barber</label>
            <select class="form-control" id="barber" name="barber">
              <?php $tambahbarber = $this->db->get_where('pegawai', ['role_id' => 3])->result_array(); ?>
              <?php foreach ($tambahbarber as $tb) : ?>
                <option value="<?= $tb['id_pegawai'] ?>"><?= $tb['nama'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>