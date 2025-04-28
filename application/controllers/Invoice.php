<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Invoice_model');
    }

    public function index() {
        $this->load->view('invoice/manage_invoice');
    }
    public function add() {
        $data['customers']=$this->Invoice_model->get_all_customers();
        $data['items']=$this->Invoice_model->get_all_items();
        $this->load->view('invoice/add_invoice',$data);
    }

    public function fetch_invoice() {
        $list = $this->Invoice_model->get_invoice();
        $data = [];
        $no = $_POST['start'];

        foreach ($list as $invoice) {
            $no++;
            $row = [];
            $row[] = $invoice->invoice_number;
            $row[] = $invoice->name;
            $row[] = $invoice->purchase_date;
            $row[] = $invoice->total_amount;
            $row[] = $invoice->paid_amount;
            $row[] = $invoice->due_amount;
            $row[]='
       <span class="action-group">
    <a href="'.base_url().'invoice/view/'.$invoice->id.'" title="View"><i class="fa fa-eye text-primary me-2"></i></a>
  
</span>';
            $data[] = $row;
        }

        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $this->Invoice_model->count_all(),
            "recordsFiltered" => $this->Invoice_model->count_filtered(),
            "data" => $data,
        ];

        echo json_encode($output);
    }

    public function save_print(){
        // print_r($this->input->post());die();

        {
            // Load model if not loaded
            $this->load->model('Invoice_model');
        
            // Validate required fields
            $customer_id  = $this->input->post('customer_id');
            $items        = $this->input->post('items');
            $grand_total  = $this->input->post('grand_total');
            $paid_amount  = $this->input->post('paid_amount');
        
           
        
            // Prepare invoice data
            $invoiceData = [
                'invoice_number'=>'inv_'.$customer_id.'_'.date('Y-m-d H:i:s'),
                'customer_id'  => $customer_id,
                'total_amount'  => $grand_total,
                'paid_amount'  => $paid_amount,
                'due_amount'  => $grand_total - $paid_amount,
               
            ];
            
            // Insert invoice and get ID
            $invoice_id = $this->Invoice_model->insertInvoice($invoiceData,$items);
            $message = 'Invoice added successfully.';
            echo json_encode(['status' => true, 'message' => $message,'invoice_id'=>$invoice_id]);
            
        //    print_r($invoiceData);die();
    }
}
public function view($id)
{
    $this->load->model('Invoice_model');
    $invoice = $this->Invoice_model->getInvoiceById($id);
    $items = $this->Invoice_model->getInvoiceItems($id);

    if (!$invoice) {
        show_404();
    }

    $data['invoice'] = $invoice;
    $data['invoice_items'] = $items;
// print_r($data);die()
;    $this->load->view('invoice/view_invoice', $data);
}

public function update_paid_amount() {
    $invoice_id = $this->input->post('invoice_id');
    $paid_amount = $this->input->post('paid_amount');

    $invoice = $this->Invoice_model->get_by_id($invoice_id);
    if (!$invoice) {
        echo json_encode(['status' => false]);
        return;
    }

    $due_amount = $invoice->total_amount - $paid_amount;

    $data = [
        'paid_amount' => $paid_amount,
        'due_amount' => $due_amount,
        'last_updated'=>date('Y-m-d H:i:s')
    ];

    $this->Invoice_model->update($invoice_id, $data);

    echo json_encode(['status' => true]);
}
}
