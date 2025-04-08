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
      return $this->db->get_where('stockadjustment', ['sa_no' => $sa])->result();
  }

  //----------------------------------------------------------------------

  public function get_countstockadjustmentline($sa) 
  {
  
    $sql = "SELECT count(sa_no) as sano
            from stockadjustmentline 
            where sal_no = ? ";
    $query = $this->db->query($sql, array($sa));
    return $query->result();
  }

 //----------------------------------------------------------------------


  public function get_stockadjustmentline($sa) 
  {
      $sql = "SELECT s.*, p.name AS name, p.barcode AS barcode, p.uom AS uom
              FROM stockadjustmentline s 
              JOIN product p ON p.p_no = s.product_p_no
              WHERE s.sal_no = ?";
      $query = $this->db->query($sql, array($sa));
      return $query->result();
  }

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
