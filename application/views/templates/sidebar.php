<!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="<?php echo base_url('dashboard'); ?>" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="<?php echo base_url('Template/dist/assets/img/AdminLTELogo.png'); ?>"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Amazing People GC</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="navigation"
              aria-label="Main navigation"
              data-accordion="false"
              id="navigation"
            >
              <li class="nav-item">
                <a href="<?php echo base_url('dashboard'); ?>" class="nav-link <?php echo isset($active_dashboard) ? $active_dashboard : ''; ?>">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('dashboard/request'); ?>" class="nav-link <?php echo isset($active_request) ? $active_request : ''; ?>">
                  <i class="nav-icon bi bi-clipboard-check"></i>
                  <p>Request</p>
                </a>
              </li>
              <?php if ($role != 'external'): ?>
              <li class="nav-item">
                <a href="<?php echo base_url('pengerjaan'); ?>" class="nav-link <?php echo isset($active_pengerjaan) ? $active_pengerjaan : ''; ?>">
                  <i class="nav-icon bi bi-clipboard-check"></i>
                  <p>Pengerjaan</p>
                </a>
              </li>
              <?php endif; ?>
             <?php if ($role == 'it_manager'): ?>
              <li class="nav-item has-treeview <?php echo isset($active_master) ? $active_master : ''; ?>" id="sb-master-head">
                  <a id="sb-master" href="#" class="nav-link">
                      <i class="nav-icon fas fa-database"></i> <!-- ganti ikon Master Data -->
                      <p>
                          Master Data
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="<?php echo base_url('users/list'); ?>" class="nav-link <?php echo isset($active_users_list) ? $active_users_list : ''; ?>">
                              <i class="nav-icon fas fa-users"></i>
                              <p>Create Users</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="<?php echo base_url('web_application'); ?>" class="nav-link <?php echo isset($active_webapp) ? $active_webapp : ''; ?>">
                              <i class="nav-icon fas fa-globe"></i>
                              <p>Create Web App</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="<?php echo base_url('staff_it'); ?>" class="nav-link <?php echo isset($active_staff_it) ? $active_staff_it : ''; ?>">
                              <i class="nav-icon fas fa-user-cog"></i>
                              <p>Lempar Request ke Staff IT</p>
                          </a>
                      </li>

                  </ul>
              </li>
              <?php endif; ?>

            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->
