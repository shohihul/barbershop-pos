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
      <h6 class="m-0 font-weight-bold text-primary">Data <?= $subtitle ?></h6>
    </div>
    <div class="card-body">
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control <?= (form_error('nama')) ? 'is-invalid' : '' ?>" id="nama" name="nama" placeholder="Aksara Bulan Purnama" autofocus value="<?= set_value('nama') ?>">
              <div id="namaFeedback" class="invalid-feedback">
                <?= form_error('nama') ?>
              </div>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control <?= (form_error('email')) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="aksara@example.com" value="<?= set_value('email') ?>">
              <div id="emailFeedback" class="invalid-feedback">
                <?= form_error('email') ?>
              </div>
            </div>
            <div class="form-group">
              <label for="nohp">Nomor HP</label>
              <input type="text" class="form-control <?= (form_error('nohp')) ? 'is-invalid' : '' ?>" id="nohp" name="nohp" placeholder="08228822xxx" value="<?= set_value('nohp') ?>">
              <div id="nohpFeedback" class="invalid-feedback">
                <?= form_error('nohp') ?>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <fieldset class="form-group">
              <legend class="col-form-label pt-0">Jenis Kelamin</legend>
              <?php foreach ($jkel as $j) : ?>
                <?php if ($j['id_jenis_pelanggan'] != 3) : ?>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jkel" id="jkel<?= $j['id_jenis_pelanggan'] ?>" value="<?= $j['id_jenis_pelanggan'] ?>" <?= ($j['id_jenis_pelanggan'] == 1) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="jkel<?= $j['id_jenis_pelanggan'] ?>">
                      <?= $j['jenis_pelanggan'] ?>
                    </label>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </fieldset>

            <div class="form-group">
              <label for="role_id">Jabatan</label>
              <select class="form-control" id="role_id" name="role_id">
                <?php foreach ($role_id as $r_id) : ?>
                  <option value="<?= $r_id['role_id'] ?>"><?= $r_id['role'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="gambar">Gambar</label>
              <input type="file" class="form-control-file" id="gambar" name="gambar">
            </div>
          </div>
        </div>
        <hr class="mt-1">
        <button type="submit" class="btn btn-primary float-right mt-2">Tambah Pegawai</button>
      </form>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

  </div>
  <!-- End of Main Content -->