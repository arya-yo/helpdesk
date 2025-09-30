<?php
$title = 'AMAZINK PEOPLE GROUP | Tugas';
$active_dashboard = '';
$active_request = '';
$active_users = '';
$active_master = '';
$active_list = '';
$active_create = '';
$active_pengerjaan = '';
$active_tugas = 'active';
include APPPATH . 'views/templates/header.php';
include APPPATH . 'views/templates/sidebar.php';
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <h1>Tugas</h1>
        </div>
    </section>
    

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Tugas Anda</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Level</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($requests as $request): ?>
                                <tr>
                                    <td><?php echo $request->title; ?></td>
                                    <td><?php echo ucfirst($request->status); ?></td>
                                    <td><?php echo ucfirst($request->level); ?></td>
                                    <td><?php echo $request->start_time ? $request->start_time : '-'; ?></td>
                                    <td><?php echo $request->end_time ? $request->end_time : '-'; ?></td>
                                    <td>
                                        <?php if ($request->status == 'pending' || $request->status == 'in_progress'): ?>
                                            <?php if (!$request->start_time): ?>
                                                <a href="<?php echo base_url('tugas/start/' . $request->id); ?>" class="btn btn-sm btn-primary">Start</a>
                                            <?php elseif (!$request->end_time): ?>
                                                <a href="<?php echo base_url('tugas/end/' . $request->id); ?>" class="btn btn-sm btn-success">End</a>
                                            <?php else: ?>
                                                <span>Selesai</span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span>-</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>

<?php include APPPATH . 'views/templates/footer.php'; ?>
