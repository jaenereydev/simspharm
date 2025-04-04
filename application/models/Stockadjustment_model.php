<?php

class Stockadjustment_model extends CI_Model
{

 //----------------------------------------------------------------------
  
  public function get_stockadjustmentlist() 
  {
  
    $sql = "SELECT * 
            FROM stockadjustment 
            WHERE MONTH(date) = MONTH(CURRENT_DATE()) 
            AND YEAR(date) = YEAR(CURRENT_DATE()) 
            ORDER BY sa_no DESC ";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------

  public function get_stockadjustmentinfo($sa) 
  {
    $sql = "Select d.*, s.name as name
            from delivery d 
            join supplier s on s.s_no = d.supplier_s_no 
            where d.d_no = '$d' ";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------

// public function get_totalaccountpayeble() //get sum of account payable
//   {
//     $sql = "select sum(totalamount) as ta from delivery where post = 'YES' and status is null";
//     $query = $this->db->query($sql);
//     return $query->result();
//   }

//  //----------------------------------------------------------------------


//   public function get_deliveryline($d) 
//   {
  
//     $sql = "Select d.*, p.name as name, p.barcode as barcode, p.uom as uom
//             from deliveryline d 
//             join product p on p.p_no = d.product_p_no 
//             where d.delivery_d_no = '$d' ";
//     $query = $this->db->query($sql);
//     return $query->result();
//   }

//   //----------------------------------------------------------------------

//   public function get_sumdeliveryline($d) 
//   {
  
//     $sql = "SELECT sum(price) as ta FROM `deliveryline` WHERE delivery_d_no = '$d'";
//     $query = $this->db->query($sql);
//     return $query->result();
//   }

//----------------------------------------------------------------------



  public function insertstockadjustment($sa = null) 
  {  
    $this->db->insert('stockadjustment',$sa);
    return $this->db->insert_id();
  }

 //----------------------------------------------------------------------

//   public function updatedelivery($d, $del = null) 
//   {  
//       $this->db->where('d_no',$d)
//               ->update('delivery', $del);
//   }

//  //    //-------------------------------------------------------------------------- 

//   public function updatedeliveryline($dl, $del = null) 
//   {  
//       $this->db->where('dl_no',$dl)
//               ->update('deliveryline', $del);
//   }

//  //-------------------------------------------------------------------------- 

//  public function insertdeliveryline($dl = null) 
//   {  
//       return $this->db->insert('deliveryline',$dl);
//   }

//  //----------------------------------------------------------------------


//   public function deletedeliveryline($dl) 
//   {                       
//        $this->db->delete('deliveryline', array('dl_no' => $dl));
//   }

//   //----------------------------------------------------------------------

//   public function deletedelivery($d) 
//   {                       
//        $this->db->delete('deliveryline', array('delivery_d_no' => $d));
//        $this->db->delete('delivery', array('d_no' => $d));
//   }

//   //----------------------------------------------------------------------


}
