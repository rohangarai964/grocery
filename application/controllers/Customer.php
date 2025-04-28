<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Customer_model');
    }

    public function index() {
        $this->load->view('customer/manage_customer');
    }
    public function add() {
        $this->load->view('customer/add_customer');
    }

    public function fetch_customers() {
        $list = $this->Customer_model->get_customers();
        $data = [];
        $no = $_POST['start'];

        foreach ($list as $customer) {
            $no++;
            $row = [];
            $row[] = $customer->id;
            $row[] = $customer->name;
            $row[] = $customer->email;
            $row[] = $customer->phone;
            $row[] = $customer->address;
            $row[]='
        <span class="action-group">
            <a href="'.base_url().'customer/edit/'.$customer->id.'" title="Edit"><i class="fa fa-pencil"></i></a></span>
            <span class="action-group">
            <a href="'.base_url().'customer/ledger/'.$customer->id.'" title="View ledger"><i class="fa fa-eye"></i></a></span>
            ';
            $data[] = $row;
        }

        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $this->Customer_model->count_all(),
            "recordsFiltered" => $this->Customer_model->count_filtered(),
            "data" => $data,
        ];

        echo json_encode($output);
    }
    public function ledger($customer_id) {
        // $customer = $this->Customer_model->get_by_id($id);
       
    

    // $data['customers'] = $this->Customer_model->get_all_customers();
    $data['selected_customer'] = $this->Customer_model->get_by_id($customer_id);
    $data['ledger'] = $customer_id ? $this->Customer_model->get_by_customer($customer_id) : [];

    $this->load->view('customer/ledger_view', $data);
    }

    public function edit($id) {
        // $customer = $this->Customer_model->get_by_id($id);
        $result['data'] = $this->Customer_model->get_by_id($id);
        $this->load->view('customer/add_customer',$result);
    }

    public function save_customer() {
        $this->load->library('form_validation');
    
        $this->form_validation->set_rules('name', 'Name', 'required');
        // $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => false,
                'errors' => validation_errors()
            ]);
        } else {
            $id = $this->input->post('id'); // if set, this is an update
    
            $data = [
                'name'  => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address')
            ];
    
            if (!empty($id)) {
                // UPDATE
                $this->Customer_model->update($id, $data);
                $message = 'Customer updated successfully.';
            } else {
                // INSERT
                $this->Customer_model->insert($data);
                $message = 'Customer added successfully.';
            }
    
            echo json_encode(['status' => true, 'message' => $message]);
        }
    }

    public function save_payment() {
        // $this->load->model('Ledger_model');
    
        $data = [
            'customer_id' => $this->input->post('customer_id'),
            'type' => 'credit',
            'amount' => $this->input->post('amount'),
            'description' => $this->input->post('description') ?: 'Customer Payment',
            'created_at' => date('Y-m-d H:i:s')
        ];
    
        $this->Customer_model->insert_ledger($data);
    
        $this->session->set_flashdata('success', 'Payment recorded successfully!');
        redirect('customer/ledger/'.$data['customer_id']);
    }
}
