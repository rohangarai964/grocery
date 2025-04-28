
<?php $this->load->view('includes/header'); ?>
<?php
if (isset($data)) {
    foreach ($data as $row) {
        // // echo '<pre>';
        // print_r($row);
        // die();

        $customer_id = $row->id;
        $customer_name = $row->name;
        $customer_email=$row->email;
        $customer_phone=$row->phone;
        $customer_address=$row->address;
    }
} else {
    $customer_id = '';
    $customer_name = '';
    $customer_email='';
    $customer_phone='';
    $customer_address='';
}

?>

<div id="message_show"></div>
<div class="container mt-5">
    <h2 class="mb-4"><?= isset($data) ? 'Edit Customer' : 'Add Customer' ?></h2>

    <form method="post" action="<?= base_url('customer/save_customer') ?>" id="customerForm" class="card p-4 shadow-sm bg-white">
        <input type="hidden" name="id" value="<?= $customer_id ?>">

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required value="<?= $customer_name ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control"  value="<?= $customer_email ?>">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" required value="<?= $customer_phone ?>">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea type="text" name="address" class="form-control" required ><?= $customer_address ?></textarea>
        </div>
        <div class="d-flex flex-column gap-3">

        <button type="submit" class="btn btn-primary"><?= isset($data) ? 'Update' : 'Save' ?></button>

        <a href="<?= base_url('customer') ?>" class="btn btn-secondary">Back</a>
        </div>
       
      
    </form>
</div>
<?php $this->load->view('includes/footer');?>
<script>
 $("#customerForm").validate({
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
        phone: {
            required: true,
            digits: true,
            minlength: 10,
            maxlength: 10
        }
    },
        
        errorElement: "div",
        errorClass: 'is-invalid',
        validClass: 'is-valid',
        messages: {
        phone: {
            required: "Phone number is required.",
            digits: "Please enter only digits.",
            minlength: "Phone number must be exactly 10 digits.",
            maxlength: "Phone number must be exactly 10 digits."
        }
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

                            location.href = "<?= base_url('customer/') ?>"
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

