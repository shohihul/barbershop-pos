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
      <a href="<?= site_url('pelayanan/tambah_member') ?>" class="m-0 btn btn-primary"><i class="fas fa-user-plus text-white-50"></i> Tambah <?= $title ?></a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr class="bg-primary text-white">
              <th>No</th>
              <th>ID Member</th>
              <th>Nama</th>
              <th>Nomor HP</th>
              <th>Instagram</th>
              <th>Jenis Pelanggan</th>
              <th>Member Sejak</th>
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
            <?php foreach ($member as $m) : ?>
              <tr>
                <th><?= $i++; ?></th>
                <td><?= $m['id_pelanggan'] ?></td>
                <td><?= $m['nama'] ?></td>
                <td><?= $m['nohp'] ?></td>
                <td><?= $m['ig'] ?></td>
                <?php $jpel = $this->pelayanan->getJenisPelangganByID($m['jenis_pelanggan']); ?>
                <td><?= $jpel['jenis_pelanggan'] ?></td>
                <td><?= $m['member_sejak'] ?></td>
                <td style="width: 15%;">
                  <a href="<?= site_url('pelayanan/tambah_antrian/' . $m['id_pelanggan'] . '') ?>" class="btn btn-sm btn-success tombol-tambah-antrian">Antrian</a>
                  <a href="#" class="btn btn-sm btn-primary tombol-edit-member" data-toggle="modal" data-target="#modalEditMember" data-id="<?= $m['id_pelanggan'] ?>"><i class="fas fa-edit"></i></a>
                  <a href="#" data-href="<?= site_url('pelayanan/hapus_member') ?>" data-id="<?= $m['id_pelanggan'] ?>" data-redirect="<?= site_url('pelayanan/member_area') ?>" class="btn btn-sm btn-danger tombol-hapus"><i class="fas fa-fw fa-trash"></i></a>
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



<!-- Modal Edit Member-->
<div class="modal fade my-5" id="modalEditMember" tabindex="-1" aria-labelledby="modalEditMemberLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditMemberLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          <div class=" row">
            <div class="col-lg-6">
              <input type="hidden" name="id" id="id">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control <?= (form_error('nama')) ? 'is-invalid' : '' ?>" id="nama" name="nama" placeholder="Aksara Bulan Purnama" autofocus value="<?= set_value('nama') ?>">
                <div id="namaFeedback" class="invalid-feedback">
                  <?= form_error('nama') ?>
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
              <div class="form-group">
                <label for="ig">Instagram</label>
                <input type="text" class="form-control <?= (form_error('ig')) ? 'is-invalid' : '' ?>" id="ig" name="ig" placeholder="@karisma_ig" value="<?= set_value('ig') ?>">
                <div id="igFeedback" class="invalid-feedback">
                  <?= form_error('ig') ?>
                </div>
              </div>

              <fieldset class="form-group">
                <legend class="col-form-label pt-0">Jenis Pelanggan</legend>
                <?php $jenpel = $this->pelayanan->getJenisPelanggan() ?>
                <?php foreach ($jenpel as $jp) : ?>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input jpel" type="radio" name="jpel" id="jpel<?= $jp['id_jenis_pelanggan'] ?>" value="<?= $jp['id_jenis_pelanggan'] ?>">
                    <label class="form-check-label" for="jpel<?= $jp['id_jenis_pelanggan'] ?>">
                      <?= $jp['jenis_pelanggan'] ?>
                    </label>
                  </div>
                <?php endforeach; ?>
              </fieldset>
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



<!-- Modal Tambah Antrian -->
<div class="modal fade" id="modalTambahAntrian" tabindex="-1" aria-labelledby="modalTambahAntrianLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahAntrianLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('pelayanan/tambah_antrian') ?>" method="POST">
          <input type="hidden" name="id_pelanggan" id="antrian_id_pelanggan">
          <div class="form-group">
            <label for="barber">Barber</label>
            <select class="form-control" id="barber" name="barber">
              <option value="">Pilih Barber</option>
              <?php foreach ($barber as $b) : ?>
                <option value="<?= $b['id_pegawai'] ?>"><?= $b['nama'] ?></option>
              <?php endforeach; ?>
            </select>
            <small id="layanan2Help" class="form-text text-muted">
              Pemilihan barber opsional, bisa dipilih nanti pada saat akan dilayani di tab antrian
            </small>
          </div>
          <hr class="my-1">
          <div class="form-group mt-3">
            <label for="layanan1">Pilih Pelayanan</label>
            <select class="form-control" id="layanan1" name="layanan1">
              <option value="">Pilih Layanan</option>
              <?php foreach ($jasa as $js) : ?>
                <option value="<?= $js['id_jasa'] ?>"><?= $js['jasa'] ?></option>
              <?php endforeach; ?>
            </select>
            <small id="layanan2Help" class="form-text text-muted">
              Pemilihan layanan wajib diisi!
            </small>
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>