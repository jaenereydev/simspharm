<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-tree-deciduous" ></span> Batch Distribution Report
            </h3>         
            <div class="panel-toolbar text-right">
            </div>
        </div> <!-- end of panel heading -->        
        
        <div class="panel-body">  
        
            <form role="form" method="post" action="<?=site_url('Report_con/searchbatchdistributionreport')?>">   
                <div class="form-group row row-offcanvas">
                    <div class="col-sm-5">
                        <input  class="form-control input-md" type="text" name="fromsearch" placeholder="From Date" id="birthday" required autocomplete="off">
                    </div> 
                    <div class="col-sm-5">
                        <input  class="form-control input-md" type="text" name="tosearch" placeholder="To Date" id="mbirthday" required autocomplete="off">
                    </div>   
                    <div class="col-sm-2">
                        <button title="Search" type="Submit" class="btn btn-success" style="width:100% !important;" >Search</button>
                    </div>          
                </div>  
            </form>   

            <?php if($batchlist == null){}else { ?>
                <hr>
                <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
                    <thead>
                        <tr class="info">                
                            <td class="text-center"><strong>Supplier</strong></td>  
                            <td class="text-center"><strong>Purchaser</strong></td>                          
                            <td class="text-center"><strong>Description</strong></td> 
                            <td class="text-center"><strong>Lot Number / Expiration Date</strong></td>   
                            <td class="text-center"><strong>Total Cost</strong></td> 
                            <td class="text-center"><strong>Total Amount</strong></td>
                            <td class="text-center"><strong>In Quantity</strong></td>  
                            <td class="text-center"><strong>Out Quantity</strong></td>  
                            <td class="text-center"><strong>Balance</strong></td>       
                        </tr> 
                    </thead>
                    <tbody>
                        <?php foreach ($batchlist as $key => $item):   ?>                    
                        <tr> 
                            <td class="text-left" style="text-transform: capitalize"><?php echo $item->sname;?></td>
                            <td class="text-left" style="text-transform: capitalize"><?php echo $item->cname;?></td>
                            <td class="text-left" style="text-transform: capitalize"><?php echo $item->barcode.'<br>'.$item->name.'<br>'.$item->brand;?></td> 
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->lot_number.' / '.$item->expiration_date;?></td> 
                            <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->unit_cost,2,'.',',');?></td>
                            <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->price,2,'.',',');?></td>        
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->inqty;?></td>     
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->outqty;?></td>  
                            <td class="text-center" style="text-transform: capitalize"><?php echo $item->bal;?></td>  
                        </tr>
                        <?php endforeach;  ?>   
                    </tbody>
                </table>
            <?php } ?>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>
