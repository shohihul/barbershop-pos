<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="flashdata" data-flashdata="<?= $this->session->flashdata('pesan') ?>"></div>

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-primary">Data <?= $title ?></h6>
      <a href="<?= site_url('admin/tambah_jasa') ?>" class="mt-2 btn btn-primary"><i class="fas fa-plus text-white-50"></i> Tambah <?= $title ?></a>
    </div>
    <div class="card-body">
      <!-- Table -->
      <div class="table-responsive">
        <table class="table table-hover" id="dataTable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Deskripsi</th>
              <th scope="col">Harga</th>
              <th scope="col">Diskon</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($jasa as $j) : ?>
              <tr>
                <th><?= $i++ ?></th>
                <td><?= $j['jasa'] ?></td>
                <td><?= $j['deskripsi'] ?></td>
                <td><?= $j['harga'] ?></td>
                <td><?= ($j['diskon'] == null) ? '0' : $j['diskon'] ?></td>
                <td>
                  <button class="btn btn-primary btn-sm tombol-edit-jasa" data-toggle="modal" data-target="#modalTambahJasa" data-id="<?= $j['id_jasa'] ?>">Edit</button>
                  <button class="btn btn-danger btn-sm tombol-hapus" data-id="<?= $j['id_jasa'] ?>" data-href="<?= site_url('admin/hapus_jasa') ?>" data-redirect="<?= site_url('admin/jasa') ?>">Hapus</button>
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




<!-- Modal Edit Pegawai-->
<div class="modal fade" id="modalTambahJasa" tabindex="-1" aria-labelledby="modalTambahJasaLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahJasaLabel">Edit Jasa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('admin/update_jasa') ?>" method="POST">
          <div class=" row">
            <div class="col-lg-6">
              <input type="hidden" name="id_jasa" id="id_jasa">
              <div class="form-group">
                <label for="jasa">Title</label>
                <input type="text" class="form-control <?= (form_error('jasa')) ? 'is-invalid' : '' ?>" id="jasa" name="jasa" placeholder="Potong Rambut Kilat" autofocus value="<?= set_value('jasa') ?>">
                <div id="jasaFeedback" class="invalid-feedback">
                  <?= form_error('jasa') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <input type="text" class="form-control <?= (form_error('deskripsi')) ? 'is-invalid' : '' ?>" id="deskripsi" name="deskripsi" placeholder="Potong rambut kilat adalah..." value="<?= set_value('deskripsi') ?>">
                <div id="deskripsiFeedback" class="invalid-feedback">
                  <?= form_error('deskripsi') ?>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="harga">Harga</label>
                <input type="text" class="form-control <?= (form_error('harga')) ? 'is-invalid' : '' ?>" id="harga" name="harga" placeholder="30000" value="<?= set_value('harga') ?>">
                <div id="hargaFeedback" class="invalid-feedback">
                  <?= form_error('harga') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="diskon">Diskon</label>
                <input type="text" class="form-control <?= (form_error('diskon')) ? 'is-invalid' : '' ?>" id="diskon" name="diskon" placeholder="Masukkan 0-100" value="<?= set_value('diskon') ?>">
                <small>Diskon Opsional</small>
                <div id="diskonFeedback" class="invalid-feedback">
                  <?= form_error('diskon') ?>
                </div>
              </div>
            </div>
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