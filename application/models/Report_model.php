<?php
 
class Report_model extends CI_Model
{

  //----------------------------------------------------------------------

  public function get_salesreport($d) 
  {
    $sql = "SELECT s.*, u.*
              from salesreport s
              JOIN user u ON u.id = s.user_id
              WHERE date = '$d'";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------

  public function get_salesreportinfo($s) 
  {
    $sql = "SELECT *
              from salesreport
              WHERE sr_no = '$s'";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------

  public function get_transactionsalesreport($d) 
  {
      $sql = "SELECT t.*, u.*
              FROM transaction t
              JOIN user u ON u.id = t.user_id
              WHERE t.date = ?";
              
      $query = $this->db->query($sql, array($d));
      return $query->result();
  }

  //----------------------------------------------------------------------

  public function get_profitreport($d) 
  {
    $sql = "SELECT t.t_no, t.customer_c_no,t.ref_no as ref_no, t.date as date, 
            t.type as type, sum(l.delivery_cost*l.qty) as total_cost, sum(l.totalamount) as total_amount, 
            (sum(l.totalamount)-sum(l.delivery_cost*l.qty)) as profit
            FROM transactionline as l 
            JOIN transaction as t on t.t_no = l.transaction_t_no
            WHERE t.date = '$d'
            and t.type = 'CASH'
            OR t.date = '$d' 
            AND t.type = 'CREDIT'
            group by t.t_no";
    $query = $this->db->query($sql);
    return $query->result();
  }

  //----------------------------------------------------------------------

  public function get_batchdistributionreport($from, $to) 
  {
      $this->db->select('p.*, r.name, r.barcode, r.brand, c.name as cname, s.name as sname');
      $this->db->from('product_history p');
      $this->db->join('product r', 'r.p_no = p.product_p_no');
      $this->db->join('product_lot_history h', 'h.plh_number = p.plh_number', 'left');
      $this->db->join('supplier s', 's.s_no = h.supplier_s_no', 'left');
      $this->db->join('customer c', 'c.c_no = p.c_no', 'left');
      $this->db->where('p.date >=', $from);
      $this->db->where('p.date <=', $to);
      $this->db->order_by('p.date', 'ASC');
      
      return $this->db->get()->result();
  }
  //----------------------------------------------------------------------

}
