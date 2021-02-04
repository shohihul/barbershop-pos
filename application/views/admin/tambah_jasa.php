<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="flashdata" data-flashdata="<?= $this->session->flashdata('pesan') ?>"></div>

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $subtitle ?></h1>
  </div>
  <!-- Page Breadcrumb -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= $url_title ?>"><?= $title ?></a></li>
      <li class="breadcrumb-item active" aria-current="page"><?= $subtitle ?></li>
    </ol>
  </nav>

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-primary"><?= $subtitle ?></h6>
    </div>
    <div class="card-body">
      <form action="" method="POST">
        <div class=" row">
          <div class="col-lg-6">
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
        <button type="submit" class="btn btn-primary float-right mt-2">Tambah Member</button>
      </form>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

  </div>
  <!-- End of Main Content -->