<?php
$title = 'Lempar Request ke Staff IT';
$active_dashboard = '';
$active_request = '';
$active_pengerjaan = '';
$active_master = 'menu-open';
$active_staff_it = 'active';
include APPPATH . 'views/templates/header.php';
include APPPATH . 'views/templates/sidebar.php';
?>

      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Lempar Request ke Staff IT</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Lempar Request</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Request yang Sudah Diapprove</h3>
                  </div>
                  <div class="card-body">
                    <?php if ($this->session->flashdata('success')): ?>
                      <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('error')): ?>
                      <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>User</th>
                          <th>Application</th>
                          <th>Created At</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($requests as $r): ?>
                        <tr>
                          <td><?= $r['title']; ?></td>
                          <td><?= $r['user_name']; ?></td>
                          <td><?= $r['app_name'] ?: $r['application_name']; ?></td>
                          <td><?= $r['created_at']; ?></td>
                          <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalLempar<?= $r['id']; ?>">Lempar</button>
                          </td>
                        </tr>

                        <!-- Modal Lempar -->
                        <div class="modal fade" id="modalLempar<?= $r['id']; ?>" tabindex="-1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form method="post" action="<?= base_url('staff_it/assign/'.$r['id']); ?>">
                                <div class="modal-header">
                                  <h5>Lempar Request ke Staff IT</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="mb-3">
                                    <label>Pilih Staff IT</label>
                                    <select name="pic_id" class="form-control" required>
                                      <option value="">-- Pilih Staff IT --</option>
                                      <?php foreach ($staff_it_users as $u): ?>
                                        <option value="<?= $u->id; ?>"><?= $u->username; ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                  </div>
                                  <div class="mb-3">
                                    <label>Tingkat Urgensi</label>
                                    <select name="level" class="form-control" required>
                                      <option value="urgent">Urgent</option>
                                      <option value="not urgent">Not Urgent</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                  <button type="submit" class="btn btn-success">Lempar</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::App Content-->
        </div>
      </main>
      <!--end::App Main-->
<?php include APPPATH . 'views/templates/footer.php'; ?>
