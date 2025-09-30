<?php
$title = 'AMAZINK PEOPLE GROUP | Helpdesk';
$active_dashboard = 'active';
$active_request = '';
$active_users = '';
$active_master = '';
$active_list = '';
$active_create = '';
include APPPATH . 'views/templates/header.php';
include APPPATH . 'views/templates/sidebar.php';
?>  

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <h1>Dashboard</h1>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php if ($role == 'external'): ?>
                <!-- Welcome content for external users -->
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body text-center">
                                <h1 class="display-4">Selamat datang di web helpdesk</h1>
                                <h2 class="mt-4">
                                    <span style="color: red;">AMAZINK</span> PEOPLE GROUP
                                </h2>
                                <p class="text-muted small">solution</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Dashboard content for internal users and IT Manager -->
                <div class="row">
                    <!-- Total Users -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?= $total_users; ?></h3>
                                <p>Total Users</p>
                            </div>
                            <div class="icon"><i class="fas fa-users"></i></div>
                        </div>
                    </div>

                    <!-- Total Request -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?= $total_request; ?></h3>
                                <p>Total Request</p>
                            </div>
                            <div class="icon"><i class="fas fa-clipboard-list"></i></div>
                        </div>
                    </div>

                    <!-- Request Proses -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?= $total_proses; ?></h3>
                                <p>Request Diproses</p>
                            </div>
                            <div class="icon"><i class="fas fa-spinner"></i></div>
                        </div>
                    </div>

                    <!-- Request Selesai -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3><?= $total_selesai; ?></h3>
                                <p>Request Selesai</p>
                            </div>
                            <div class="icon"><i class="fas fa-check-circle"></i></div>
                        </div>
                    </div>
                </div>

                <!-- List User khusus IT Manager -->
                <?php if ($role == 'it_manager'): ?>
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Daftar Users</h3></div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr><th>No</th><th>Username</th><th>Email</th><th>Role</th></tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach ($users as $u): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $u->username; ?></td>
                                    <td><?= $u->email; ?></td>
                                    <td><?= $u->role; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php include APPPATH . 'views/templates/footer.php'; ?>
