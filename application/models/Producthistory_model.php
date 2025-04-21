<?php

class Producthistory_model extends CI_Model
{

  //----------------------------------------------------------------------
  
  public function insert_stockadjustmentproducthistorypositive($desc) // Insert data from stock adjustment positive
  {
    // Get session sano value
    $sano = $this->session->userdata('sano');

    // Sanitize the description to prevent SQL injection
    $desc = $this->db->escape_str($desc);

    $sql = "INSERT INTO product_history
                (date, ref_no, description, inqty, bal, product_p_no, user_id, lot_number, expiration_date, unit_cost, price, plh_number)
            SELECT 
                o.date,
                o.ref_no,
                ? AS description,
                l.qty,
                (p.remaining_quantity + l.qty) AS bal,
                l.product_p_no,
                o.user_id,
                l.lot_number,
                l.expiration_date,
                l.unit_cost,
                (l.unit_cost*l.qty),
                p.plh_number
            FROM stockadjustmentline l
            JOIN stockadjustment o ON o.sa_no = l.sa_no
            JOIN product_lot_history p ON p.plh_number = l.plh_number
            WHERE o.sa_no = ?";

    return $this->db->query($sql, array($desc, $sano));
  }

  //----------------------------------------------------------------------

  public function insert_stockadjustmentproducthistorynegative($desc) // Insert data from stock adjustment negative
  {
    // Get session sano value
    $sano = $this->session->userdata('sano');

    // Sanitize the description to prevent SQL injection
    $desc = $this->db->escape_str($desc);

    $sql = "INSERT INTO product_history
                (date, ref_no, description, outqty, bal, product_p_no, user_id, lot_number, expiration_date, unit_cost, price, plh_number)
            SELECT 
                o.date,
                o.ref_no,
                ? AS description,
                l.qty,
                (p.remaining_quantity + l.qty) AS bal,
                l.product_p_no,
                o.user_id,
                l.lot_number,
                l.expiration_date,
                l.unit_cost,
                (l.unit_cost*l.qty),
                p.plh_number
            FROM stockadjustmentline l
            JOIN stockadjustment o ON o.sa_no = l.sa_no
            JOIN product_lot_history p ON p.plh_number = l.plh_number
            WHERE o.sa_no = ?";

    return $this->db->query($sql, array($desc, $sano));
  }

  //----------------------------------------------------------------------

  public function insert_deliveryproducthistory($d, $desc)
{
    $sql = "INSERT INTO product_history
            (date, ref_no, description, inqty, bal, product_p_no, 
            user_id, lot_number, expiration_date, unit_cost, price, plh_number)
            SELECT 
                o.date,
                o.ref_no,
                ? AS description,
                l.remaining_quantity,
                l.remaining_quantity AS bal,
                l.product_p_no,
                l.user_id,
                l.lot_number,
                l.expiration_date,
                l.unit_cost,
                (l.remaining_quantity*l.unit_cost),
                l.plh_number
            FROM product_lot_history l
            JOIN delivery o ON o.d_no = l.d_no
            WHERE l.d_no = ?";

    return $this->db->query($sql, array($desc, $d));
}
  //----------------------------------------------------------------------

  public function insert_deliveryproductlothistory($d, $desc) //insert data to lot history from delivery
  {
    // Sanitize inputs
    $desc = $this->db->escape_str($desc);

    $sql = "INSERT INTO product_lot_history
                (expiration_date, ref_number, description, delivered_quantity,
                lot_number, product_p_no, user_id, unit_cost, date, remaining_quantity, supplier_s_no, d_no)
            SELECT 
                l.expiration_date,
                o.ref_no,
                ? AS description,
                l.qty,
                l.lot_number,
                l.product_p_no,
                o.user_id,
                l.unitcost,
                o.date,
                l.qty,
                o.supplier_s_no,
                o.d_no
            FROM deliveryline l
            JOIN delivery o ON o.d_no = l.delivery_d_no
            WHERE o.d_no = ?";

    return $this->db->query($sql, array($desc, $d));
  }

