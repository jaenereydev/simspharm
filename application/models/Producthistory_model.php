<?php

class Producthistory_model extends CI_Model
{

  //----------------------------------------------------------------------
  
  public function insert_stockadjustmentproducthistory($desc) // Insert data from stock adjustment
  {
      // Get session sano value
    $sano = $this->session->userdata('sano');

    // Begin a transaction to ensure both queries succeed together
    $this->db->trans_start();

    // Insert data into product_history
    $sql_history = "INSERT INTO product_history(date, ref_no, description, inqty, bal, product_p_no, user_id, lot_number, expiration_date, unit_cost, price)
                    SELECT 
                        o.date, 
                        o.ref_no, 
                        ?, 
                        l.qty, 
                        (SELECT qty FROM product WHERE p_no = p.p_no) + l.qty, 
                        l.product_p_no, 
                        o.user_id, 
                        l.lot_number, 
                        l.expiration_date, 
                        l.unit_cost, 
                        l.unit_cost * l.qty 
                    FROM stockadjustmentline l
                    JOIN stockadjustment o ON o.sa_no = l.sa_no
                    JOIN product p ON p.p_no = l.product_p_no
                    WHERE o.sa_no = ?";

    // Execute the insert for product_history
    $this->db->query($sql_history, array($desc, $sano));

    // After inserting into product_history, update the product table
    // We will update the quantity in the product table based on the adjusted quantity in the stock adjustment
    $sql_update_product = "UPDATE product p
                          JOIN stockadjustmentline l ON p.p_no = l.product_p_no
                          JOIN stockadjustment o ON o.sa_no = l.sa_no
                          SET p.qty = p.qty + l.qty
                          WHERE o.sa_no = ?";

    // Execute the update for the product table
    $this->db->query($sql_update_product, array($sano));

    // Commit the transaction
    $this->db->trans_complete();

    // Check if there were any errors and return the result
    if ($this->db->trans_status() === FALSE) {
        return false;  // Something went wrong, handle error
    } else {
        return true;   // Both operations were successful
    }
  }

  //----------------------------------------------------------------------

  public function insert_deliveryproducthistory($d, $desc) //insert data from delivery
  {
  
    $sql = "Insert into product_history(date, ref_no, description, inqty, bal, product_p_no,  user_id, lot_number, expiration_date, unit_cost, price) "
          . "select o.date, o.ref_no, '$desc', l.qty, (select qty from product where p_no = p.p_no)+l.qty, "
          . "l.product_p_no, o.user_id, l.lot_number, l.expiration_date, l.unitcost, l.price  "
          . "from deliveryline l "
          . "JOIN delivery o ON o.d_no = l.delivery_d_no "
          . "JOIN product p ON p.p_no = l.product_p_no "
          . "where o.d_no = '$d' ";
        return $this->db->query($sql);
  }

  //----------------------------------------------------------------------

  public function insert_deliveryproductlothistory($d, $desc) //insert data to lot history from delivery
  {
  
    $sql = "Insert into product_lot_history(expiration_date, ref_number, description, delivered_quantity, "
          . "lot_number, product_p_no,  user_id, unit_cost, date, remaining_quantity, supplier_s_no) "
          . "select l.expiration_date, o.ref_no, '$desc', l.qty, l.lot_number, "
          . "l.product_p_no, o.user_id, l.unitcost, o.date, l.qty, o.supplier_s_no "
          . "from deliveryline l "
          . "JOIN delivery o ON o.d_no = l.delivery_d_no "
          . "JOIN product p ON p.p_no = l.product_p_no "
          . "where o.d_no = '$d' ";
        return $this->db->query($sql);
  }

  //----------------------------------------------------------------------

  public function insert_salesproducthistory($tno, $desc) //insert data from POS module SALES and CREDIT
  {
  
    $sql = "Insert into product_history(date, ref_no, description, outqty, bal, product_p_no,  user_id, lot_number, expiration_date, plh_number, unit_cost, price) "
          . "select o.date, o.ref_no, '$desc', l.qty, (select qty from product where p_no = p.p_no)-l.qty, "
          . "l.product_p_no, o.user_id, l.description, l.expiration_date, l.plh_number, l.delivery_cost, l.price "
          . "from transactionline l "
          . "JOIN transaction o ON o.t_no = l.transaction_t_no "
          . "JOIN product p ON p.p_no = l.product_p_no "
          . "where o.t_no = '$tno' ";
        return $this->db->query($sql);
  }


  //----------------------------------------------------------------------

  public function insert_creditloanproducthistory($clno, $desc) //insert data from Credit loan module
  {
  
    $sql = "Insert into product_history(date, ref_no, description, outqty, bal, product_p_no,  user_id) "
          . "select c.date, c.cl_no, '$desc', l.qty, (select qty from product where p_no = p.p_no)-l.qty, "
          . "l.product_p_no, c.user_id "
          . "from creditloanline l "
          . "JOIN credit_loan c ON c.cl_no = l.credit_loan_cl_no "
          . "JOIN product p ON p.p_no = l.product_p_no "
          . "where c.cl_no = '$clno' "
          . "and p.inventory = 'Yes'";
        return $this->db->query($sql);
  }


  //----------------------------------------------------------------------

   public function insert_salesreturnproducthistory($tno, $desc) //insert data from POS Sales Return module
  {
  
    $sql = "Insert into product_history(date, ref_no, description, inqty, bal, product_p_no,  user_id, "
          . "lot_number, expiration_date, plh_number, unit_cost, price) "
          . "select o.date, o.ref_no, '$desc', l.qty, (select qty from product where p_no = p.p_no)+l.qty, "
          . "l.product_p_no, o.user_id, l.description, l.expiration_date, l.plh_number, l.delivery_cost, l.price "
          . "from transactionline l "
          . "JOIN transaction o ON o.t_no = l.transaction_t_no "
          . "JOIN product p ON p.p_no = l.product_p_no "
          . "where o.t_no = '$tno' ";
        return $this->db->query($sql);
  }


  //----------------------------------------------------------------------

   public function insert_creditreturnproducthistory($rtno, $desc) //insert data from Credit Return module
  {
  
    $sql = "Insert into product_history(date, ref_no, description, inqty, bal, product_p_no, "
          . "user_id, lot_number, expiration_date, plh_number) "
          . "select o.date, o.rt_no, '$desc', l.qty, (select qty from product where p_no = p.p_no)+l.qty, "
          . "l.product_p_no, o.user_id, lot_number, expiration_date, plh_number "
          . "from returntransactionline l "
          . "JOIN returntransaction o ON o.rt_no = l.returntransaction_rt_no "
          . "JOIN product p ON p.p_no = l.product_p_no "
          . "where o.rt_no = '$rtno' ";
        return $this->db->query($sql);
  }


  //----------------------------------------------------------------------

  public function insert_inventoryproducthistory($ino, $desc) //insert data from inventory module
  {
  
    $sql = "Insert into product_history(date, ref_no, description, inqty, bal, product_p_no, user_id, lot_number, expiration_date, plh_number) "
          . "select o.date, o.i_no, '$desc', l.qty, (p.qty-l.oldqty)+l.qty, l.product_p_no, o.user_id, lot_number, expiration_date, plh_number "
          . "from inventoryline l "
          . "JOIN inventory o ON o.i_no = l.inventory_i_no "
          . "JOIN product p ON p.p_no = l.product_p_no "
          . "where o.i_no = '$ino' ";
        return $this->db->query($sql);
  }


  //----------------------------------------------------------------------

}
