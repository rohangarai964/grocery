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

    <h2 class="mb-4">Manage Customers</h2>
    <button class="btn btn-primary" onclick="location.href='<?= site_url('customer/add') ?>'">Add Customer</button>

    </div>
  
  <table id="customerTable" class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
</div>
</div>
</div>

<!-- <div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Customer <b>Details</b></h2></div>
                    <div class="col-sm-4">
                        <div class="search-box">
                            <i class="material-icons">&#xE8B6;</i>
                            <input type="text" class="form-control" placeholder="Search&hellip;">
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover table-bordered" id="customerTable">
            <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Action</th>
      </tr>
    </thead>
              </table>
</div>
</div>
</div> -->



<?php $this->load->view('includes/footer');?>

<script>
$(document).ready(function () {
  $('#customerTable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "<?= site_url('customer/fetch_customers') ?>",
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


