<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stockadjustment_con extends MY_Controller
{
    //--------------------------------------------------------------------------
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Product_model');
        $this->load->model('Stockadjustment_model');
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
        $this->session->unset_userdata('sano');
        $this->data['stockadjustment'] = $this->Stockadjustment_model->get_stockadjustmentlist();

        $this->render_html('stockadjustment/stockadjustment_view', true); 
    }
    
    //--------------------------------------------------------------------------

    public function insertstockadjustment()
    { 
        $sa = array(
            'date' => date('Y/m/d'),
            'user_id' => $this->session->userdata('id'),
        );
        $sano = $this->Stockadjustment_model->insertstockadjustment($sa); // insert inverntory line    
        $this->session->set_userdata(['sano' => $sano]);
        $this->data['stockadjustmentinfo'] = $this->Stockadjustment_model->get_stockadjustmentinfo($this->session->unset_userdata('sano'));
        $this->render_html('stockadjustment/stockadjustmentinfo_view', true); 
    }
    
    //--------------------------------------------------------------------------
    
    // public function selectsupplier($s)
    // {                    
    //     $del = array(
    //         'supplier_s_no' => $s,
    //         'discount' => '0',
    //         'user_id' => $this->session->userdata('id'),
    //         'post' => 'NO'
    //     );
    //     $dno = $this->Delivery_model->insertdelivery($del);
    //     $this->session->set_userdata(['dno' => $dno]);
    //     redirect('Deliveryinfo_con');
    // }
    
    //--------------------------------------------------------------------------

    public function stockadjustmentinfo($sa)
    { 
        // $this->session->set_userdata(['dno' => $d]);
        // redirect('Deliveryinfo_con');
    }
    
    //--------------------------------------------------------------------------

    // public function exporttoexcel($d)
    // {
    //     $del = $this->Delivery_model->get_deliveryinfo($d);
    //     $delline = $this->Delivery_model->get_deliveryline($d);
    //     $this->load->view('delivery/report/deliveryreport_excel', array('del' => $del, 'delline' => $delline));  
    // }

    //--------------------------------------------------------------------------

    public function deletestockadjustment($sa)
    {         
        // $this->Delivery_model->deletedelivery($d);
        // redirect('Delivery_con');
    }
    
    //--------------------------------------------------------------------------

    public function poststockadjustment($d)
    {         
        // $del = array(
        //     'post' => "YES"
        // );
        // $desc = "DELIVERY";
        // $this->Delivery_model->updatedelivery($d, $del); //update delivery file to post

        // $this->Producthistory_model->insert_deliveryproducthistory($d, $desc); //update product history

        // $this->Producthistory_model->insert_deliveryproductlothistory($d, $desc); //update product lot history

        // $this->Product_model->updatedeliveryproductqty($d); // update product qty

        // redirect('delivery_con');

    }
    
    //--------------------------------------------------------------------------

}
