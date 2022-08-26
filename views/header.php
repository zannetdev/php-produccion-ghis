<?php
if (Session::get('loggedIn')) {
?>
  <!DOCTYPE html>
  <html lang="es" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="<?php echo ASSETS; ?>" data-template="vertical-menu-template-free">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Ghisflex Producción</title>

    <meta name="description" content="Sistema hecho para la producción de modelos en el negocio de ghisflex, peru, huancayo" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo ASSETS; ?>img/favicon/favicon.ico" />
    <link rel="manifest" href="<?php echo ASSETS; ?>manifest/manifest.json">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
<style>
      body.swal2-shown>[aria-hidden=true] {
        transition: .1s filter;
        filter: blur(10px) grayscale(90%)
      }

      .slow .toggle-group {
        transition: left 0.7s;
        -webkit-transition: left 0.7s;
      }
    </style>

    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <!-- Icons. Uncomment required icon fonts -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo ASSETS; ?>vendor/css/core.css<?php echo version_factorize(); ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo ASSETS; ?>vendor/css/theme-default.css<?php echo version_factorize(); ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo ASSETS; ?>css/demo.css<?php echo version_factorize(); ?>" />
    <link rel="stylesheet" href="<?php echo ASSETS; ?>particles/style.css<?php echo version_factorize(); ?>" />


    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo ASSETS; ?>vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="<?php echo ASSETS; ?>vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="<?php echo ASSETS; ?>dtp/materialDateTimePicker.css" />

    <!-- Helpers -->
    <script src="<?php echo ASSETS; ?>vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php echo ASSETS; ?>js/config.js"></script>
    <?php
    initialize_resources('css', $this->css);
    ?>
    <input type="hidden" id="assets" value="<?php echo ASSETS; ?>">
    <input type="hidden" id="url" value="<?php echo URL; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

  </head>

  <body>


    <div class="global_variables">
      <input type="hidden" id="id_apc" value="<?php echo Session::get('id_apc'); ?>">
      <input type="hidden" id="id_rol" value="<?php echo Session::get('rol'); ?>">
      <input type="hidden" id="id_usu" value="<?php echo Session::get('usuid'); ?>">
      <input type="hidden" id="pc_ip" value="<?php echo $_SESSION['empresa']->ip_principal; ?>">
      <input type="hidden" id="imp_principal" value="<?php echo $_SESSION['impresora_principal']; ?>">

      <?php
      if (Session::get('rol') == 3) {
      ?>
        <input type="hidden" id="id_area" value="<?php echo $_SESSION['usuario']->id_area; ?>">
      <?php
      }
      ?>
    </div>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="<?php echo URL; ?>" class="app-brand-link">
              <span class="app-brand-logo demo">
                <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <defs>
                    <path d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z" id="path-1"></path>
                    <path d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z" id="path-3"></path>
                    <path d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z" id="path-4"></path>
                    <path d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z" id="path-5"></path>
                  </defs>
                  <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                      <g id="Icon" transform="translate(27.000000, 15.000000)">
                        <g id="Mask" transform="translate(0.000000, 8.000000)">
                          <mask id="mask-2" fill="white">
                            <use xlink:href="#path-1"></use>
                          </mask>
                          <use fill="#696cff" xlink:href="#path-1"></use>
                          <g id="Path-3" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-3"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                          </g>
                          <g id="Path-4" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-4"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                          </g>
                        </g>
                        <g id="Triangle" transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                          <use fill="#696cff" xlink:href="#path-5"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">Ghisflex</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <?php
            if (Session::get('rol') == 1 || Session::get('rol') == 2) {
            ?>
              <li class="menu-item" id="tablero">
                <a href="<?php echo URL; ?>" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Analytics">Tablero</div>
                </a>
              </li>
              <li class="menu-item" id="crear_pedido">
                <a href="<?php echo URL; ?>pedidos" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-log-in-circle"></i>
                  <div data-i18n="Analytics">Crear pedido</div>
                </a>
              </li>
              <li class="menu-item" id="pedidos">
                <a href="<?php echo URL; ?>pedidos/pedidos" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-time-five"></i>
                  <div data-i18n="Analytics">Pedidos</div>
                </a>
              </li>
              <li class="menu-item" id="pedidospc">
                <a href="<?php echo URL; ?>pedidos/por_confirmar" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-time-five"></i>
                  <div data-i18n="Analytics">Por confirmar</div>
                </a>
              </li>
              <li class="menu-item" id="proceso">
                <a href="<?php echo URL; ?>pedidos/proceso" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-bolt-circle"></i>
                  <div data-i18n="Analytics">Procesos</div>
                </a>
              </li>
              <li class="menu-item" id="credito">
                <a href="<?php echo URL; ?>creditos/" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-log-in-circle"></i>
                  <div data-i18n="Analytics">Creditos</div>
                </a>
              </li>
              <li class="menu-item" id="apertura">
                <a href="<?php echo URL; ?>apertura" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-briefcase"></i>
                  <div data-i18n="Analytics">Apertura y Cierre&nbsp;&nbsp;<?php
                                                                          if (Session::get('id_apc') != '-') {
                                                                            echo '<span class="flex-shrink-0 badge badge-center rounded-pill bg-info w-px-20 h-px-20">✓</span>';
                                                                          } else {
                                                                            echo '<span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">x</span>';
                                                                          }
                                                                          ?></div>
                </a>
              </li>
              <li class="menu-item" id="inventario">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-layout"></i>
                  <div data-i18n="Layouts">Inventario</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item" id="inv_modelos">
                    <a href="<?php echo URL; ?>inventario/modelos" class="menu-link">
                      <div data-i18n="Without menu">Modelos</div>
                    </a>
                  </li>
                  <li class="menu-item" id="inv_material">
                    <a href="<?php echo URL; ?>inventario/materiales" class="menu-link">
                      <div data-i18n="Container">Materiales</div>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Usuarios</span>
              </li>
              <li class="menu-item" id="empleados">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-dock-top"></i>
                  <div data-i18n="Account Settings">Empleados</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item" id="emp_clientes">
                    <a href="<?php echo URL; ?>usuario/clientes" class="menu-link">
                      <div data-i18n="Account">Lista Clientes</div>
                    </a>
                  </li>
                  <li class="menu-item" id="emp_empleado">
                    <a href="<?php echo URL; ?>usuario/empleados" class="menu-link">
                      <div data-i18n="Account">Lista Empleados</div>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="menu-header small text-uppercase"><span class="menu-header-text">Informes</span></li>
              <!-- Cards -->
              <li class="menu-item" id="informes">
                <a href="<?php echo URL; ?>informes/" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-collection"></i>
                  <div data-i18n="Basic">Informes</div>
                </a>
              </li>

              <li class="menu-header small text-uppercase"><span class="menu-header-text">Ajustes</span></li>
              <!-- Cards -->
              <li class="menu-item" id="ajustes">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-cog"></i>
                  <div data-i18n="Layouts">Ajustes</div>
                </a>

                <ul class="menu-sub">
                  <li class="menu-item" id="aj_ajustes">
                    <a href="<?php echo URL; ?>ajustes/" class="menu-link">
                      <div data-i18n="Container">Ajustes Generales</div>
                    </a>
                  </li>
                </ul>
              </li>
            <?php
            }
            ?>
            <?php
            if (Session::get('rol') == 3) {
            ?>
              <li class="menu-item" id="area">
                <a href="<?php echo URL; ?>area" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-buildings"></i>
                  <div data-i18n="Analytics">Area de producción</div>
                </a>
              </li>
              <li class="menu-item" id="trabajos">
                <a href="<?php echo URL; ?>area/mis_trabajos" / class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Analytics">Mis Trabajos</div>
                </a>
              </li>
              <li class="menu-item" id="terminados">
                <a href="<?php echo URL; ?>area/terminados" / class="menu-link">
                  <i class="menu-icon tf-icons bx bx-hard-hat"></i>
                  <div data-i18n="Analytics">Trabajos Terminados</div>
                </a>
              </li>

            <?php
            }
            ?>
            <?php
            if (Session::get('rol') == 4) {
            ?>
              <li class="menu-item" id="clientepedido">
                <a href="<?php echo URL; ?>cliente/" class="menu-link">

                  <i class="menu-icon tf-icons bx bxs-cart-add"></i>
                  <div data-i18n="Analytics">Nuevo Pedido</div>
                </a>
              </li>
              <li class="menu-item" id="mispedidos">
                <a href="<?php echo URL; ?>cliente/mis_pedidos" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-component"></i>
                  <div data-i18n="Analytics">Mis pedidos</div>
                </a>
              </li>


            <?php
            }
            ?>
            <!-- Misc -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
            <li class="menu-item">

              <a href="mailto:randellcode@outlook.es?subject=Soporte%20sistema%20ghisflex&body=Hola%2C%20tengo%20un%20problema%20con%20el%20sistema%20de%20ghisflex%20y%20quer%C3%ADa%20ver%20como%20puedo%20resolver%3A" target="_blank" class="menu-link">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Soporte</div>
              </a>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav class="layout-navbar container-lg navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="mdi mdi-menu-open bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <div class="input-group col-12">

                    <button class="btn btn-outline-primary" type="button">SUNAT <img src="<?php echo URL ?>public/assets/sunat.png" style="width: 20px;" alt=""></button>

                  </div>
                </div>
              </div>

              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">


                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <?php
                      if ($_SESSION['usuario']->genero == 'M') {
                        $g = 'hombre.jpg';
                      } else {
                        if ($_SESSION['usuario']->genero == 'F') {
                          $g = 'mujer.jpg';
                        }
                      }
                      ?>
                      <img src="<?php echo ASSETS; ?>img/genres/<?php echo $g; ?>" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">

                              <img src="<?php echo ASSETS; ?>img/genres/<?php echo $g; ?>" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?php echo $_SESSION['rol_name'] ?></span>
                            <small class="text-muted"><?php echo  $_SESSION['usuario']->nombre . ' ' . $_SESSION['usuario']->apellido_paterno ?></small>
                          </div>
                        </div>
                      </a>
                    </li>

                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item logout" href="javascript:void(0);">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Cerrar Sesión</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-lg container-p-y">

              <!-- / Navbar -->
            <?php
          }
            ?>