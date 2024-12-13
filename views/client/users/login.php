<?php include_once PATH_VIEW_CLIENT . 'layout/header.php'; ?>
<section class="text-center">
  <style>
    .dark-theme {
      background-color: #121212;
      color: #fff;
    }

    .dark-theme .form-control {
      background-color: #1e1e1e;
      color: #fff;
      border: 1px solid #333;
    }

    .dark-theme .form-control:focus {
      background-color: #262626;
      color: #fff;
      box-shadow: none;
      border-color: #4caf50; /* Green highlight */
    }

    .dark-theme .form-label {
      color: #aaa;
    }

    .dark-theme .btn-primary {
      background-color: #4caf50;
      border-color: #4caf50;
    }

    .dark-theme .btn-primary:hover {
      background-color: #45a049;
    }

    .dark-theme a {
      color: #4caf50;
    }

    .dark-theme a:hover {
      text-decoration: underline;
    }

    .rounded-t-5 {
      border-top-left-radius: 0.5rem;
      border-top-right-radius: 0.5rem;
    }

    @media (min-width: 992px) {
      .rounded-tr-0 {
        border-top-right-radius: 0;
      }

      .rounded-bl-5 {
        border-bottom-left-radius: 0.5rem;
      }
    }
  </style>
  <div class="card mb-3 dark-theme">
    <div class="row g-0 d-flex align-items-center">
      <div class="col-4 d-none d-flex">
        <img src="https://product.hstatic.net/200000343865/product/27_c7eb279de1ca494cb8dca7d8f254f36e_large.jpg" alt="Trendy Pants and Shoes"
          class="w-100 rounded-t-5 rounded-tr-0 rounded-bl-5" />
      </div>
      <div class="col-8">
        <div class="card-body py-5 px-md-5">
        <?php if(isset($_SESSION['app_err'])): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <?php echo $_SESSION['app_err']; unset($_SESSION['app_err']);?>
        <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif;?>

          <form action="<?=BASE_URL . '?act=login-post'?>" method="post">
            <!-- Username input -->
            <div class="form-outline mb-4">
            <label class="form-label" >Username</label>
              <input type="username" name="username" class="form-control" />
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
            <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" />

            </div>

              <div class="col">
                <!-- Simple link -->
                <a href="#!">Forgot password?</a>
              </div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary" >Sign in</button>
          </form>

          <div class="col">
                <!-- Simple link -->
                <p>No account! <a href="<?=BASE_URL.'?act=sign-up'?>">Register</a> now!</p>
              </div>
            </div>

        </div>
      </div>
    </div>
  </div>
</section>
<?php include_once PATH_VIEW_CLIENT . 'layout/footer.php'; ?>