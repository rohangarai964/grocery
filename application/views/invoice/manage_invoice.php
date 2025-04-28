<?php $this->load->view('includes/header'); ?>

<!-- Edit Paid Amount Modal -->
<div class="modal fade" id="editPaidModal" tabindex="-1" aria-labelledby="editPaidModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editPaidForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Paid Amount</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="invoice_id" id="invoiceId">
          <div class="mb-3">
            <label for="paidAmount" class="form-label">Paid Amount</label>
            <input type="number" class="form-control" name="paid_amount" id="paidAmount" min="0" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="container mt-5">
    <div class="d-flex justify-content-between m-3">

    <h2 class="mb-4">Manage Invoice</h2>
    <button class="btn btn-primary" onclick="location.href='<?= site_url('invoice/add') ?>'">Add Bill</button>
    </div>
  
  <table id="invoiceTable" class="table table-bordered">
    <thead>
      <tr>
        <th>Invoice No</th>
        <th>Customer Name</th>
        <th>Purchase Date</th>
        <th>Total Amount</th>
        <th>Paid Amount</th>
        <th>Due Amount</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
</div>

<?php $this->load->view('includes/footer');?>

<script>
$(document).ready(function () {
  var invoiceTable = $('#invoiceTable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "<?= site_url('invoice/fetch_invoice') ?>",
      "type": "POST"
    },
    "order": [[2, 'desc']],
    "columnDefs": [{
      "targets": -1,
      "orderable": false
    }]
  });

  // Open modal on edit click
  $(document).on('click', '.edit-paid', function () {
    const invoiceId = $(this).data('id');
    const paidAmount = $(this).data('paid');

    $('#invoiceId').val(invoiceId);
    $('#paidAmount').val(paidAmount);
    $('#editPaidModal').modal('show');
  });

  // Submit updated paid amount
  $('#editPaidForm').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      url: "<?= site_url('invoice/update_paid_amount') ?>",
      type: "POST",
      data: $(this).serialize(),
      dataType: 'json',
      success: function (res) {
        if (res.status) {
          $('#editPaidModal').modal('hide');
          invoiceTable.ajax.reload(null, false);
        } else {
          alert('Failed to update');
        }
      }
    });
  });
});

</script>