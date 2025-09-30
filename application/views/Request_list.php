<?php
$title = 'AMAZINK PEOPLE GROUP | Request List';
$active_dashboard = '';
$active_request = 'active';
$active_users = '';
$active_master = '';
$active_list = '';
$active_create = '';
include 'templates/header.php';
include 'templates/sidebar.php';
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
                <h3 class="mb-0">Request List</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Request List</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
              <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
            <?php endif; ?>
            <!--begin::Row-->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">All Requests</h3>
                    <div class="card-tools">
                      <form method="get" class="d-inline">
                        <select name="level" class="form-select form-select-sm" onchange="this.form.submit()">
                          <option value="">All Levels</option>
                          <option value="urgent" <?php echo ($level == 'urgent') ? 'selected' : ''; ?>>Urgent</option>
                          <option value="not urgent" <?php echo ($level == 'not urgent') ? 'selected' : ''; ?>>Not Urgent</option>
                        </select>
                      </form>
                    </div>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>User</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Application</th>
                          <th>Status</th>
                          <th>Level</th>
                          <th>PIC</th>
                          <th>File</th>
                          <th>Created</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($requests as $request): ?>
                          <tr>
                            <td><?php echo $request['user_name']; ?></td>
                            <td><?php echo $request['title']; ?></td>
                            <td><?php echo $request['description']; ?></td>
                            <td><?php echo isset($request['app_name']) ? $request['app_name'] : 'N/A'; ?></td>
                            <td><?php echo ucfirst($request['status']); ?></td>
                            <td><?php echo ucfirst($request['level']); ?></td>
                            <td><?php echo $request['pic_id'] ? 'Assigned' : 'Not Assigned'; ?></td>
                            <td><?php echo $request['file_upload'] ? '<a href="' . base_url('uploads/' . $request['file_upload']) . '">' . $request['file_upload'] . '</a>' : 'No file'; ?></td>
                            <td><?php echo $request['created_at']; ?></td>
                            <td>
                              <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $request['id']; ?>">Update</button>
                            </td>
                          </tr>
                          <!-- Modal -->
                          <div class="modal fade" id="modal-<?php echo $request['id']; ?>" tabindex="-1">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <form action="<?php echo base_url('dashboard/approve_request/' . $request['id']); ?>" method="post">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Update Request</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label>Status</label>
                                      <select name="status" class="form-control">
                                        <option value="pending" <?php echo ($request['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                        <option value="in_progress" <?php echo ($request['status'] == 'in_progress') ? 'selected' : ''; ?>>In Progress</option>
                                        <option value="completed" <?php echo ($request['status'] == 'completed') ? 'selected' : ''; ?>>Completed</option>
                                        <option value="rejected" <?php echo ($request['status'] == 'rejected') ? 'selected' : ''; ?>>Rejected</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>PIC (User ID)</label>
                                      <input type="number" name="pic_id" class="form-control" value="<?php echo $request['pic_id']; ?>">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
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
<?php include APPPATH . 'views/templates/footer.php'; ?>
