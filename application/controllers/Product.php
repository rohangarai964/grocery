<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
    }

    public function index() {
        $this->load->view('product/manage_product');
    }
    public function add() {
        $this->load->view('product/add_products');
    }

    public function fetch_products() {
        $list = $this->Product_model->get_customers();
        $data = [];
        $no = $_POST['start'];

        foreach ($list as $product) {
            $no++;
            $row = [];
            $row[] = $product->id;
            $row[] = $product->title;
            $row[] = $product->description;
            $row[] = $product->rate_per_unit;
			$row[] = $product->unit;
            $row[] = $product->stock;
            $row[] = $product->MRP;
            $row[] = $product->purchase_rate;
            $row[]='
        <span class="action-group">
            <a href="'.base_url().'product/edit/'.$product->id.'" title="Edit"><i class="fa fa-pencil"></i></a></span>';
            $data[] = $row;
        }

        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $this->Product_model->count_all(),
            "recordsFiltered" => $this->Product_model->count_filtered(),
            "data" => $data,
        ];

        echo json_encode($output);
    }
    public function edit($id) {
        // $customer = $this->Product_model->get_by_id($id);
        $result['data'] = $this->Product_model->get_by_id($id);
        $this->load->view('product/add_products',$result);
    }

    public function save_product() {
        $this->load->library('form_validation');
    
        $this->form_validation->set_rules('title', 'Title', 'required');
       
        $this->form_validation->set_rules('rate_per_unit', 'Rate_per_unit', 'required');
		$this->form_validation->set_rules('unit', 'Unit', 'required');
        $this->form_validation->set_rules('stock', 'Stock', 'required');
        $this->form_validation->set_rules('purchase_rate', 'Purchase Rate', 'required');
        $this->form_validation->set_rules('mrp', 'MRP', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => false,
                'errors' => validation_errors()
            ]);
        } else {
            $id = $this->input->post('id'); // if set, this is an update
    
            $data = [
                'title'  => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'rate_per_unit' => $this->input->post('rate_per_unit'),
				'unit' => $this->input->post('unit'),
                'stock' => $this->input->post('stock'),
                'MRP' => $this->input->post('mrp'),
                'purchase_rate' => $this->input->post('purchase_rate'),
            ];
    
            if (!empty($id)) {
                // UPDATE
                $this->Product_model->update($id, $data);
                $message = 'Item updated successfully.';
            } else {
                // INSERT
                $this->Product_model->insert($data);
                $message = 'Item added successfully.';
            }
    
            echo json_encode(['status' => true, 'message' => $message]);
        }
    }
}
