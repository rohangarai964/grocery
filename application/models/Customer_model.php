<?php
class Customer_model extends CI_Model {

    private $table = 'customers';
    private $column_order = ['id', 'name', 'email', 'phone'];
    private $column_search = ['name', 'email', 'phone'];
    private $order = ['id' => 'asc'];

    private function _get_datatables_query() {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by(
                $this->column_order[$_POST['order']['0']['column']],
                $_POST['order']['0']['dir']
            );
        } else if ($this->order) {
            $this->db->order_by(key($this->order), $this->order[key($this->order)]);
        }
    }

    public function get_customers() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        return $this->db->get()->result();
    }

    public function count_filtered() {
        $this->_get_datatables_query();
        return $this->db->get()->num_rows();
    }

    public function count_all() {
        return $this->db->count_all($this->table);
    }

    public function get_by_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        // echo $this->legacy_db->last_query();
        // die;
        return $query->result();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        $this->db->update($this->table, $data, ['id' => $id]);
    }

    public function get_by_customer($customer_id) {
        // return $this->db->where('customer_id', $customer_id)
        //                 ->order_by('created_at', 'ASC')
        //                 ->get('customer_ledger')->result();

        $this->db->select("cl.*, i.invoice_number");
        $this->db->from("customer_ledger cl");
        $this->db->join("invoice_master i", "cl.invoice_id = i.id", "left");
        $this->db->where("cl.customer_id", $customer_id);
        $this->db->order_by("cl.created_at", "ASC"); // optional: show latest entries first
        return $this->db->get()->result();

    }

    public function get_all_customers(){
        // $this->db->from('customers');
        $query = $this->db->get('customers');
        // echo $this->legacy_db->last_query();
        // die;
        return $query->result();
    }

    public function insert_ledger($data) {
        $this->db->insert('customer_ledger', $data);
    }
}
