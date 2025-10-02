<?php
$title = 'AMAZINK PEOPLE GROUP | Pengerjaan';
$active_dashboard = '';
$active_request   = '';
$active_master    = '';
$active_list      = '';
$active_create    = '';
$active_pengerjaan = 'active'; // buat aktifin menu sidebar PENGERJAAN
include APPPATH . 'views/templates/header.php';
include APPPATH . 'views/templates/sidebar.php';
?>

<!--begin::App Main-->
<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Daftar Pengerjaan</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengerjaan</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!--end::App Content Header-->

  <!--begin::App Content-->
  <div class="app-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">

            <!-- Card Header -->
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title">List Request Pengerjaan</h3>
            </div>

            <!-- Card Body -->
            <div class="card-body">
              <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
              <?php elseif ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
              <?php endif; ?>

              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Pemohon</th>
                    <th>Level</th>
                    <th>PIC</th>
                    <th>Status</th>
                    <th>Duration</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($requests as $req): ?>
                    <tr>
                      <td><?= $req->id; ?></td>
                      <td><?= $req->title; ?></td>
                      <td><?= $req->username; ?></td>
                      <td>
                        <?php if ($req->level == 'urgent'): ?>
                          <span class="badge bg-danger">Urgent</span>
                        <?php else: ?>
                          <span class="badge bg-secondary">Not Urgent</span>
                        <?php endif; ?>
                      </td>
                      <td><?= $req->pic_name ?: '-'; ?></td>
                      <td>
                        <?php if ($req->status == 'approved'): ?>
                          <span class="badge bg-warning">Approved</span>
                        <?php elseif ($req->status == 'in_progress'): ?>
                          <span class="badge bg-info">In Progress</span>
                        <?php elseif ($req->status == 'completed'): ?>
                          <span class="badge bg-success">Completed</span>
                        <?php else: ?>
                          <span class="badge bg-danger">Rejected</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <?php if ($req->status == 'completed' && $req->start_time && $req->finish_time): ?>
                          <?php
                          $start = strtotime($req->start_time);
                          $finish = strtotime($req->finish_time);
                          $diff = $finish - $start;
                          $days = floor($diff / 86400);
                          $hours = floor(($diff % 86400) / 3600);
                          $minutes = floor(($diff % 3600) / 60);
                          echo ($days > 0 ? $days . 'd ' : '') . ($hours > 0 ? $hours . 'h ' : '') . $minutes . 'm';
                          ?>
                        <?php else: ?>
                          -
                        <?php endif; ?>
                      </td>
                      <td><?= $req->created_at; ?></td>
                      <td>
                        <?php if ($req->status == 'approved'): ?>
                          <a href="<?= base_url('pengerjaan/start/'.$req->id); ?>" class="btn btn-success btn-sm">
                            <i class="fas fa-play"></i> Mulai
                          </a>
                        <?php elseif ($req->status == 'in_progress'): ?>
                          <a href="<?= base_url('pengerjaan/complete/'.$req->id); ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-stop"></i> Selesai
                          </a>
                        <?php endif; ?>
                        <a href="<?= base_url('pengerjaan/reject/'.$req->id); ?>"
                           onclick="return confirm('Yakin tolak request ini?')"
                           class="btn btn-danger btn-sm">
                          <i class="fas fa-times"></i> Tolak
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--end::App Content-->
</main>
<!--end::App Main-->

<?php include APPPATH . 'views/templates/footer.php'; ?>
