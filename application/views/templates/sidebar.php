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
              data-widget="treeview"
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
              <?php if ($role == 'external'): ?>
              <li class="nav-item">
                <a href="<?php echo base_url('dashboard/request'); ?>" class="nav-link <?php echo isset($active_request) ? $active_request : ''; ?>">
                  <i class="nav-icon bi bi-clipboard-check"></i>
                  <p>Request</p>
                </a>
              </li>
              <?php endif; ?>
              <?php if ($role != 'external'): ?>
              <li class="nav-item">
                <a href="<?php echo base_url('pengerjaan'); ?>" class="nav-link <?php echo isset($active_pengerjaan) ? $active_pengerjaan : ''; ?>">
                  <i class="nav-icon bi bi-clipboard-check"></i>
                  <p>Pengerjaan</p>
                </a>
              </li>
              <?php endif; ?>
              <?php if ($role == 'it_manager'): ?>
              <li class="nav-item">
                <a href="<?php echo base_url('dashboard/request'); ?>" class="nav-link <?php echo isset($active_request) ? $active_request : ''; ?>">
                  <i class="nav-icon bi bi-clipboard-check"></i>
                  <p>Request Masuk</p>
                </a>
              </li>
              <li class="nav-item <?php echo (isset($active_master) && $active_master == 'menu-open') ? 'menu-open' : ''; ?>" id="sb-master-head">
                  <a id="sb-master" href="#" class="nav-link <?php echo isset($active_master) ? '' : ''; ?>">
                      <i class="nav-icon fas fa-database"></i>
                      <p>
                          Master Data
                          <i class="nav-icon bi bi-chevron-right ms-auto"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview" style="<?php echo (isset($active_master) && $active_master == 'menu-open') ? 'display: block;' : 'display: none;'; ?>">
                      <li class="nav-item">
                          <a href="<?php echo base_url('users/list'); ?>" class="nav-link <?php echo isset($active_users_list) ? $active_users_list : ''; ?>">
                              <i class="nav-icon fas fa-circle" style="font-size: 0.5rem;"></i>
                              <p>Create Users</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="<?php echo base_url('web_application'); ?>" class="nav-link <?php echo isset($active_webapp) ? $active_webapp : ''; ?>">
                              <i class="nav-icon fas fa-circle" style="font-size: 0.5rem;"></i>
                              <p>Create Web App</p>
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
