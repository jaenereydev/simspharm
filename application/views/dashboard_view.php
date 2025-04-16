<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


<?php if($users[0]->position == "Admin" ){ ?> 
<div class="row">
    <div class="col-md-10 row " >
        <!-- Customer number -->
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="panel" style="width: 100%;">
                <div class="panel-heading clearfix">            
                    <h3 class="panel-title" style="padding-top: 8px; font-size: 20px;">
                        Customer
                    </h3>  
                </div> 
                <div class="panel-body d-flex justify-content-between align-items-center">   
                    <span style="font-size: 24px; font-weight: bold;">
                        <a href="<?php echo site_url('customer_con') ?>"><?php echo number_format((float)$customer[0]->c, 0, '.', ','); ?></a>
                    </span>
                    <i class="fa fa-users fa-2x pull-right"></i> <!-- Customer Icon -->
                </div> 
            </div> 
        </div>

        <!-- Supplier number -->
        <div class="col-md-3">
            <div class="panel">
                <div class="panel-heading clearfix">            
                    <h3 class="panel-title" style="padding-top: 8px; font-size: 20px;">
                        Supplier
                    </h3>  
                </div> 
                <div class="panel-body d-flex justify-content-between align-items-center">   
                    <span style="font-size: 24px; font-weight: bold;">
                        <a href="<?php echo site_url('supplier_con') ?>"><?php echo number_format((float)$supplier[0]->s, 0, '.', ','); ?></a>
                    </span>
                    <i class="fa fa-truck fa-2x pull-right"></i> 
                </div> 
            </div> 
        </div>

        <!-- Product number -->
        <div class="col-md-3">
            <div class="panel">
                <div class="panel-heading clearfix">            
                    <h3 class="panel-title" style="padding-top: 8px; font-size: 20px;">
                        Product
                    </h3>  
                </div> 
                <div class="panel-body d-flex justify-content-between align-items-center">   
                    <span style="font-size: 24px; font-weight: bold;">
                        <a href="<?php echo site_url('product_con') ?>"><?php echo number_format((float)$product[0]->p,0,'.',','); ?></a>
                    </span>
                    <i class="fa fa-cubes fa-2x pull-right"></i> <!-- Product Icon -->
                </div> 
            </div> 
        </div>

        <!-- User number -->
        <div class="col-md-3">
            <div class="panel">
                <div class="panel-heading clearfix">            
                    <h3 class="panel-title" style="padding-top: 8px; font-size: 20px;">
                        User Active
                    </h3>  
                </div> 
                <div class="panel-body d-flex justify-content-between align-items-center">   
                    <span style="font-size: 24px; font-weight: bold;">
                        <a href="<?php echo site_url('user_con') ?>"><?php echo number_format((float)$user[0]->u, 0, '.', ','); ?></a>
                    </span>
                    <i class="fa fa-user fa-2x pull-right"></i> <!-- Customer Icon -->
                </div> 
            </div> 
        </div>

    
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">            
                    <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                        Expiration Date Information (2 months)
                    </h3>  
                </div> 
                <div class="panel-body" >   
                    <div class="col-sm-12">
                    <table class="table table-hover table-responsive table-bordered table-striped info" id="CoTable">      
                            <thead>
                            <tr class="info">             
                                <td class="text-center"><strong>Expiration Date</strong></td>                      
                                <td class="text-center"><strong>Description</strong></td>   
                                <td class="text-center"><strong>Lot Number</strong></td>
                                <td class="text-center"><strong>Remaining Quantity</strong></td>
                            </tr> 
                            </thead>
                            <tbody>
                            <?php foreach ($prodlothistory as $key => $item): ?>                    
                            <tr>                    
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->expiration_date; ?></td>       
                                <td class="text-left" style="text-transform: capitalize"><a href="<?=site_url('product_con/productinfo/'.$item->p_no)?>"><?php echo $item->name ?></a></td> 
                                <td class="text-left" style="text-transform: capitalize"><?php echo $item->lot_number?></td>   
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->remaining_quantity,2,'.',',');?></td>          
                            </tr>
                            <?php endforeach;  ?>
                            </tbody>
                        </table>                     
                    </div>
                </div> 
                
            </div> 
        </div>

        <div class="col-md-5 ">
            <!-- TOTAL Cash SALES PER USER -->
            <div class="panel panel-default">
                <div class="panel-heading clearfix">            
                    <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                    <strong>Cash</strong> Sales Summary for the day (<?php $date = date('m/d/y'); echo $date; ?>)
                    </h3>  
                </div> <!-- end of panel heading -->
                <div class="panel-body" >  
                    <table class="table table-hover table-responsive table-bordered table-striped "> 
                        <thead>
                            <tr class="info">                                             
                                <td class="text-center"><strong>Name</strong></td>
                                <td class="text-center"><strong>Total Quantity</strong></td>           
                                <td class="text-center"><strong>Total Amount</strong></td>   
                            </tr> 
                        </thead>
                        <tbody>
                            <?php foreach ($totalcashsalesperuser as $key => $item): ?>                      
                                <tr> 
                                    <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->tqty,0,'.',',');?></td>
                                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->tamount,2,'.',','); ?></td>
                                </tr>
                            <?php endforeach;  ?>     
                        </tbody>
                    </table>
                </div> <!-- end of panel body -->
            </div> <!-- end of panel div -->   
            <!-- TOTAL Credit SALES PER USER -->
            <div class="panel panel-default">
                <div class="panel-heading clearfix">            
                    <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                        <strong>Credit</strong> Sales Summary for the day (<?php $date = date('m/d/y'); echo $date; ?>)
                    </h3>  
                </div> <!-- end of panel heading -->
                <div class="panel-body" >  
                    <table class="table table-hover table-responsive table-bordered table-striped "> 
                        <thead>
                            <tr class="info">                                             
                                <td class="text-center"><strong>Name</strong></td>
                                <td class="text-center"><strong>Total Quantity</strong></td>           
                                <td class="text-center"><strong>Total Amount</strong></td>   
                            </tr> 
                        </thead>
                        <tbody>
                            <?php foreach ($totalcreditsalesperuser as $key => $item): ?>                      
                                <tr> 
                                    <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->tqty,0,'.',',');?></td>
                                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->tamount,2,'.',','); ?></td>
                                </tr>
                            <?php endforeach;  ?>     
                        </tbody>
                    </table>
                </div> <!-- end of panel body -->
                
            </div> <!-- end of panel div -->
            <!-- TOTAL Credit Payment PER USER -->
            <div class="panel panel-default">
                <div class="panel-heading clearfix">            
                    <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                        <strong>Credit Payment</strong> Summary for the day (<?php $date = date('m/d/y'); echo $date; ?>)
                    </h3>  
                </div> <!-- end of panel heading -->
                <div class="panel-body" >  
                    <table class="table table-hover table-responsive table-bordered table-striped "> 
                        <thead>
                            <tr class="info">                                             
                                <td class="text-center"><strong>Name</strong></td>      
                                <td class="text-center"><strong>Customer Count</strong></td>       
                                <td class="text-center"><strong>Total Amount</strong></td>   
                            </tr> 
                        </thead>
                        <tbody>
                            <?php foreach ($totalcreditpaymentperuser as $key => $item): ?>                      
                                <tr> 
                                    <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                                    <td class="text-center" style="text-transform: capitalize"><?php echo $item->cno ?></td>
                                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->tpayment,2,'.',','); ?></td>
                                </tr>
                            <?php endforeach;  ?>     
                        </tbody>
                    </table>
                </div> <!-- end of panel body -->
                
            </div> <!-- end of panel div -->
        </div>

        
        <?php } ?>
</div>

</div>

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>