  //----------------------------------------------------------------------

  public function insert_salesproducthistory($tno, $desc) // Insert data from POS module SALES and CREDIT
  {
      $sql = "INSERT INTO product_history(
                  date, ref_no, description, outqty, bal, 
                  product_p_no, user_id, lot_number, expiration_date, 
                  plh_number, unit_cost, price, c_no
              )
              SELECT 
                  o.date, 
                  o.ref_no, 
                  ?, 
                  l.qty, 
                  p.remaining_quantity - l.qty, 
                  l.product_p_no, 
                  o.user_id, 
                  l.description, 
                  l.expiration_date, 
                  l.plh_number, 
                  l.delivery_cost, 
                  l.price, 
                  o.customer_c_no
              FROM transactionline l
              JOIN transaction o ON o.t_no = l.transaction_t_no
              JOIN product_lot_history p ON p.plh_number = l.plh_number
              WHERE o.t_no = ?";
      
      return $this->db->query($sql, array($desc, $tno));
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

  public function insert_salesreturnproducthistory($tno, $desc)
  {
      $sql = "INSERT INTO product_history
              (date, ref_no, description, inqty, bal, product_p_no, user_id,
                lot_number, expiration_date, plh_number, unit_cost, price, c_no)
              SELECT 
                  o.date,
                  o.ref_no,
                  ? AS description,
                  l.qty,
                  p.remaining_quantity+l.qty AS bal,
                  l.product_p_no,
                  o.user_id,
                  l.description AS lot_number,
                  l.expiration_date,
                  l.plh_number,
                  l.delivery_cost,
                  l.price,
                  o.customer_c_no
              FROM transactionline l
              JOIN transaction o ON o.t_no = l.transaction_t_no
              JOIN product_lot_history p ON p.plh_number = l.plh_number
              WHERE o.t_no = ?";

      return $this->db->query($sql, array($desc, $tno));
  }

  //----------------------------------------------------------------------

  public function insert_creditreturnproducthistory($rtno, $desc) //insert data from Credit Return module
  {
      $sql = "INSERT INTO product_history (
        date, ref_no, description, inqty, bal, product_p_no,
        user_id, lot_number, expiration_date, plh_number, unit_cost, price, c_no
        )
        SELECT 
            o.date,
            o.rt_no,
            ?,
            l.qty,
            p.remaining_quantity + l.qty,
            l.product_p_no,
            o.user_id,
            l.lot_number,
            l.expiration_date,
            l.plh_number,
            l.unitcost,
            l.price,
            c.customer_c_no
        FROM returntransactionline l
        JOIN returntransaction o ON o.rt_no = l.returntransaction_rt_no
        JOIN creditduedate c ON c.cdd_no = o.creditduedate_cdd_no
        JOIN product_lot_history p ON p.plh_number = l.plh_number
        WHERE o.rt_no = ?";

    return $this->db->query($sql, array($desc, $rtno));
  }

  //----------------------------------------------------------------------

  public function insert_inventoryproducthistory($ino, $desc)
  {
      // Escape description only (optional if you're using bindings)
      $desc = $this->db->escape_str($desc);

      $sql = "INSERT INTO product_history
              (date, ref_no, description, inqty, bal, product_p_no, user_id, lot_number, expiration_date, plh_number, unit_cost, price)
              SELECT 
                  o.date,
                  o.i_no,
                  ? AS description,
                  l.qty,
                  (p.remaining_quantity - l.oldqty) + l.qty AS bal,
                  l.product_p_no,
                  o.user_id,
                  l.lot_number,
                  l.expiration_date,
                  l.plh_number,
                  l.unitcost, l.price
              FROM inventoryline l
              JOIN inventory o ON o.i_no = l.inventory_i_no
              JOIN product_lot_history p ON p.plh_number = l.plh_number
              WHERE o.i_no = ?";

      return $this->db->query($sql, array($desc, $ino));
  }

  //----------------------------------------------------------------------

}
