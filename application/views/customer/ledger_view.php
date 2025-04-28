<?php $this->load->view('includes/header'); ?>
<div class="container mt-4">
    <h4>Customer Ledger</h4>

    <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
        <div>
            <div>Customer Name: <?= $selected_customer[0]->name; ?></div>
            <div>Customer Phone: <?= $selected_customer[0]->phone; ?></div>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal">
            ➕ Add Ledger
        </button>
    </div>

    <?php if ($ledger): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Invoice</th>
                    <th>Debit (₹)</th>
                    <th>Credit (₹)</th>
                    <th>Due Balance (₹)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $balance = 0;
                    foreach ($ledger as $entry):
                        if ($entry->type == 'debit') $balance += $entry->amount;
                        else $balance -= $entry->amount;
                ?>
                    <tr>
                        <td><?= date('d-m-Y', strtotime($entry->created_at)) ?></td>
                        <td><?= $entry->invoice_number ?></td>
                        <td><?= $entry->type == 'debit' ? number_format($entry->amount, 2) : '' ?></td>
                        <td><?= $entry->type == 'credit' ? number_format($entry->amount, 2) : '' ?></td>
                        <td><?= number_format($balance, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No ledger entries found for this customer.</p>
    <?php endif; ?>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= site_url('customer/save_payment') ?>" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Add Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="customer_id" value="<?= $selected_customer[0]->id ?>">

                <div class="mb-3">
                    <label>Payment Amount</label>
                    <input type="number" step="0.01" name="amount" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Description (optional)</label>
                    <input type="text" name="description" class="form-control" placeholder="e.g. Advance payment">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save Payment</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>

<?php $this->load->view('includes/footer'); ?>
