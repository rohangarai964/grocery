<?php $this->load->view('includes/header'); ?>
<style>
  .table-responsive {
    margin: 30px 0;
}
.table-wrapper {
    min-width: 1000px;
    background: #fff;
    padding: 20px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}

</style>
<div class="container-xl mt-5">
<div class="table-responsive">
<div class="table-wrapper">
    <div class="d-flex justify-content-between m-3">

    <h2 class="mb-4">Manage product</h2>
    <button class="btn btn-primary" onclick="location.href='<?= site_url('product/add') ?>'">Add Product</button>
    </div>
  
  <table id="customerTable" class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Rate Per Unit</th>
        <th>Unit</th>
        <th>Stock</th>
        <th>MRP</th>
        <th>Purchase Rate</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
  </div>
</div>
</div>

<?php $this->load->view('includes/footer');?>

<script>
$(document).ready(function () {
  $('#customerTable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "<?= site_url('product/fetch_products') ?>",
      "type": "POST"
    },
    "columnDefs": [
      {
        "targets": -1, // targets the last column
        "orderable": false
      }
    ]
  });
});
</script>


