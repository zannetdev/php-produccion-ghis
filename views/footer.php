<?php
if (Session::get('loggedIn')) {
?>
  <button class="waves-effect waves-light btn-dark btn btn-circle btn-up" style="bottom: 100px"><i class="mdi mdi-arrow-up-bold-circle-outline text-white md-24"></i></button>
  <button class="waves-effect waves-light btn-dark btn btn-circle btn-down" style="bottom: 40px"><i class="mdi mdi-arrow-down-bold-circle-outline text-white md-24"></i></button>
  </div>
  <!-- Footer -->
  <footer class="content-footer footer bg-footer-theme" id="foo">
    <div class="container-fluid d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column text-center">
      <div class="mb-2 mb-md-0">
        © <?php echo date("Y"); ?><a href="https://ghisflex.com/" target="_blank" class="footer-link fw-bolder">&nbsp;Ghisflex</a>
      </div>
    </div>
  </footer>
  <div class="content-backdrop fade"></div>
  </div>
  <!-- Content wrapper -->
  </div>
  <!-- / Layout page -->
  </div>

  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
  </div>

  <!-- build:js assets/vendor/js/core.js -->
  <script src="<?php echo ASSETS; ?>vendor/libs/jquery/jquery.js"></script>
  <reference path="<?php echo URL; ?>globals/jquery/index.d.ts" />
  <script src="<?php echo ASSETS; ?>vendor/js/bootstrap.js"></script>
  <script src="<?php echo ASSETS; ?>vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.8/holder.min.js" integrity="sha512-O6R6IBONpEcZVYJAmSC+20vdsM07uFuGjFf0n/Zthm8sOFW+lAq/OK1WOL8vk93GBDxtMIy6ocbj6lduyeLuqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="<?php echo ASSETS; ?>vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="<?php echo ASSETS; ?>vendor/libs/apex-charts/apexcharts.js"></script>

  <!-- Main JS -->

  <script src="<?php echo ASSETS; ?>js/main.js"></script>
  <script src="<?php echo ASSETS; ?>js/waves.js"></script>
  <script src="<?php echo ASSETS; ?>js/currency.js"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
  <!-- Page JS -->
  <script src="<?php echo ASSETS; ?>js/dashboards-analytics.js"></script>
  <script src="<?php echo URL; ?>logic/js/session_manager.js<?php echo version_factorize(); ?>"></script>
  <script src="<?php echo URL; ?>logic/js/aper_get.js<?php echo version_factorize(); ?>"></script>
  <script src="<?php echo URL; ?>logic/js/functions_helpers.js<?php echo version_factorize(); ?>"></script>
  <script src="<?php echo URL; ?>logic/js/active_class.js<?php echo version_factorize(); ?>"></script>
  <script src="<?php echo ASSETS; ?>js/jquery.dataTables.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js" integrity="sha512-yrOmjPdp8qH8hgLfWpSFhC/+R9Cj9USL8uJxYIveJZGAiedxyIxwNw4RsLDlcjNlIRR4kkHaDHSmNHAkxFTmgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js" integrity="sha512-yrOmjPdp8qH8hgLfWpSFhC/+R9Cj9USL8uJxYIveJZGAiedxyIxwNw4RsLDlcjNlIRR4kkHaDHSmNHAkxFTmgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="https://momentjs.com/downloads/moment.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8-beta.17/jquery.inputmask.min.js" integrity="sha512-zdfH1XdRONkxXKLQxCI2Ak3c9wNymTiPh5cU4OsUavFDATDbUzLR+SYWWz0RkhDmBDT0gNSUe4xrQXx8D89JIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.min.js"></script>
  <script type="text/javascript" src="<?php echo ASSETS; ?>dtp/materialDateTimePicker.js"></script>

  <?php
  if ($_SESSION['rol'] != 4) {
  ?>
    <script src="<?php echo URL; ?>core/services/operations.js<?php echo version_factorize(); ?>"></script>
  <?php
  }
  ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<?php
}
?>
<script src="<?php echo URL; ?>core/services/connections.js<?php echo version_factorize(); ?>"></script>
<script src="<?php echo URL; ?>core/info/info_app.js<?php echo version_factorize(); ?>"></script>


<?php
initialize_resources('js', $this->js);
?>
<script src="<?php echo URL; ?>core/services/notifications.js<?php echo version_factorize(); ?>"></script>

<script src="<?php echo URL; ?>logic/js/components.js<?php echo version_factorize(); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/buzz/1.2.1/buzz.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>
  $('.btn-up').on("click", function() {
    var posicion = $('#layout-navbar').offset().top;
    $('html,body').animate({
      scrollTop: posicion
    }, 100);
  });

  $('.btn-down').on("click", function() {
    var posicion = $('#foo').offset().top;
    $('html,body').animate({
      scrollTop: posicion
    }, 100);
  });
</script>
</body>

</html>