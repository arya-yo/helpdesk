<?php
$username = $this->session->userdata('username');
$role = $this->session->userdata('role');
$title = 'AMAZINK PEOPLE GROUP | Request';
$active_dashboard = '';
$active_request = 'active';
$active_users = '';
$active_master = '';
$active_list = '';
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
                <h3 class="mb-0">Request</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Request</li>
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
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Submit New Request</h3>
                  </div>
                  <div class="card-body">
                    <form action="<?php echo base_url('dashboard/request'); ?>" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                      </div>
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                      </div>
                      <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-control" id="level" name="level" required>
                          <option value="urgent">Urgent</option>
                          <option value="not urgent">Not Urgent</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="application_id">Application</label>
                        <select class="form-control" id="application_id" name="application_id" required>
                          <option value="">Select Application</option>
                          <?php foreach ($applications as $app): ?>
                            <option value="<?php echo $app['id']; ?>"><?php echo $app['name']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="file_upload">File Upload</label>
                        <input type="file" class="form-control" id="file_upload" name="file_upload">
                      </div>
                      <button type="submit" class="btn btn-primary">Submit Request</button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Your Requests</h3>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Status</th>
                          <th>Level</th>
                          <th>Created</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($requests as $request): ?>
                          <tr>
                            <td><?php echo $request['title']; ?></td>
                            <td><?php echo ucfirst($request['status']); ?></td>
                            <td><?php echo ucfirst($request['level']); ?></td>
                            <td><?php echo $request['created_at']; ?></td>
                          </tr>
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
