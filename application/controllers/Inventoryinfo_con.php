<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventoryinfo_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Inventory_model');
        $this->load->model('Sales_model');
        $this->load->model('Product_model');
        $this->load->model('Producthistory_model');
        $this->user = $this->User_model->get_users( $this->session->userdata('id'));
        $this->com = $this->Company_model->get_companyinfo();
        $this->active = "1";
        $this->open = "1";
        $this->data = [
            'users' => $this->user,
            'hidebtn' => 0,
            'com' => $this->com,
            'active' => $this->active,
            'open' => $this->open
        ];

        
        $user_id = $this->session->userdata('id');
        if(!$user_id) {
            $this->logout();
        }
    }
    
    //--------------------------------------------------------------------------                   
    
    public function index()
    {   

        $this->data['prod'] = $this->Product_model->get_productinv($this->session->userdata('ino')); //product list
        $this->data['invline'] = $this->Inventory_model->get_inventoryline($this->session->userdata('ino')); // customer list
        $this->data['inv'] = $this->Inventory_model->get_inventoryinfo($this->session->userdata('ino')); // customer list
        $this->data['c'] = $this->Inventory_model->get_countinventoryline($this->session->userdata('ino')); // customer list

        $this->render_html('inventory/insertinventory_view', true); 
    }
    
    //--------------------------------------------------------------------------
    
    public function resetinventory()
    {                                      
        $this->Inventory_model->deleteallinventoryline($this->session->userdata('id'));
        redirect('Inventoryinfo_con');
    }
    
    //--------------------------------------------------------------------------  

    public function insertinventoryline()
    {                 
        
        $lotnumber = $this->Product_model->productlothistoryinfo($this->input->post('lot_number'));
        $il = array(
            'lot_number' => $lotnumber[0]->lot_number,
            'expiration_date' => $lotnumber[0]->expiration_date,
            'plh_number' =>  $lotnumber[0]->plh_number,
            'unitcost' => $lotnumber[0]->unit_cost,
            'qty' => $this->input->post('qty'),
            'oldqty' => $lotnumber[0]->remaining_quantity,
            'price' => $uc*$this->input->post('qty'),
            'product_p_no' => $lotnumber[0]->product_p_no,
            'inventory_i_no' => $this->session->userdata('ino'),
            'user_id' => $this->session->userdata('id'),
        );
        $this->Inventory_model->insertinventoryline($il); // insert inverntory line
    
        redirect('Inventoryinfo_con');
    }
    
    // //--------------------------------------------------------------------------

    public function updateinventoryline()
    {        
        $lotnumber = $this->Sales_model->get_lotnumberinfo($this->input->post('lot_number'));            
        $il = array(
            'unitcost' => $lotnumber[0]->unit_cost,
            'qty' => $this->input->post('qty'),
            'oldqty' => $lotnumber[0]->remaining_quantity,
            'price' => $lotnumber[0]->unit_cost*$this->input->post('qty'),
            'lot_number' => $lotnumber[0]->lot_number,
            'expiration_date' => $lotnumber[0]->expiration_date,
            'plh_number' => $this->input->post('lot_number'),
        );
        $this->Inventory_model->updateinventoryline( $this->input->post('dlno'),$il);    
    
        redirect('Inventoryinfo_con');
    }
    
    // //--------------------------------------------------------------------------

    public function updateinventory()
    {                    
        $i = array(
            'totalamount' => $this->input->post('totalamount'),
            'ref_no' => $this->input->post('refno'),
            'remarks' => $this->input->post('remarks'),
        );
        $this->Inventory_model->updateinventory( $this->session->userdata('ino'),$i);    
    
        redirect('Inventory_con');
    }
    
    // //--------------------------------------------------------------------------

    
    public function deleteinventoryline($il)
    {                                      
        $this->Inventory_model->deleteinventoryline($il);
        redirect('Inventoryinfo_con');
    }
    
    //--------------------------------------------------------------------------

}
