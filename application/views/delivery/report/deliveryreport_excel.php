<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.
ob_start();
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"Delivery_report - " . $del[0]->ref_no . ".xls\"");
header("Pragma: no-cache");
header("Expires: 0");
?>
<style>
    table, th, td {
        border: 1px  black solid;
        border-collapse: collapse;
      }
</style>
<div>
    <table style="width: 100%;margin: 0 auto; font-size: 12px; margin-top: 5px;" width="500px" > 
                <thead>
                    <tr>  
                        <td style="text-align: left;"><strong>Date:</strong></td>          
                        <td style="text-align: center;" colspan="3" ><strong><?php echo date_format(date_create($del[0]->date), 'm/d/Y');?></strong></td>  
                    </tr> 
                    <tr>  
                        <td style="text-align: left;"><strong>Ref. Number:</strong></td>                  
                        <td style="text-align: center;" colspan="3"><strong><?php echo $del[0]->ref_no;?></strong></td> 
                    </tr> 
                    <tr>  
                        <td style="text-align: left;"><strong>Supplier Name</strong></td> 
                        <td style="text-align: center;" colspan="3"><strong><?php echo $del[0]->name;?></strong></td>   
                    </tr> 
                    <tr>  
                        <td style="text-align: left;"><strong>Discount Amount</strong></td> 
                        <td style="text-align: center;" colspan="3"><strong><?php echo number_format((float)$del[0]->discount,2,'.',',');?></strong></td>   
                    </tr> 
                    <tr>  
                        <td style="text-align: left;"><strong>Total Amount</strong></td> 
                        <td style="text-align: center;" colspan="3"><strong><?php echo number_format((float)$del[0]->totalamount,2,'.',',');?></strong></td>   
                    </tr> 
                    <tr>  
                        <td style="text-align: left;"><strong>Remarks</strong></td> 
                        <td style="text-align: center;" colspan="3"><strong><?php echo $del[0]->remarks;?></strong></td>   
                    </tr> 

                </thead>
                <tbody>
                    <tr>  
                        <td style="text-align: center;"><strong>Name</strong></td>          
                        <td style="text-align: center;"><strong>Lot No.</strong></td>    
                        <td style="text-align: center;"><strong>Exp. Date</strong></td>                  
                        <td style="text-align: center;"><strong>Unit Cost</strong></td> 
                        <td style="text-align: center;"><strong>QTY</strong></td> 
                        <td style="text-align: center;"><strong>Amount</strong></td>   
                    </tr> 
                      <?php if(sizeof($delline)):  foreach ($delline as $key => $item): ?>                      
                    <tr>     
                        <td class="" style="text-transform: capitalize"><?php echo $item->name ?> </td>
                        <td class="" style="text-transform: capitalize"><?php echo $item->lot_number?> </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->expiration_date ?> </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->unitcost,2,'.',',') ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->qty ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->price,2,'.',',') ?></td>
                    </tr>
                    <?php endforeach; else: ?>
                        <tr class="text-center">
                          <td colspan="6">There are no Data</td>
                        </tr>
                    <?php endif?> 
                </tbody>
            </table>
    </div>
    <?php ob_end_flush(); ?>