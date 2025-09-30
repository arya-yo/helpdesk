<?php
$title = 'AMAZINK PEOPLE GROUP | Web Applications';
$active_dashboard = '';
$active_request = '';
$active_users = '';
$active_master = 'menu-open';
$active_list = 'active';
$active_create = '';
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
          <h3 class="mb-0">Web Applications</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">List Applications</li>
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
            <!-- Header -->
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title">Web Applications List</h3>
              <button class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#modalTambah">
                + Tambah Aplikasi
              </button>
            </div>

            <!-- Body -->
            <div class="card-body">
              <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
              <?php elseif ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
              <?php endif; ?>

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($applications as $app): ?>
                    <tr>
                      <td><?= $app['id']; ?></td>
                      <td><?= $app['name']; ?></td>
                      <td><?= $app['created_at']; ?></td>
                      <td>
                        <button class="btn btn-warning btn-sm"
                                  data-bs-toggle="modal"
                                  data-bs-target="#modalEdit<?= $app['id']; ?>">
                                  edit
                        </button>          
                        <a href="<?= base_url('web_application/delete/'.$app['id']); ?>"
                          onclick="return confirm('Yakin bro?')"
                          class="btn btn-danger btn-sm">
                          hapus
                        </a>
                      </td>
                    </tr>
                      <!-- Modal Edit -- -->
                      <div class="modal fade" id="modalEdit<?= $app['id']; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form method="post" action="<?= base_url('web_application/update/'.$app['id']); ?>">
                              <div class="modal-header">
                                <h5 class="modal-title">Edit Web Application</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <div class="modal-body">
                                <div class="mb-3">
                                  <label class="form-label">Nama Aplikasi</label>
                                  <input type="text" name="name" class="form-control" 
                                        value="<?= $app['name']; ?>" required>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
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
    <!--end::Container-->
  </div>
  <!--end::App Content-->
</main>
<!--end::App Main-->

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="<?= base_url('web_application/create'); ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahLabel">Tambah Web Application</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama Aplikasi</label>
            <input type="text" name="name" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include APPPATH . 'views/templates/footer.php'; ?>
<!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)-->

<!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!--end::Required Plugin(Bootstrap 5)-->
