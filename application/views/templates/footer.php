</div>
    <!--end::App Wrapper-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <script src="<?php echo base_url('Template/dist/js/adminlte.js'); ?>"></script>
    <!--end::Required Plugin(AdminLTE)-->

    <!-- Custom script for sidebar toggle -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const masterLink = document.getElementById('sb-master');
        const masterHead = document.getElementById('sb-master-head');
        
        if (masterLink && masterHead) {
          masterLink.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Toggle menu-open class
            masterHead.classList.toggle('menu-open');
            
            // Toggle submenu visibility
            const submenu = masterHead.querySelector('.nav-treeview');
            if (submenu) {
              if (masterHead.classList.contains('menu-open')) {
                submenu.style.display = 'block';
              } else {
                submenu.style.display = 'none';
              }
            }
            
            // Toggle chevron icon
            const icon = this.querySelector('.bi-chevron-right');
            if (icon) {
              if (masterHead.classList.contains('menu-open')) {
                icon.classList.remove('bi-chevron-right');
                icon.classList.add('bi-chevron-down');
              } else {
                icon.classList.remove('bi-chevron-down');
                icon.classList.add('bi-chevron-right');
              }
            }
          });
        }
      });
    </script>
  </body>
  <!--end::Body-->
</html>
