<?php $this->load->view('includes/header'); ?>

<div class="container mt-4" id="printArea">
    <div class="pos-receipt">
        <h5 class="text-center"><?= $invoice->invoice_number ?></h5>
        <p><strong>Date:</strong> <?= date('d-m-Y H:i A', strtotime($invoice->purchase_date)) ?></p>
        <p><strong>Customer:</strong> <?= $invoice->customer_name ?></p>
        <p><strong>Phone:</strong> <?= $invoice->customer_phone ?></p> 

        <table class="table table-bordered table-sm w-100 mt-3">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($invoice_items as $item): ?>
                        <tr>
                            <td>
                                <div class="d-flex flex-column">
                                    <div> <?= $item->item_title ?></div>
                                    <div>Rate: ₹ <?= number_format($item->rate_per_unit, 1) ?></div>
                                    <div>S Rate: ₹ <?= number_format($item->selling_price_rate, 1) ?></div>
                                </div>
                               
                        
                            </td>
                            <td><?= $item->quantity .' '  . $item->unit?></td>
                            <td>₹ <?= number_format($item->total_price, 1) ?></td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>

        <p class="mt-3"><strong>Grand Total:</strong> ₹ <?= number_format($invoice->total_amount, 2) ?></p>
        <p><strong>Paid:</strong> ₹ <?= number_format($invoice->paid_amount, 2) ?></p>
        <p><strong>Due:</strong> ₹ <?= number_format($invoice->due_amount, 2) ?></p>

        <p class="text-center mt-3">Thank you for your business!</p>
    </div>

    <div class="mt-3">
    <button class="btn btn-primary" onclick="printPOS()">🖨️ Print</button>
    <a href="<?= site_url('invoice') ?>" class="btn btn-secondary">Back</a>
</div>
</div>



<style>
/* POS Printer Optimized for 58mm Thermal Printer */
@media print {
    body * {
        visibility: hidden;
    }
    #printArea, #printArea * {
        visibility: visible;
    }
    #printArea {
        position: absolute;
        left: 0;
        top: 0;
        width: 58mm; /* Set width to 58mm */
        font-size: 16px; /* Adjust font size for readability */
        padding: 0;
        margin: 0;
        font-weight:bold;
    }

    h4, p {
        text-align: center;
        margin: 0;
        padding: 2px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse !important;
    }

    table th, table td {
      
        border: none!important;
        text-align: left;
        font-size: 14px;
        font-weight:bold;
        word-wrap: break-word; /* Ensure long text wraps */
    }

    /* Adjust column widths */
    table th:nth-child(1), table td:nth-child(1) {
        width: 50%; /* Item column */
    }
    table th:nth-child(2), table td:nth-child(2) {
        width: 20%; /* Qty column */
    }
    table th:nth-child(3), table td:nth-child(3) {
        width: 30%; /* Unit column */
    }
    
   

    button, a {
        display: none !important;
    }

    .no-print, .no-print * {
        display: none !important;
    }
}
</style>

<script>
function printPOS() {
    window.print();
}
</script>
