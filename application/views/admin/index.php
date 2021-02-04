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
      <a href="<?= site_url('admin/tambah_pegawai') ?>" class="mt-2 btn btn-primary"><i class="fas fa-plus text-white-50"></i> Tambah <?= $title ?></a>
    </div>
    <div class="card-body">
      <!-- Table -->
      <div class="table-responsive">
        <table class="table table-hover" id="dataTable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Gambar</th>
              <th scope="col">Email</th>
              <th scope="col">No Hp</th>
              <th scope="col">Jenis Kelamin</th>
              <th scope="col">Jabatan</th>
              <th scope="col">Status</th>
              <th scope="col">Aktif</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($pegawai as $p) :
            ?>
              <tr>
                <th class="align-middle"><?= $i++ ?></th>
                <td class="align-middle"><?= $p['nama'] ?></td>
                <td class="align-middle"><img src="<?= base_url('public/image/pegawai/' . $p['gambar'] . '') ?>" alt="imgProfile" width="70" class="img img-fluid img-thumbnail rounded-circle"></td>
                <td class="align-middle"><?= $p['email'] ?></td>
                <td class="align-middle"><?= $p['nohp'] ?></td>
                <?php $jkel = $this->admin->getJkelByID($p['jkel']); ?>
                <td class="align-middle"><?= $jkel['jenis_pelanggan'] ?></td>
                <?php $jabatan = $this->admin->getJabatanByID($p['role_id']); ?>
                <td class="align-middle"><?= $jabatan['role'] ?></td>
                <td class="align-middle">
                  <div class="form-check" style="margin-top: -10px;">
                    <input class="form-check-input check-peg-active <?= ($p['role_id'] == 1) ? 'd-none' : '' ?>" type="checkbox" id="active" name="active" <?= check_active_pegawai($p['id_pegawai']) ?> data-idpeg="<?= $p['id_pegawai'] ?>">
                  </div>
                </td>
                <td class="align-middle">
                  <div class="d-inline">
                    <button class="btn btn-sm btn-danger tombol-hapus <?= ($p['role_id'] == 1) ? 'd-none' : '' ?>" data-href="<?= site_url('admin/hapus_pegawai') ?>" data-id="<?= $p['id_pegawai'] ?>" data-redirect="<?= site_url('admin') ?>">Hapus</button>
                  </div>
                  <button class="btn btn-sm btn-primary tombol-editpegawai" data-toggle="modal" data-target="#modalEditPegawai" data-id="<?= $p['id_pegawai'] ?>">Edit</button>
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
<div class="modal fade" id="modalEditPegawai" tabindex="-1" aria-labelledby="modalEditPegawaiLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditPegawaiLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('admin/update_pegawai') ?>" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-lg-6">
              <input type="hidden" name="id_pegawai" id="id_pegawai">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Aksara Bulan Purnama" autofocus value="<?= set_value('nama') ?>">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="aksara@example.com" value="<?= set_value('email') ?>">
              </div>
              <div class="form-group">
                <label for="nohp">Nomor HP</label>
                <input type="text" class="form-control" id="nohp" name="nohp" placeholder="08228822xxx" value="<?= set_value('nohp') ?>">
              </div>
            </div>
            <div class="col-lg-6">
              <fieldset class="form-group">
                <legend class="col-form-label pt-0">Jenis Kelamin</legend>
                <?php
                $jkel = $this->admin->getJkel();
                foreach ($jkel as $j) :
                ?>
                  <?php if ($j['id_jenis_pelanggan'] != 3) : ?>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input jkel" type="radio" name="jkel" id="jkel<?= $j['id_jenis_pelanggan'] ?>" value="<?= $j['id_jenis_pelanggan'] ?>">
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
                  <?php
                  $role_id = $this->admin->getRoleId();
                  foreach ($role_id as $r_id) :
                  ?>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>