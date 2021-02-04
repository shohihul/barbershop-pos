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
                  <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                </div>
                <form class="user" action="" method="POST">
                  <div class="form-group">
                    <input type="email" class="form-control form-control-user <?= (form_error('email')) ? 'is-invalid' : '' ?>" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." value="<?= set_value('email') ?>">
                    <div id="emailFeedback" class="invalid-feedback">
                      <?= form_error('email') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user <?= (form_error('password')) ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Password">
                    <div id="emailFeedback" class="invalid-feedback">
                      <?= form_error('password') ?>
                    </div>
                  </div>
                  <br><br>
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Login
                  </button>
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="<?= site_url('auth/forgot_password') ?>">Forgot Password?</a>
                </div>
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