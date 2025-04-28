
<?php $this->load->view('includes/header'); ?>
<?php
if (isset($data)) {
    foreach ($data as $row) {
        // // echo '<pre>';
        // print_r($row);
        // die();

        $product_id = $row->id;
        $title = $row->title;
        $description=$row->description;
        $unit=$row->unit;
        $rate_per_unit=$row->rate_per_unit;
        $stock=$row->stock;
        $purchase_rate=$row->purchase_rate;
        $mrp=$row->MRP;
    }
} else {
    $product_id = '';
    $title = '';
    $description='';
    $unit='';
    $rate_per_unit='';
    $stock='';
    $purchase_rate='';
    $mrp='';
}

?>

<div id="message_show"></div>
<div class="container mt-5">
    <h2 class="mb-4"><?= isset($data) ? 'Edit product' : 'Add product' ?></h2>

    <form method="post" action="<?= base_url('product/save_product') ?>" id="productForm" class="card p-4 shadow-sm bg-white">
        <input type="hidden" name="id" value="<?= $product_id ?>">

        <div class="mb-3">
            <label for="title" class="form-label">Name</label>
            <input type="text" name="title" class="form-control" required value="<?= $title ?>">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" name="description" class="form-control"  value="<?= $description ?>">
        </div>

        <div class="mb-3">
            <label for="rate_per_unit" class="form-label">Rate Per Unit</label>
            <input type="number" name="rate_per_unit" class="form-control" required value="<?= $rate_per_unit ?>">
        </div>

        <div class="mb-3">
            <label for="unit" class="form-label">Unit</label>
            <select name="unit" class="form-select" required>
                <option value="">-- Select Unit --</option>
                <option value="kg" <?= ($unit == 'kg') ? 'selected' : '' ?>>Kg</option>
                <option value="gm" <?= ($unit == 'gm') ? 'selected' : '' ?>>gm</option>
                <option value="pc" <?= ($unit == 'pc') ? 'selected' : '' ?>>pc</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" required value="<?= $stock ?>" required>
        </div>
        <div class="mb-3">
            <label for="mrp" class="form-label">MRP</label>
            <input type="number" name="mrp" class="form-control" required value="<?= $mrp ?>" required>
        </div>
        <div class="mb-3">
            <label for="purchase_rate" class="form-label">Purchase Rate</label>
            <input type="number" name="purchase_rate" class="form-control" required value="<?= $purchase_rate ?>" required>
        </div>
        <div class="d-flex flex-column gap-3">
        <button type="submit" class="btn btn-primary"><?= isset($data) ? 'Update' : 'Save' ?></button>
        <a href="<?= base_url('product') ?>" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
<?php $this->load->view('includes/footer');?>
<script>
 $("#productForm").validate({
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.siblings("label"));
            } else {
                error.insertAfter(element);
            }
        },
        // errorPlacement: function() {
        //     return false;
        // },


        rules: {

        


        },
        
        errorElement: "div",
        errorClass: 'is-invalid',
        validClass: 'is-valid',
        messages: {


        },

        submitHandler: function(form) {
            var formData = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                url: form.action,
                dataType: 'json',
                data: formData,
                success: function(data) {
                    console.log(data);
                    if (data.success == 0) {
                        $('#message_show').html(data.message);
                    } else {
                        $('#message_show').html(data.message);
                        setTimeout(function() {

                            location.href = "<?= base_url('product/') ?>"
                        }, 1500);


                    }
                    $('html, body').animate({
                        scrollTop: 0
                    }, 800);
                },
                beforeSend: function() {
                    $("#show-hide").show();
                },
                complete: function() {
                    $("#show-hide").hide();
                }
            });

        }
    }).settings.ignore = [];
</script>

