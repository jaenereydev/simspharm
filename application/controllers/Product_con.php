<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_con extends MY_Controller
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
        $this->session->unset_userdata('product');
        $this->data['alertbarcode'] = null;
        $this->data['message'] = null;
        $this->data['prod'] = null;
        $this->data['product'] = $this->Product_model->countproduct(); //number of product
        $this->data['sup'] = $this->Supplier_model->get_supplier();
        $this->data['cat'] = $this->Category_model->get_category();

        $this->render_html('product/product_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function productsave()
    {                    
        $this->session->unset_userdata('product');
        $this->data['alertbarcode'] = '1';
        $this->data['message'] = 'Product successfully saved!';
        $this->data['prod'] = null;
        $this->data['product'] = $this->Product_model->countproduct(); //number of product
        $this->data['sup'] = $this->Supplier_model->get_supplier();
        $this->data['cat'] = $this->Category_model->get_category();

        $this->render_html('product/product_view', true); 
    }
    
    //--------------------------------------------------------------------------


    public function insertsuccess()
    {                    
        $this->session->unset_userdata('product');
        $this->data['alertbarcode'] = '1';
        $this->data['message'] = 'Product added successfully!';
        $this->data['prod'] = null;
        $this->data['product'] = $this->Product_model->countproduct(); //number of product
        $this->data['sup'] = $this->Supplier_model->get_supplier();
        $this->data['cat'] = $this->Category_model->get_category();

        $this->render_html('product/product_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function productsearch()
    {                    
        $this->session->unset_userdata('product');
        $this->data['alertbarcode'] = null;
        $this->data['message'] = null;
        $this->data['product'] = $this->Product_model->countproduct(); //number of product
        $this->data['prod'] = $this->Product_model->get_productsearch($this->input->post('psearch'));
        $this->data['sup'] = $this->Supplier_model->get_supplier();
        $this->data['cat'] = $this->Category_model->get_category();

        $this->render_html('product/product_view', true); 
    }
    
    //--------------------------------------------------------------------------


    public function productunitcost()
    {                    
        $this->session->unset_userdata('product');
        $this->data['alertbarcode'] = null;
        $this->data['message'] = null;
        $this->data['product'] = $this->Product_model->countproduct(); //number of product
        $this->data['prod'] = $this->Product_model->get_allproductwithoutunitcost();
        $this->data['sup'] = $this->Supplier_model->get_supplier();
        $this->data['cat'] = $this->Category_model->get_category();

        $this->render_html('product/product_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function productwithnegativequantity()
    {                    
        $this->session->unset_userdata('product');
        $this->data['alertbarcode'] = '1';
        $this->data['message'] = 'Product with negative quantity';
        $this->data['product'] = $this->Product_model->countproduct(); //number of product
        $this->data['prod'] = $this->Product_model->get_allproductwithnegativequantity();
        $this->data['sup'] = $this->Supplier_model->get_supplier();
        $this->data['cat'] = $this->Category_model->get_category();

        $this->render_html('product/product_view', true); 
    }
    
    //--------------------------------------------------------------------------


    public function get_allproduct()
    {                    
        $this->session->unset_userdata('product');
        $this->data['alertbarcode'] = '1';
        $this->data['message'] ='Product page showing all products.';
        $this->data['product'] = $this->Product_model->countproduct(); //number of product
        $this->data['prod'] = $this->Product_model->get_product();
        $this->data['sup'] = $this->Supplier_model->get_supplier();
        $this->data['cat'] = $this->Category_model->get_category();

        $this->render_html('product/product_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function insertproduct()
    {                    
        $sbarcode = $this->Product_model->searchbarcode($this->input->post('barcode'));

        if(is_null($sbarcode[0]->barcode)){
            $p = array(
                'barcode' => $this->input->post('barcode'),
                'name' => $this->input->post('name'),
                'brand' => $this->input->post('brand'),
                'uom' => $this->input->post('uom'),
                'unitcost' => $this->input->post('unitcost'),
                'qty' => '0',
                'srpprice' => $this->input->post('price1'),
                'price2' => $this->input->post('price2'),
                'price3' => $this->input->post('price3'),        
                'active' => 'YES',
                'user_id' => $this->session->userdata('id'),
                'supplier_s_no' => $this->input->post('sno'),    
                'category_c_no' => $this->input->post('cno'),  
                'inventory' => $this->input->post('ti'),  
            );
            $this->Product_model->insertproduct($p);

            redirect('product_con/insertsuccess');
        }else{
            $this->data['alertbarcode'] = '1';
            $this->data['message'] = 'Product Barcode is Already Existed. Please insert new product.';
            $this->data['prod'] = null;
            $this->data['product'] = $this->Product_model->countproduct(); //number of product
            $this->data['sup'] = $this->Supplier_model->get_supplier();
            $this->data['cat'] = $this->Category_model->get_category();

            $this->render_html('product/product_view', true); 
        }
    }
    
    //--------------------------------------------------------------------------

    public function delproduct($p)
    {                    
        $prod = array(            
            'active' => 'NO',
            'user_id' => $this->session->userdata('id')            
        );
        $this->Product_model->updateproduct($p, $prod);

        redirect('product_con');
    }
    
    //--------------------------------------------------------------------------

    public function productinfo($p)
    {                            
        $this->session->set_userdata(['product' => $p]);  
        redirect('productinfo_con');
    }
    
    //--------------------------------------------------------------------------       
    
    public function getLotNumbers() 
    {
        $search = $this->input->post('search');
        $sano = $this->session->userdata('sano'); // Get sa_no from session

        $this->db->select('plh.plh_number, plh.lot_number, plh.expiration_date, plh.remaining_quantity, p.name, p.barcode');
        $this->db->from('product_lot_history plh');
        $this->db->join('product p', 'p.p_no = plh.product_p_no');
        $this->db->where('plh.remaining_quantity !=', 0);

        // Exclude plh_numbers already used in stockadjustmentline for current sa_no
        $this->db->where("plh.plh_number NOT IN (SELECT sal.plh_number FROM stockadjustmentline sal WHERE sal.sa_no = " . $this->db->escape($sano) . ")", null, false);

        // Search filters
        $this->db->group_start();
        $this->db->like('plh.lot_number', $search);
        $this->db->or_like('plh.expiration_date', $search);
        $this->db->or_like('p.name', $search);
        $this->db->group_end();

        $this->db->order_by('plh.expiration_date', 'ASC');
        $this->db->limit(20);

        $query = $this->db->get();
        echo json_encode($query->result());
    }


    //-------------------------------------------------------------------------- 

    public function getLotNumbersinventory() 
    {
        $search = $this->input->post('search');
        $ino = $this->session->userdata('ino'); // Get sa_no from session

        $this->db->select('plh.plh_number, plh.lot_number, plh.expiration_date, plh.remaining_quantity, p.name, p.barcode');
        $this->db->from('product_lot_history plh');
        $this->db->join('product p', 'p.p_no = plh.product_p_no');
        $this->db->where('plh.remaining_quantity !=', 0);

        // Exclude plh_numbers already used in stockadjustmentline for current sa_no
        $this->db->where("plh.plh_number NOT IN (SELECT sal.plh_number FROM inventoryline sal WHERE sal.inventory_i_no = " . $this->db->escape($ino) . ")", null, false);

        // Search filters
        $this->db->group_start();
        $this->db->like('plh.lot_number', $search);
        $this->db->or_like('plh.expiration_date', $search);
        $this->db->or_like('p.name', $search);
        $this->db->group_end();

        $this->db->order_by('plh.expiration_date', 'ASC');
        $this->db->limit(20);

        $query = $this->db->get();
        echo json_encode($query->result());
    }


    //-------------------------------------------------------------------------- 

}
