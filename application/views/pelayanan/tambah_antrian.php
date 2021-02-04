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
              <label for="id_pelanggan">ID Pelanggan</label>
              <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" value="<?= $pelanggan['id_pelanggan']; ?>" required readonly>
            </div>
            <div class="form-group">
              <label for="nama_pelanggan">Nama Pelanggan</label>
              <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= $pelanggan['nama']; ?>" required readonly>
            </div>

            <div class="form-group">
              <label for="barber">Barber</label>
              <select class="form-control" id="barber" name="barber" autofocus>
                <option value="">Pilih Barber</option>
                <?php foreach ($barber as $b) : ?>
                  <option value="<?= $b['id_pegawai'] ?>"><?= $b['nama'] ?></option>
                <?php endforeach; ?>
              </select>
              <small id="layanan2Help" class="form-text text-muted">
                Pemilihan barber opsional, bisa dipilih nanti pada saat akan dilayani di tab antrian
              </small>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group mt-3">
              <label for="layanan1">Pilih Pelayanan</label>
              <select class="form-control <?= (form_error('layanan1')) ? 'is-invalid' : '' ?>" id="layanan1" name="layanan1">
                <option value="">Pilih Layanan</option>
                <?php foreach ($jasa as $js) : ?>
                  <option value="<?= $js['id_jasa'] ?>"><?= $js['jasa'] ?></option>
                <?php endforeach; ?>
              </select>
              <small id="layanan2Help" class="form-text text-muted">
                Pemilihan layanan wajib diisi!
              </small>
              <div id="namaFeedback" class="invalid-feedback">
                <?= form_error('layanan1') ?>
              </div>
            </div>
            <div class="form-group">
              <label for="layanan2">Pilih Pelayanan Tambahan</label>
              <select class="form-control" id="layanan2" name="layanan2">
                <option value="">Pilih Layanan</option>
                <?php foreach ($jasa as $js) : ?>
                  <option value="<?= $js['id_jasa'] ?>"><?= $js['jasa'] ?></option>
                <?php endforeach; ?>
              </select>
              <small id="layanan2Help" class="form-text text-muted">
                Layanan tambahan opsional
              </small>
            </div>

          </div>
        </div>
        <button type="submit" class="btn btn-primary float-right mt-2">Tambah Antrian</button>
      </form>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

  </div>
  <!-- End of Main Content -->