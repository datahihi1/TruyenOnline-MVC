<?php include_once PATH_VIEW_CLIENT . 'layout/header.php'; ?>
<section class="dark-theme-section overflow-hidden">
  <style>
    /* Dark Theme Section */
    .dark-theme-section {
      /*background-image: url('https://via.placeholder.com/1920x1080'); Replace with your image URL */
      background-size: cover;
      background-position: center;
      color: #fff;
    }

    /* Shapes for decoration */
    #radius-shape-1 {
      height: 220px;
      width: 220px;
      top: -60px;
      left: -130px;
      background: radial-gradient(#6a11cb, #2575fc);
      overflow: hidden;
    }

    #radius-shape-2 {
      border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
      bottom: -60px;
      right: -110px;
      width: 300px;
      height: 300px;
      background: radial-gradient(#6a11cb, #2575fc);
      overflow: hidden;
    }

    /* Glass Effect Card */
    .bg-glass {
      background-color: rgba(0, 0, 0, 0.6);
      backdrop-filter: saturate(200%) blur(20px);
    }

    /* Dark Inputs */
    .form-control {
      background-color: #333;
      /* Dark background for input fields */
      color: #fff;
      /* White text for input */
      border: 1px solid #444;
      /* Subtle border */
    }

    .form-control:focus {
      background-color: #444;
      /* Slightly lighter on focus */
      border-color: #6a11cb;
      /* Add focus effect with gradient color */
      box-shadow: 0 0 5px rgba(106, 17, 203, 0.5);
      /* Glow effect */
      color: #fff;
    }

    .form-label {
      color: #bbb;
      /* Light gray for labels */
    }

    /* Buttons and Links */
    .dark-theme-section .btn-primary {
      background-color: #6a11cb;
      border: none;
    }

    .dark-theme-section .btn-primary:hover {
      background-color: #2575fc;
    }

    .dark-theme-section a {
      color: #6a11cb;
    }

    .dark-theme-section a:hover {
      color: #2575fc;
    }
  </style>

  <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
    <div class="row gx-lg-5 align-items-center mb-5">
      <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
        <h1 class="my-5 display-5 fw-bold ls-tight">
          The best offer <br />
          <span style="color: #6a11cb">for your business</span>
        </h1>
        <p class="mb-4 opacity-70">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus, expedita iusto veniam atque, magni tempora mollitia dolorum consequatur nulla, neque debitis eos reprehenderit quasi ab ipsum nisi dolorem modi. Quos?
        </p>
      </div>

      <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
        <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

        <div class="card bg-glass">

          <div class="card-body px-4 py-5 px-md-5">

            <?php if (isset($_SESSION['app_err'])): ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['app_err'];
                unset($_SESSION['app_err']); ?>
                <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>

            <form action="<?= BASE_URL . '?act=sign-up-post' ?>" method="post" enctype="multipart/form-data">
              <!-- Email input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" name="username" class="form-control" />
                <label class="form-label" for="username">Username</label>
              </div>

              <!-- Email input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" name="email" class="form-control" />
                <label class="form-label" for="email">Email address</label>
              </div>

              <!-- Password input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" name="password" class="form-control" />
                <label class="form-label" for="password">Password</label>
              </div>
              <!-- Password input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="file" name="avatar" class="form-control" />
                <label class="form-label" for="avatar">Avatar</label>
              </div>

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4">
                Sign up
              </button>

              <p>Have account! <a href="<?= BASE_URL . '?act=login' ?>">Login</a> here!</p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include_once PATH_VIEW_CLIENT . 'layout/footer.php'; ?>