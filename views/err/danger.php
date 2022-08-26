<!DOCTYPE html>

<html
  lang="es"
  class="light-style"
  dir="ltr"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />


    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php  echo ASSETS;?>img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?php  echo ASSETS;?>vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php  echo ASSETS;?>vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php  echo ASSETS;?>vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php  echo ASSETS;?>css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php  echo ASSETS;?>vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?php  echo ASSETS;?>vendor/css/pages/page-misc.css" />
    <!-- Helpers -->
    <script src="<?php  echo ASSETS;?>vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php  echo ASSETS;?>js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <!--Under Maintenance -->
    <div class="container-xxl container-p-y">
      <div class="misc-wrapper">
        <h2 class="mb-2 mx-2">Parece que ya ha caducado la sesión</h2>
        <p class="mb-4 mx-2">Para volver a hacer operaciones, favor de ingresar de nuevo al sistema!</p>
        <a href="<?php echo URL;?>" class="btn btn-primary">Volver a casa</a>
        <div class="mt-4">
          <img
            src="<?php  echo ASSETS;?>img/illustrations/girl-doing-yoga-light.png"
            alt="girl-doing-yoga-light"
            width="500"
            class="img-fluid"
            data-app-dark-img="illustrations/girl-doing-yoga-dark.png"
            data-app-light-img="illustrations/girl-doing-yoga-light.png"
          />
        </div>
      </div>
    </div>


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?php  echo ASSETS;?>vendor/libs/jquery/jquery.js"></script>
    <script src="<?php  echo ASSETS;?>vendor/libs/popper/popper.js"></script>
    <script src="<?php  echo ASSETS;?>vendor/js/bootstrap.js"></script>
    <script src="<?php  echo ASSETS;?>vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?php  echo ASSETS;?>vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<?php  echo ASSETS;?>js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
