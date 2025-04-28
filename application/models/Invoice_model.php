<?php
 
 
class Invoice_model extends CI_Model{

    private $table = 'invoice_master';
    private $column_order = ['invoice_number', 'name', 'purchase_date', 'total_amount','paid_amount','due_amount'];
    private $column_search = ['invoice_number', 'name', 'purchase_date', 'total_amount','paid_amount','due_amount'];
    private $order = ['id' => 'asc'];

    private function _get_datatables_query() {
        $select_array = array('in.id', 'in.invoice_number','in.purchase_date','in.total_amount','in.due_amount', 'in.paid_amount','c.name');
        $this->db->select($select_array);
        $this->db->from('invoice_master in');
        $this->db->join('customers as c', 'in.customer_id=c.id', 'left');
        // $this->db->from($this->table);
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

    public function get_invoice() {
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
    public function get_all_customers(){
        // $this->db->from('customers');
        $query = $this->db->get('customers');
        // echo $this->legacy_db->last_query();
        // die;
        return $query->result();
    }

    public function get_all_items(){
        // $this->db->from('customers');
        $query = $this->db->get('products');
        // echo $this->legacy_db->last_query();
        // die;
        return $query->result();
    }

    public function insertInvoice($invoice,$items)
    {
        // print_r($invoice);die();
        $this->db->trans_start();
        $this->db->insert($this->table, $invoice);
        $invoice_id= $this->db->insert_id();

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            if($invoice['total_amount']>0){
                $ledger=[
                    'invoice_id'=>$invoice_id,
                    'customer_id'  => $invoice['customer_id'],
                    'type'  => 'debit',
                    'amount'  => $invoice['total_amount'],
                    
                   
                ];

                $this->db->insert('customer_ledger', $ledger);
            }
            if($invoice['paid_amount']>0){
            $ledger=[
                'invoice_id'=>$invoice_id,
                'customer_id'  => $invoice['customer_id'],
                'type'  => 'credit',
                'amount'  => $invoice['due_amount'],
                
               
            ];

            $this->db->insert('customer_ledger', $ledger);
            }
            foreach ($items as $item) {
                if (!empty($item['item_id'])) {
                    $itemData = [
                        'invoice_id'     => $invoice_id,
                        'item_id'        => $item['item_id'],
                        'quantity'            => $item['qty'],
                        
                        'selling_price_rate	'  => $item['selling_price'],
                        'total_price'          => $item['total'],
                    ];
                    
                }
               // ======= Stock Update Logic Start =======

                // 1. Fetch current stock
                $this->db->select('stock');
                $this->db->from('products'); // your table name (change if different)
                $this->db->where('id', $item['item_id']);
                $query = $this->db->get();
                $currentItem = $query->row();

                if ($currentItem) {
                    $current_stock = (float)$currentItem->stock;
                    $new_stock = $current_stock - (float)$item['qty'];

                    if ($new_stock < 0) {
                        $new_stock = 0; // Avoid negative stock if needed
                    }

            // 2. Update stock
            $this->db->where('id', $item['item_id']);
            $this->db->update('products', ['stock' => $new_stock]);
        }

        // ======= Stock Update Logic End =======
                $items_arr[]=$itemData;
            }
            $this->db->insert_batch('invoice_transaction', $items_arr);
            return $invoice_id;
// print_r($items_arr);die();
    }
}
public function getInvoiceById($id)
{
    $this->db->select('invoice_master.*, customers.name as customer_name,customers.phone as customer_phone');
    $this->db->from('invoice_master');
    $this->db->join('customers', 'customers.id = invoice_master.customer_id');
    $this->db->where('invoice_master.id', $id);
    return $this->db->get()->row();
}

public function getInvoiceItems($invoice_id)
{
    $this->db->select('invoice_transaction.*, products.title as item_title, products.unit,products.rate_per_unit');
    $this->db->from('invoice_transaction');
    $this->db->join('products', 'products.id = invoice_transaction.item_id');
    $this->db->where('invoice_transaction.invoice_id', $invoice_id);
    return $this->db->get()->result();
}

public function get_by_id($id) {
    return $this->db->get_where($this->table, ['id' => $id])->row();
}

public function update($id, $data) {
    // print_r($data);die();
    return $this->db->where('id', $id)->update($this->table, $data);
}
}
