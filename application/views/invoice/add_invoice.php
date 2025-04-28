<?php $this->load->view('includes/header'); ?>

<?php 
// print_r($items);die();
?>

<div id="message_show"></div>
<div class="container mt-5">
    <h3 class="mb-4">Add New Invoice</h3>

    <form action="<?= site_url('invoice/save_print') ?>" method="post" id="invoiceForm">
        <div class="card p-4 shadow-sm bg-white">
            <div class="mb-3">
                <label for="customer_id" class="form-label">Select Customer</label>
                <select class="form-select select2" name="customer_id" required>
                    <option value="">-- Select Customer --</option>
                    <?php foreach ($customers as $cust): ?>
                        <option value="<?= $cust->id ?>"><?= $cust->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <h5 class="mt-4">Invoice Items</h5>
            <div id="items-wrapper">
                <!-- Item Row Template -->
                <div class="row g-3 align-items-end item-row mb-2">
                    <div class="col-md-3">
                        <label class="form-label">Item</label>
                        <select name="items[0][item_id]" class="form-select item-select" required>
                            <option value="">-- Select Item --</option>
                            <?php foreach ($items as $item): ?>
                                <option value="<?= $item->id ?>"
                                    data-price="<?= $item->rate_per_unit ?>"
                                    data-unit="<?= $item->unit ?>"
                                    data-mrp="<?= $item->MRP ?>"
                                    data-purchase_rate="<?= $item->purchase_rate ?>"
                                >
                                    <?= $item->title ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="d-flex gap-2">
                        <div class="">
                        <label class="form-label">Purchase Rate</label>
                        <input type="number" class="form-control purchase-rate" readonly>
                        </div>
                        <div class="">
                        <label class="form-label">MRP</label>
                        <input type="number" class="form-control mrp" readonly>
                        </div>
                        </div>
                       
                    
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Qty</label>
                        <input type="number" name="items[0][qty]" class="form-control qty"  value="1" required>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">Unit</label>
                        <input type="text" class="form-control unit" readonly>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">Ac. Rate</label>
                        <input type="text" class="form-control actual-price" readonly>
                        
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Selling Price</label>
                        <input type="number" name="items[0][selling_price]" class="form-control selling-price" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Total</label>
                        <input type="number" name="items[0][total]" class="form-control total-price" >
                    </div>
                    
                   
                    <div class="col-md-2 text-end">
                        <button type="button" class="btn btn-danger remove-btn d-none">Remove</button>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <button type="button" id="addItem" class="btn btn-outline-primary">+ Add Item</button>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">Save and Print</button>
                <a href="<?= site_url('invoice') ?>" class="btn btn-secondary">Cancel</a>
            </div>

            <div class="row mt-4">
    <div class="col-md-6 offset-md-6">
    <div class="mb-3">
    <label for="grand_total" class="form-label fw-bold">Grand Total (₹)</label>
    <input type="number" name="grand_total" id="grandTotal" class="form-control" readonly>
</div>
        <div class="mb-3">
            <label for="paid_amount" class="form-label">Paid Amount</label>
            <input type="number" name="paid_amount" id="paid_amount" class="form-control" placeholder="Enter paid amount" required>
        </div>
    </div>
</div>
        </div>
        
    </form>
</div>

<?php $this->load->view('includes/footer');?>
<script>
let itemIndex = 1;

$('.select2').select2(); 
function bindItemEvents(row) {
    row.find('.item-select').select2(); // For dynamically added rows

    function calculateTotal() {
        const qty = parseFloat(row.find('.qty').val()) || 0;
        const sellingPrice = parseFloat(row.find('.selling-price').val()) || 0;
        const total = qty * sellingPrice;
        row.find('.total-price').val(total.toFixed(2));
        updateGrandTotal();
    }

    function calculateQty() {
        const total = parseFloat(row.find('.total-price').val()) || 0;
        const sellingPrice = parseFloat(row.find('.selling-price').val()) || 0;
        const qty = sellingPrice > 0 ? total / sellingPrice : 0;
        row.find('.qty').val(qty.toFixed(2));
        updateGrandTotal();
    }

    row.find('.item-select').on('change', function () {
    const selected = $(this).find(':selected');
    const price = parseFloat(selected.data('price')) || 0;
    const unit = selected.data('unit') || '';
    const mrp = parseFloat(selected.data('mrp')) || 0;
    const purchaseRate = parseFloat(selected.data('purchase_rate')) || 0;

    row.find('.actual-price').val(price);
    row.find('.selling-price').val(price); 
    row.find('.unit').val(unit);
    row.find('.mrp').val(mrp);
    row.find('.purchase-rate').val(purchaseRate);

    calculateTotal();
});

    row.find('.qty, .selling-price').on('input', function () {
        calculateTotal();
    });

    row.find('.total-price').on('input', function () {
        calculateQty();
    });
}

