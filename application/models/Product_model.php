<?php

class Product_model extends CI_Model
{

  //----------------------------------------------------------------------
  
  public function get_product() 
  {
  
    $sql = "Select * from product where active = 'YES' ";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function get_productqty($p) 
  {
  
    $sql = "Select qty from product where p_no = '$p' ";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function get_productnotindelivery($d) 
  {
  
    $sql = "Select * 
            from product 
            where active = 'YES' 
            and p_no not in (select product_p_no from deliveryline where delivery_d_no = '$d')";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function searchbarcode($b) 
  {
      $sql = "Select * from product 
              where active = 'YES' 
              and barcode = '$b'";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function get_productsearch($p) 
  {
      $sql = "SELECT * FROM product 
              WHERE active = 'YES' 
              AND (barcode LIKE ? OR name LIKE ? OR brand LIKE ?)";
      
      $like_param = '%' . $p . '%';
      $query = $this->db->query($sql, array($like_param, $like_param, $like_param));
      return $query->result();
  }

  //----------------------------------------------------------------------

  public function get_allproductwithoutunitcost() 
  {
  
      $sql = "Select * from product 
              where active = 'YES' 
              and unitcost = '0'";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function get_allproductwithnegativequantity() 
  {
  
      $sql = "Select * from product 
              where active = 'YES' 
              and qty < '0'";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  //connection to reports inventory cost
  public function inventorycost()
  {
  
    $sql = "Select p.*, r.name, r.brand, r.barcode
            from product_lot_history p
            JOIN product r on r.p_no = p.product_p_no
            where r.active = 'YES' ";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------

  public function inventorytotalcost() 
  {
  
    $sql = "Select sum(p.remaining_quantity*p.unit_cost) as tcost, sum(p.remaining_quantity) as tqty 
            from product_lot_history p
            JOIN product r on r.p_no = p.product_p_no
            where r.active = 'YES' ";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function get_productfortransaction($u) 
  {
    $sql = "Select * 
              from product 
              where active = 'YES' 
              and p_no not in (select product_p_no from transactionline where user_id = '$u' and transaction_t_no is null)";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------


  public function get_productinv($i) 
  {  
    $sql = "SELECT * 
            from product 
            where active = 'YES' 
            and p_no NOT IN (SELECT product_p_no from inventoryline where inventory_i_no ='$i') ";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function get_productstockadjustment($sa) 
  {  
    $sql = "SELECT h.*, p.name as name
            from product_lot_history h
            join product p ON p.p_no = h.product_p_no
            where p.active = 'YES' 
            and plh_number NOT IN (SELECT plh_number from stockadjustmentline where sa_no ='$sa') ";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function productinfo($p) 
{
    $sql = "SELECT p.*, s.name AS sname, c.name AS cname, p.unitcost * p.qty AS cost
            FROM product p 
            JOIN supplier s ON s.s_no = p.supplier_s_no 
            JOIN category c ON c.c_no = p.category_c_no 
            WHERE p.p_no = ?";
    
    $query = $this->db->query($sql, array($p));
    return $query->result();
}


  //----------------------------------------------------------------------

  public function producthistoryinfo($p) 
  {
      $sql = "SELECT p.*, u.name AS name, c.name AS cname
              FROM product_history p 
              JOIN user u ON u.id = p.user_id 
              LEFT JOIN customer c ON c.c_no = p.c_no  -- change this if needed
              WHERE p.product_p_no = ?";
      
      $query = $this->db->query($sql, array($p));
      return $query->result();
  }


  //----------------------------------------------------------------------

  public function productlothistoryinfo($p) 
  {
      $sql = "SELECT * FROM product_lot_history WHERE plh_number = ?";
      $query = $this->db->query($sql, [$p]);
      return $query->result();
  }

  //----------------------------------------------------------------------


  public function productlothistory($p) 
  {
  
    $sql = "Select p.*, u.*, s.name as name 
          from product_lot_history p 
          join user u ON u.id = p.user_id 
          join supplier s ON s.s_no = p.supplier_s_no
          where p.product_p_no = '$p' ";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function insertproduct($p = null) 
  {  
      $this->db->insert('product',$p);
  }

  //--------------------------------------------------------------------------     

  public function insertproducthistory($p = null) 
  {  
      $this->db->insert('product_history',$p);
  }

  //--------------------------------------------------------------------------     

  public function insertlotinformation($p = null) 
  {  
      $this->db->insert('product_lot_history',$p);
      return $this->db->insert_id();
  }

  //--------------------------------------------------------------------------     

  public function updateproduct($p, $prod = null) 
  {  
      $this->db->where('p_no',$p)
              ->update('product', $prod);
  }

  //--------------------------------------------------------------------------    

  public function countproduct() 
  {
  
    $sql = "Select count(p_no) as p from product where active = 'YES' ";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------

  public function countproductwounitcost() 
  {
  
    $sql = "Select count(p_no) as p from product where active = 'YES' and unitcost = '0' ";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------

  public function productwithnegativequantity() 
  {
  
    $sql = "Select count(p_no) as p from product where active = 'YES' and qty < '0' ";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------

  public function updatedeliveryproductqty($d) // update qty from delivery
    {
        $sql = "update product set product.qty = (select (product.qty + deliveryline.qty) "
                                            . "from deliveryline "
                                            . "where deliveryline.product_p_no = product.p_no "
                                            . "and deliveryline.delivery_d_no = '$d') "
                    . "where product.p_no IN (select deliveryline.product_p_no "
                                            . "from deliveryline "
                                            . "where deliveryline.product_p_no = product.p_no "
                                            . "and deliveryline.delivery_d_no = '$d')";
        return $this->db->query($sql);
    }
    
  //--------------------------------------------------------------------------

  public function updatesalesproductqty($tno) // update qty from POS
  {
      $sql = "update product set product.qty = (select (product.qty - transactionline.qty) "
                                          . "from transactionline "
                                          . "where transactionline.product_p_no = product.p_no "
                                          . "and transactionline.transaction_t_no = '$tno') "
                  . "where product.p_no IN (select transactionline.product_p_no "
                                          . "from transactionline "
                                          . "where transactionline.product_p_no = product.p_no "
                                          . "and transactionline.transaction_t_no = '$tno')";
      return $this->db->query($sql);
  }
    
  //--------------------------------------------------------------------------

  public function updatesalesproductlothistoryremainingquantity($tno) // update product_lot_history remaining_quantity from POS
  {
      $sql = "update product_lot_history set product_lot_history.remaining_quantity = (select (product_lot_history.remaining_quantity - transactionline.qty) "
                                          . "from transactionline "
                                          . "where transactionline.plh_number = product_lot_history.plh_number "
                                          . "and transactionline.transaction_t_no = '$tno') "
                  . "where product_lot_history.plh_number IN (select transactionline.plh_number "
                                          . "from transactionline "
                                          . "where transactionline.plh_number = product_lot_history.plh_number "
                                          . "and transactionline.transaction_t_no = '$tno')";
      return $this->db->query($sql);
  }
    
  //--------------------------------------------------------------------------

  public function updatesalesproductlothistoryremainingquantityinventory($tno)
  {
      $sql = "UPDATE product_lot_history ph
              JOIN (
                  SELECT plh_number, SUM(qty) AS qty
                  FROM inventoryline
                  WHERE inventory_i_no = ?
                  GROUP BY plh_number
              ) il ON il.plh_number = ph.plh_number
              SET ph.remaining_quantity = il.qty";
  
      return $this->db->query($sql, array($tno));
  }
    
  //--------------------------------------------------------------------------

  public function updatestockadjustmentproductlothistoryremainingquantity($type = 'positive')
  {
      // Get session sano value
      $sano = $this->session->userdata('sano');
      if (!$sano) return false;

      // Determine operator based on adjustment type
      $operator = ($type === 'negative') ? '-' : '+';

      $sql = "UPDATE product_lot_history ph
              JOIN (
                  SELECT plh_number, SUM(qty) AS total_qty
                  FROM stockadjustmentline
                  WHERE sa_no = ?
                  GROUP BY plh_number
              ) sal ON sal.plh_number = ph.plh_number
              SET ph.remaining_quantity = ph.remaining_quantity $operator sal.total_qty";

      return $this->db->query($sql, array($sano));
  }


  //--------------------------------------------------------------------------

  public function updatesalesproductlothistoryremainingquantityvoid($tno) // update product_lot_history remaining_quantity void from POS
  {
      // $sql = "update product_lot_history set product_lot_history.remaining_quantity = (select (product_lot_history.remaining_quantity + transactionline.qty) "
      //                                     . "from transactionline "
      //                                     . "where transactionline.plh_number = product_lot_history.plh_number "
      //                                     . "and transactionline.transaction_t_no = '$tno') "
      //             . "where product_lot_history.plh_number IN (select transactionline.plh_number "
      //                                     . "from transactionline "
      //                                     . "where transactionline.plh_number = product_lot_history.plh_number "
      //                                     . "and transactionline.transaction_t_no = '$tno')";
      // return $this->db->query($sql);

      $sql = "UPDATE product_lot_history ph
            JOIN (
                SELECT plh_number, SUM(qty) AS returned_qty
                FROM transactionline
                WHERE transaction_t_no = ?
                GROUP BY plh_number
            ) tl ON ph.plh_number = tl.plh_number
            SET ph.remaining_quantity = ph.remaining_quantity + tl.returned_qty";

    return $this->db->query($sql, array($tno));
  }
    
  //--------------------------------------------------------------------------

  public function updatecreditloanproductqty($clno) // update qty from CREDIT LOAN
  {
      $sql = "update product set product.qty = (select (product.qty - creditloanline.qty) "
                                          . "from creditloanline "
                                          . "where creditloanline.product_p_no = product.p_no "
                                          . "and creditloanline.credit_loan_cl_no = '$clno') "
                  . "where product.p_no IN (select creditloanline.product_p_no "
                                          . "from creditloanline "
                                          . "where creditloanline.product_p_no = product.p_no "
                                          . "and creditloanline.credit_loan_cl_no = '$clno')"
                  . "and product.inventory = 'Yes'";
      return $this->db->query($sql);
  }
    
  //--------------------------------------------------------------------------

  public function updatesalesreturnproductqty($tno) // update qty from POS Sales Return
  {
      $sql = "update product set product.qty = (select (product.qty + transactionline.qty) "
                                          . "from transactionline "
                                          . "where transactionline.product_p_no = product.p_no "
                                          . "and transactionline.transaction_t_no = '$tno') "
                  . "where product.p_no IN (select transactionline.product_p_no "
                                          . "from transactionline "
                                          . "where transactionline.product_p_no = product.p_no "
                                          . "and transactionline.transaction_t_no = '$tno')";
      return $this->db->query($sql);
  }
    
  //--------------------------------------------------------------------------

  public function updatecreditreturnproductqty($rtno) // update qty from Credit Return
  {
      $sql = "update product set product.qty = (select (product.qty + returntransactionline.qty) "
                                          . "from returntransactionline "
                                          . "where returntransactionline.product_p_no = product.p_no "
                                          . "and returntransactionline.returntransaction_rt_no = '$rtno') "
                  . "where product.p_no IN (select returntransactionline.product_p_no "
                                          . "from returntransactionline "
                                          . "where returntransactionline.product_p_no = product.p_no "
                                          . "and returntransactionline.returntransaction_rt_no = '$rtno')";
      return $this->db->query($sql);
  }
    
  //--------------------------------------------------------------------------

  public function updatecreditreturnloghistory($tno) // update product_lot_history remaining_quantity from credit return
  {
      $sql = "update product_lot_history set product_lot_history.remaining_quantity = (select (product_lot_history.remaining_quantity + returntransactionline.qty) "
                      . "from returntransactionline "
                      . "where returntransactionline.plh_number = product_lot_history.plh_number "
                      . "and returntransactionline.returntransaction_rt_no = '$tno') "
            . "where product_lot_history.plh_number IN (select returntransactionline.plh_number "
                      . "from returntransactionline "
                      . "where returntransactionline.plh_number = product_lot_history.plh_number "
                      . "and returntransactionline.returntransaction_rt_no = '$tno')";
      return $this->db->query($sql);
  }
    
  //--------------------------------------------------------------------------

  public function updateinventoryproductqty($ino) // update qty from inventory
  {
      $sql = "update product set product.qty = (select inventoryline.qty "
                                          . "from inventoryline "
                                          . "where inventoryline.product_p_no = product.p_no "
                                          . "and inventoryline.inventory_i_no = '$ino') "
                  . "where product.p_no IN (select inventoryline.product_p_no "
                                          . "from inventoryline "
                                          . "where inventoryline.product_p_no = product.p_no "
                                          . "and inventoryline.inventory_i_no = '$ino')";
      return $this->db->query($sql);
  }
    
  //--------------------------------------------------------------------------

  public function get_product_history($product_id)
  {
    $this->db->select('product_history.*, customer.name AS cname');
    $this->db->from('product_history');
    $this->db->join('customer', 'customer.c_no = product_history.c_no', 'left');
    $this->db->where('product_history.plh_number', $product_id);
    return $this->db->get()->result();
  }

  //--------------------------------------------------------------------------

  public function get_nearlyexpired()
  {
    $this->db->select('product_lot_history.*, product.name, product.p_no');
    $this->db->from('product_lot_history');
    $this->db->join('product', 'product.p_no = product_lot_history.product_p_no');

    // Filter: expiration_date is greater than or equal to today AND less than or equal to 2 months from today
    $this->db->where('product_lot_history.expiration_date <', date('Y/m/d'));
    $this->db->where('product_lot_history.expiration_date <=', date('Y/m/d', strtotime('+6 months')));
    $this->db->where('product_lot_history.remaining_quantity >', 0);
    $this->db->order_by('product_lot_history.expiration_date', 'DESC');

    return $this->db->get()->result();
  }


}
