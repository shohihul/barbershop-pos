<div class="container my-5">
  <div class="flashdata" data-flashdata="<?= $this->session->flashdata('pesan') ?>"></div>
  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-img"></div>
            <div class="col-lg-6">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4"><?= $title ?>!</h1>
                  <p class="mb-4">Ubah password anda untuk mengaktifkan akun!</p>
                </div>
                <form class="user" action="" method="POST">
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user <?= (form_error('oldPassword')) ? 'is-invalid' : '' ?>" id="oldPassword" name="oldPassword" aria-describedby="oldPasswordHelp" placeholder="Enter Old Password..." value="<?= set_value('oldPassword') ?>">
                    <div id="oldPasswordFeedback" class="invalid-feedback">
                      <?= form_error('oldPassword') ?>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user <?= (form_error('password1')) ? 'is-invalid' : '' ?>" id="password1" name="password1" aria-describedby="password1Help" placeholder="Enter New Password..." value="<?= set_value('password1') ?>">
                    <div id="password1Feedback" class="invalid-feedback">
                      <?= form_error('password1') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user <?= (form_error('password2')) ? 'is-invalid' : '' ?>" id="password2" name="password2" aria-describedby="password2Help" placeholder="Enter New Password..." value="<?= set_value('password2') ?>">
                    <div id="password2Feedback" class="invalid-feedback">
                      <?= form_error('password2') ?>
                    </div>
                  </div>

                  <br><br>
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Change Password
                  </button>
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="<?= site_url('auth/register') ?>">Create an Account!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>