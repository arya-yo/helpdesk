<?php
$title = 'AMAZINK PEOPLE GROUP | User List';
$active_dashboard = '';
$active_request = '';
$active_pengerjaan ='';
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
                <h3 class="mb-0">User List</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">Users</a></li>
                  <li class="breadcrumb-item active" aria-current="page">List Users</li>
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
                    <h3 class="card-title">User List</h3>
                    <button class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#modalTambah">
                      + Tambah User
                    </button>
                  </div>

                  <!-- Body -->
                  <div class="card-body">
                    <?php if ($this->session->flashdata('success')): ?>
                      <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                    <?php endif; ?>

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Created At</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($users as $u): ?>
                        <tr>
                          <td><?= $u->username; ?></td>
                          <td><?= $u->email; ?></td>
                          <td><?= ucfirst($u->role); ?></td>
                          <td><?= $u->created_at; ?></td>
                          <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $u->id; ?>">Edit</button>
                            <a href="<?= base_url('user/delete/'.$u->id); ?>" onclick="return confirm('Yakin hapus user?')" class="btn btn-danger btn-sm">Hapus</a>
                          </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit<?= $u->id; ?>" tabindex="-1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form method="post" action="<?= base_url('user/update/'.$u->id); ?>">
                                <div class="modal-header">
                                  <h5>Edit User</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="mb-3">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" value="<?= $u->username; ?>" required>
                                  </div>
                                  <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="<?= $u->email; ?>" required>
                                  </div>
                                  <div class="mb-3">
                                    <label>Password (isi jika mau ubah)</label>
                                    <input type="password" name="password" class="form-control">
                                  </div>
                                  <div class="mb-3">
                                    <label>Role</label>
                                    <select name="role" class="form-control" required>
                                      <option value="it_manager" <?= $u->role == 'it_manager' ? 'selected' : ''; ?>>IT Manager</option>
                                      <option value="internal" <?= $u->role == 'internal' ? 'selected' : ''; ?>>Staff IT</option>
                                      <option value="external" <?= $u->role == 'external' ? 'selected' : ''; ?>>External</option>
                                    </select>
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

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?= base_url('user/create'); ?>">
                <div class="modal-header">
                    <h5>Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Role</label>
                        <select name="role" class="form-control" required>
                            <option value="it_manager">IT Manager</option>
                            <option value="internal">Staff IT</option>
                            <option value="external">External</option>
                        </select>
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

          <!--end::App Content-->
      </main>
      <!--end::App Main-->
<?php include APPPATH . 'views/templates/footer.php'; ?>