$('#addItem').on('click', function () {
    const newRow = $(`
        <div class="row g-3 align-items-end item-row mb-2">
            <div class="col-md-3">
              <select name="items[${itemIndex}][item_id]" class="form-select item-select select2" required>
                    <option value="">-- Select Item --</option>
                    <?php foreach ($items as $item): ?>
                        <option value="<?= $item->id ?>" 
                                data-price="<?= $item->rate_per_unit ?>" 
                                data-unit="<?= $item->unit ?>"
                                 data-mrp="<?= $item->MRP ?>"
                                    data-purchase_rate="<?= $item->purchase_rate ?>"
                                >
                            <?= $item->title ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                 <div class="d-flex gap-2">
                        <div class="">
                        <label class="form-label">Purchase Rate</label>
                        <input type="number" class="form-control purchase-rate" readonly>
                        </div>
                        <div class="">
                        <label class="form-label">MRP</label>
                        <input type="number" class="form-control mrp" readonly>
                        </div>
                        </div>
            </div>
            <div class="col-md-2">
                <input type="number" name="items[${itemIndex}][qty]" class="form-control qty" value="1" required>
            </div>
             <div class="col-md-1">
                <input type="text" class="form-control unit" readonly>
            </div>
            <div class="col-md-1">
                <input type="number" class="form-control actual-price" readonly>
            </div>
            <div class="col-md-2">
                <input type="number" name="items[${itemIndex}][selling_price]" class="form-control selling-price" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="items[${itemIndex}][total]" class="form-control total-price">
            </div>
            
            <div class="col-md-1 text-end">
                <button type="button" class="btn btn-danger remove-btn"><i class="fa fa-trash"></i></button>
            </div>
        </div>
    `);

    $('#items-wrapper').append(newRow);
    bindItemEvents(newRow);
    itemIndex++;
});

function updateGrandTotal() {
    let grandTotal = 0;
    $('.total-price').each(function () {
        grandTotal += parseFloat($(this).val()) || 0;
    });
    $('#grandTotal').val(grandTotal.toFixed(2));
}

// Update on item remove
$(document).on('click', '.remove-btn', function () {
    $(this).closest('.item-row').remove();
    updateGrandTotal();
});

// Bind to initial row
bindItemEvents($('.item-row'));
// });



$("#invoiceForm").validate({
    errorPlacement: function (error, element) {
        error.addClass("invalid-feedback");
        if (element.prop("type") === "checkbox") {
            error.insertAfter(element.siblings("label"));
        } else {
            error.insertAfter(element);
        }
    },
    highlight: function (element, errorClass, validClass) {
        if (!$(element).prop("readonly")) { // Apply styles only if the input is NOT read-only
            $(element).addClass(errorClass).removeClass(validClass);
        }
    },
    unhighlight: function (element, errorClass, validClass) {
        if (!$(element).prop("readonly")) { // Apply styles only if the input is NOT read-only
            $(element).removeClass(errorClass).addClass(validClass);
        }
    },
    rules: {
        // Add your validation rules here
    },
    messages: {
        // Add your validation messages here
    },
    errorElement: "div",
        errorClass: 'is-invalid',
        validClass: 'is-valid',
    submitHandler: function (form) {
        var formData = new FormData($(form)[0]);
        $.ajax({
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            url: form.action,
            dataType: 'json',
            data: formData,
            success: function (data) {
                console.log(data);
                if (data.success == 0) {
                    $('#message_show').html(data.message);
                } else {
                    $('#message_show').html(data.message);
                    setTimeout(function () {
                        location.href = "<?= base_url('invoice/view/') ?>" + data.invoice_id;
                    }, 1000);
                }
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
            },
            beforeSend: function () {
                $("#show-hide").show();
            },
            complete: function () {
                $("#show-hide").hide();
            }
        });
    }
}).settings.ignore = [];

</script>

































