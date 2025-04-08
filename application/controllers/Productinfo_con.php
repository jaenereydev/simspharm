<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productinfo_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Supplier_model');
        $this->load->model('Category_model');
        $this->load->model('Product_model');
    
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

        if($this->session->userdata('product') == null){
            redirect('product_con');
        }else {      
            $this->data['alert'] = null;   
            $this->data['message'] = null;
            $this->productvar();
        }
    }
    
    //--------------------------------------------------------------------------
    

    public function productvar()
    {                    
        $this->data['prod'] = $this->Product_model->productinfo($this->session->userdata('product'));
        $this->data['prodhistory'] = $this->Product_model->producthistoryinfo($this->session->userdata('product'));
        $this->data['prodlothistory'] = $this->Product_model->productlothistory($this->session->userdata('product'));

        $this->data['sup'] = $this->Supplier_model->get_supplier();
        $this->data['cat'] = $this->Category_model->get_category();

        $this->render_html('product/productinfo_view', true); 
}
    //--------------------------------------------------------------------------

    public function updateproductcategory()
    {                    
        $prod = array(            
            'category_c_no' => $this->input->post('cno'),
            'user_id' => $this->session->userdata('id'),                    
        );
        $this->Product_model->updateproduct($this->session->userdata('product'), $prod);

        redirect('productinfo_con');
    }
    
    //--------------------------------------------------------------------------

    public function updateproductsupplier()
    {                    
        $prod = array(            
            'supplier_s_no' => $this->input->post('sno'),
            'user_id' => $this->session->userdata('id'),                    
        );
        $this->Product_model->updateproduct($this->session->userdata('product'), $prod);

        redirect('productinfo_con');
    }
    
    //--------------------------------------------- -----------------------------

    public function updateproduct()
    {                    
        $p = array(        
            'name' => $this->input->post('name'),
            'brand' => $this->input->post('brand'),
            'unitcost' => $this->input->post('unitcost'),            
            'srpprice' => $this->input->post('price1'),
            'price2' => $this->input->post('price2'),
            'price3' => $this->input->post('price3'),                    
            'user_id' => $this->session->userdata('id'),
            'inventory' => $this->input->post('ti'),         
            'uom' => $this->input->post('uom'),       
        );
        $this->Product_model->updateproduct($this->session->userdata('product'),$p);
        $this->data['alert'] =   1; 
        $this->data['message'] = 'Product successfully saved!';
        $this->productvar();
    }
    
    //--------------------------------------------------------------------------

    public function insertlotinformation()
    {                    
        $p = array(        
            'date' => $this->input->post('date'),
            'description' => 'ADDED',
            'lot_number' => $this->input->post('lotnumber'),
            'expiration_date' => date_format(date_create($this->input->post('expirationdate')), 'Y/m/d'),
            'delivered_quantity' => '0',
            'unit_cost' => $this->input->post('unitcost'),
            'supplier_s_no' => $this->input->post('sno'),
            'product_p_no' => $this->session->userdata('product'),
            'remaining_quantity' => $this->input->post('remainingquantity'),
            'user_id' => $this->session->userdata('id'), 
        );
        $lotnumber = $this->Product_model->insertlotinformation($p);
        $productquantity = $this->Product_model->get_productqty($this->session->userdata('product'));
    
        $history = array(        
            'date' => $this->input->post('date'),
            'description' => "ADDED",
            'lot_number' => $this->input->post('lotnumber'),
            'expiration_date' => date_format(date_create($this->input->post('expirationdate')), 'Y/m/d'),
            'plh_number' => $lotnumber,
            'unit_cost' => $this->input->post('unitcost'),
            'inqty' => $this->input->post('remainingquantity'),
            'product_p_no' => $this->session->userdata('product'),
            'bal' => $this->input->post('remainingquantity')+$productquantity[0]->qty,
            'user_id' => $this->session->userdata('id'), 
        );
        $this->Product_model->insertproducthistory($history);

        $qty = array(             
            'qty' => $productquantity[0]->qty+$this->input->post('remainingquantity'),       
        );
        $this->Product_model->updateproduct($this->session->userdata('product'),$qty);

        $this->data['alert'] =   1; 
        $this->data['message'] = 'Lot number successfully added!';
        $this->productvar();
    }
    
    //--------------------------------------------------------------------------

}
