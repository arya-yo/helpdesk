<script>
function openPicModal(id) {
  // Close the main modal
  var mainModal = document.getElementById('modal-' + id);
  var modalInstance = bootstrap.Modal.getInstance(mainModal);
  modalInstance.hide();

  // Show the PIC selection modal
  var picModal = new bootstrap.Modal(document.getElementById('pic-modal-' + id));
  picModal.show();
}

function showRejectReason(id) {
  document.getElementById('rejection-reason-container-' + id).style.display = 'block';
  document.getElementById('submit-reject-btn-' + id).style.display = 'inline-block';
}

function validateRejectReason(id) {
  var reason = document.getElementById('rejection_reason_' + id).value.trim();
  if (!reason) {
    alert('Mohon isi alasan penolakan.');
    return false;
  }
  document.getElementById('status-input-' + id).value = 'rejected';
  return true;
}
</script>
