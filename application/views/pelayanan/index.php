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

      <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="antrian-tab" data-toggle="tab" href="#antrian" role="tab" aria-controls="antrian" aria-selected="true"><i class="fas fa-list-ol pr-2"></i>Antrian</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link tab-pelayanan" id="pelayanan-tab" data-toggle="tab" href="#pelayanan" role="tab" aria-controls="pelayanan" aria-selected="false"><i class="far fa-heart pr-2"></i>Dalam Pelayanan</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="antrian" role="tabpanel" aria-labelledby="antrian-tab">
          <div class="table-responsive">
            <div class="d-flex justify-content-end mb-2">
              <button class="m-0 btn btn-info btn-sm" data-toggle="modal" data-target="#tambahAntrianModal"><i class="fas fa-user-plus text-white-50"></i> Tambah Antrian</button>
            </div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr class="bg-info text-white">
                  <th>No Antrian</th>
                  <th>ID Member</th>
                  <th>Nama</th>
                  <th>No Hp</th>
                  <th>Barber</th>
                  <th>Jam Daftar</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <!-- <tfoot>
            <tr class="bg-info text-white">
              <th>No Antrian</th>
              <th>ID Member</th>
              <th>Nama</th>
              <th>No Hp</th>
              <th>Jam Daftar</th>
              <th>Aksi</th>
            </tr>
          </tfoot> -->
              <tbody>
                <?php $i = 1; ?>

                <?php foreach ($pelangganAntri as $pa) : ?>
                  <tr>
                    <th><?= $i++; ?></th>
                    <td><?= $pa['id_pelanggan'] ?></td>
                    <td><?= $pa['nama'] ?></td>
                    <td><?= $pa['nohp'] ?></td>
                    <td><?= $pa['nama_barber'] ?></td>
                    <td><?= $pa['check_in'] ?></td>
                    <td><a href="#" class="badge badge-warning">Dalam Antrian</a></td>
                    <td>
                      <div class="d-flex d-inline">
                        <a href="<?= site_url('pelayanan/add_layanan/' . $pa['id_kunjungan'] . '') ?>" class="btn btn-success btn-sm tombol-layani">Layani</a>
                        <button data-id="<?= $pa['id_kunjungan'] ?>" data-href="<?= site_url('pelayanan/hapus_antrian') ?>" data-redirect="<?= site_url('pelayanan') ?>" class="btn btn-danger btn-sm ml-1 tombol-hapus"><i class="fas fa-fw fa-trash"></i></button>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

        <!-- --------------------------------------------------------------------------------------------------- -->

        <div class="tab-pane fade" id="pelayanan" role="tabpanel" aria-labelledby="pelayanan-tab">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
              <thead>
                <tr class="bg-success text-white">
                  <th>No Antrian</th>
                  <th>ID Member</th>
                  <th>Nama</th>
                  <th>No Hp</th>
                  <th>Barber</th>
                  <th>Jam Daftar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <!-- <tfoot>
            <tr class="bg-info text-white">
              <th>No Antrian</th>
              <th>ID Member</th>
              <th>Nama</th>
              <th>No Hp</th>
              <th>Jam Daftar</th>
              <th>Aksi</th>
            </tr>
          </tfoot> -->
              <tbody>
                <?php $i = 1; ?>

                <?php foreach ($pelanggan as $p) : ?>
                  <tr>
                    <th><?= $i++; ?></th>
                    <td><?= $p['id_pelanggan'] ?></td>
                    <td><?= $p['nama_pelanggan'] ?></td>
                    <td><?= $p['nohp_pelanggan'] ?></td>
                    <td><?= $p['nama_barber'] ?></td>
                    <td><?= $p['check_in'] ?></td>
                    <td>
                      <div class="d-flex d-inline">
                        <a href="<?= site_url('pelayanan/pembayaran/' . $p['id_kunjungan'] . '') ?>" class="btn btn-success btn-sm tombol-layani">Bayar</a>
                        <button data-id="<?= $p['id_kunjungan'] ?>" data-href="<?= site_url('pelayanan/hapus_antrian') ?>" data-redirect="<?= site_url('pelayanan') ?>" class="btn btn-danger btn-sm ml-1 tombol-hapus"><i class="fas fa-fw fa-trash"></i></button>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>




    </div>
  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

</div>
<!-- End of Main Content -->




<!-- Modal Layani -->
<div class="modal fade" id="tambahAntrianModal" tabindex="-1" aria-labelledby="tambahAntrianModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahAntrianModalLabel">Tambah Antrian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group float-right">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="live_search" name="live_search" autofocus>
        </div>
        <form action="">

          <div id="result-live-search">

          </div>

        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>