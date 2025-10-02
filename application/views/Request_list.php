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
                          <option value="urgent" <?php echo (htmlspecialchars($level) == 'urgent') ? 'selected' : ''; ?>>Urgent</option>
                          <option value="not urgent" <?php echo (htmlspecialchars($level) == 'not urgent') ? 'selected' : ''; ?>>Not Urgent</option>
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
                          <td><?php echo !empty($request['pic_name']) ? $request['pic_name'] : 'Not Assigned'; ?></td>
                          <td>
                            <?php if ($request['file_upload']): ?>
                              <a href="<?php echo base_url('uploads/' . $request['file_upload']); ?>" target="_blank"><?php echo $request['file_upload']; ?></a>
                            <?php else: ?>
                              No file
                            <?php endif; ?>
                          </td>
                          <td><?php echo $request['created_at']; ?></td>
                          <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $request['id']; ?>">Detail</button>
                          </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="modal-<?php echo $request['id']; ?>" tabindex="-1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form action="<?php echo base_url('dashboard/approve_request/' . $request['id']); ?>" method="post" id="approve-reject-form-<?php echo $request['id']; ?>">
                                <div class="modal-header">
                                  <h5 class="modal-title">Request Detail</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <p><strong>User:</strong> <?php echo $request['user_name']; ?></p>
                                  <p><strong>Title:</strong> <?php echo $request['title']; ?></p>
                                  <p><strong>Description:</strong> <?php echo $request['description']; ?></p>
                                  <p><strong>Application:</strong> <?php echo isset($request['app_name']) ? $request['app_name'] : 'N/A'; ?></p>
                                  <p><strong>Status:</strong> <?php echo ucfirst($request['status']); ?></p>
                                  <p><strong>Level:</strong> <?php echo ucfirst($request['level']); ?></p>
                                  <p><strong>PIC:</strong> <?php echo $request['pic_id'] ? 'Assigned' : 'Not Assigned'; ?></p>
                                  <p><strong>File:</strong> 
                                  <?php if ($request['file_upload']): ?>
                                    <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#file-modal-<?php echo $request['id']; ?>">
                                      <?php echo $request['file_upload']; ?>
                                    </button>
                                  <?php else: ?>
                                    No file
                                  <?php endif; ?>
                                  </p>
                                  <p><strong>Created:</strong> <?php echo $request['created_at']; ?></p>
                                  <div id="rejection-reason-container-<?php echo $request['id']; ?>" style="display:none;">
                                    <label for="rejection_reason_<?php echo $request['id']; ?>">Reason for rejection:</label>
                                    <textarea name="rejection_reason" id="rejection_reason_<?php echo $request['id']; ?>" class="form-control" rows="3"></textarea>
                                  </div>
                                  <input type="hidden" name="status" id="status-input-<?php echo $request['id']; ?>" value="">
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-success" onclick="openPicModal(<?php echo $request['id']; ?>)">Approve</button>
                                  <button type="button" class="btn btn-danger" onclick="showRejectReason(<?php echo $request['id']; ?>)">Reject</button>
                                  <button type="submit" class="btn btn-danger" id="submit-reject-btn-<?php echo $request['id']; ?>" style="display:none;" onclick="return validateRejectReason(<?php echo $request['id']; ?>)">Submit Rejection</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- PIC Selection Modal -->
                        <div class="modal fade" id="pic-modal-<?php echo $request['id']; ?>" tabindex="-1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form action="<?php echo base_url('dashboard/approve_save/' . $request['id']); ?>" method="post">
                                <div class="modal-header">
                                  <h5 class="modal-title">Select PIC for Request</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <p><strong>Request:</strong> <?php echo $request['title']; ?></p>
                                  <label for="pic_id_<?php echo $request['id']; ?>">Choose PIC:</label>
<select name="pic_id" id="pic_id_<?php echo $request['id']; ?>" class="form-select" required>
                                    <option value="">-- Select PIC --</option>
                                    <?php foreach ($users as $user): ?>
                                      <option value="<?php echo $user->id; ?>"><?php echo $user->username; ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                  <input type="hidden" name="status" value="approved">
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-primary">Assign PIC</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- File Modal -->
                        <?php if ($request['file_upload']): ?>
                          <div class="modal fade" id="file-modal-<?php echo $request['id']; ?>" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">File: <?php echo $request['file_upload']; ?></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <?php
                                  $file_path = base_url('uploads/' . $request['file_upload']);
                                  $file_ext = strtolower(pathinfo($request['file_upload'], PATHINFO_EXTENSION));
                                  if (in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                                    echo '<img src="' . $file_path . '" class="img-fluid" alt="File">';
                                  } elseif ($file_ext == 'pdf') {
                                    echo '<iframe src="' . $file_path . '" width="100%" height="600px"></iframe>';
                                  } else {
                                    echo '<p>File type not supported for preview. <a href="' . $file_path . '" target="_blank">Download</a></p>';
                                  }
                                  ?>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php endif; ?>
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
<?php include 'request_list_js.php'; ?>
<?php include 'templates/footer.php'; ?>
