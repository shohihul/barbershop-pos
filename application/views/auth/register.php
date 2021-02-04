<div class="container my-5 py-5">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-5 d-none d-lg-block bg-register-img"></div>
        <div class="col-lg-7">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              <h1 class="h6 text-gray-900 font-weight-bold">Don't have an account?</h1>
              <p>Contact karisma barbershop Web Admin to make an account!</p>
              <br><br>
              <a href='#' class="btn btn-block btn-outline-primary" onClick="document.location.href='mailto:blazzerjfc1234@gmail.com'">Contact Admin</a>
            </div>

            <!-- <form class="user">
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name">
                </div>
                <div class="col-sm-6">
                  <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name">
                </div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                </div>
                <div class="col-sm-6">
                  <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                </div>
              </div>
              <a href="login.html" class="btn btn-primary btn-user btn-block">
                Register Account
              </a>
              <hr>
            </form> -->
            <hr>
            <div class="text-center">
              <a class="small" href="<?= site_url('auth/forgot_password') ?>">Forgot Password?</a>
            </div>
            <div class="text-center">
              <a class="small" href="<?= site_url('auth/') ?>">Already have an account? Login!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>