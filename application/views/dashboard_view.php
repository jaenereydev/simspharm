<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<?php if($users[0]->position == "Admin" ){ ?>   

    <!-- Customer number -->
    <div class="col-md-5">
        <div class="panel">
            <div class="panel-heading clearfix">            
                <h3 class="panel-title" style="padding-top: 8px; font-size: 20px;">
                    Customer
                </h3>  
            </div> 
            <div class="panel-body d-flex justify-content-between align-items-center">   
                <span style="font-size: 24px; font-weight: bold;">
                    <a href=""><?php echo number_format((float)$customer[0]->c, 0, '.', ','); ?></a>
                </span>
                <i class="fa fa-user fa-2x pull-right"></i> <!-- Customer Icon -->
            </div> 
        </div> 
    </div>

    <!-- Supplier number -->
    <div class="col-md-5">
        <div class="panel">
            <div class="panel-heading clearfix">            
                <h3 class="panel-title" style="padding-top: 8px; font-size: 20px;">
                    Supplier
                </h3>  
            </div> 
            <div class="panel-body d-flex justify-content-between align-items-center">   
                <span style="font-size: 24px; font-weight: bold;">
                    <a href=""><?php echo number_format((float)$customer[0]->c, 0, '.', ','); ?></a>
                </span>
                <i class="fa fa-user fa-2x pull-right"></i> <!-- Customer Icon -->
            </div> 
        </div> 
    </div>

    <!-- Product number -->
    <div class="col-md-5">
        <div class="panel">
            <div class="panel-heading clearfix">            
                <h3 class="panel-title" style="padding-top: 8px; font-size: 20px;">
                    Product
                </h3>  
            </div> 
            <div class="panel-body d-flex justify-content-between align-items-center">   
                <span style="font-size: 24px; font-weight: bold;">
                    <a href=""><?php echo number_format((float)$customer[0]->c, 0, '.', ','); ?></a>
                </span>
                <i class="fa fa-user fa-2x pull-right"></i> <!-- Customer Icon -->
            </div> 
        </div> 
    </div>

    <!-- User number -->
    <div class="col-md-5">
        <div class="panel">
            <div class="panel-heading clearfix">            
                <h3 class="panel-title" style="padding-top: 8px; font-size: 20px;">
                    User
                </h3>  
            </div> 
            <div class="panel-body d-flex justify-content-between align-items-center">   
                <span style="font-size: 24px; font-weight: bold;">
                    <a href=""><?php echo number_format((float)$customer[0]->c, 0, '.', ','); ?></a>
                </span>
                <i class="fa fa-user fa-2x pull-right"></i> <!-- Customer Icon -->
            </div> 
        </div> 
    </div>

    
    <div class="col-md-5">
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
                        <tr class="warning">                                             
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
                        <tr class="warning">                                             
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
    <!-- Customer -->
    <div class="col-md-5">
        <div class="panel panel-warning">
            <div class="panel-heading clearfix">            
                <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                    <span class="glyphicon glyphicon-user" ></span> CUSTOMER
                </h3>  
            </div> <!-- end of panel heading -->
            <div class="panel-body" >   
                <div class="col-sm-12">
                    <div class="form-group row">               
                        <label class="col-sm-5 control-label"><a href="<?=site_url('Customer_con')?>">Accounts Receivables</a></label>
                        <label class="col-sm-7 control-label">Php <?php echo number_format((float)$totalar[0]->ta,2,'.',','); ?></label>
                    </div> 
                    <hr> 
                    <div class="form-group row">               
                        <label class="col-sm-5 control-label"><a href="<?=site_url('Customer_con')?>">Customer Count</a></label>
                        <label class="col-sm-4 control-label"><?php echo number_format((float)$customer[0]->c,0,'.',','); ?></label>     
                    </div>  
                </div><!--end of col-sm-6 -->
            </div> <!-- end of panel body -->
            
        </div> <!-- end of panel div -->   
    </div>

    <?php } ?>

    <!-- Product -->
    <div class="col-md-5">
        <div class="panel panel-info">
            <div class="panel-heading clearfix">            
                <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                    <span class="glyphicon glyphicon-barcode" ></span> PRODUCT
                </h3>  
            </div> <!-- end of panel heading -->
            <div class="panel-body" >   
                <div class="col-sm-12">

                    <?php if($users[0]->position == "Admin" ){ ?>
                    <div class="form-group row">               
                        <label class="col-sm-5 control-label"><a href="<?=site_url('Product_con')?>">Inventory cost</a></label>
                        <label class="col-sm-7 control-label">Php <?php echo number_format((float)$sumcost[0]->tcost,2,'.',','); ?></label>
                    </div>      
                    <hr>
                    <?php } ?>

                    <div class="form-group row">               
                        <label class="col-sm-5 control-label"><a href="<?=site_url('Product_con/get_allproduct')?>" onclick="return confirm('This will display all the products in your system.This will take some time.');">Product Count</a></label>
                        <label class="col-sm-4 control-label"><?php echo number_format((float)$product[0]->p,0,'.',','); ?></label>     
                    </div>  
                    
                    <?php if( sizeof($productwounitcost)){ ?>
                    <hr>
                    <div class="form-group row">               
                        <label class="col-sm-5 control-label"><a href="<?=site_url('Product_con/productunitcost')?>">Product without Unit Cost</a></label>
                        <label class="col-sm-4 control-label"><?php echo number_format((float)$productwounitcost[0]->p,0,'.',','); ?></label>     
                    </div>  
                    <?php } ?>

                    <?php if( sizeof($productnegativequantity)){ ?>
                    <hr>
                    <div class="form-group row">               
                        <label class="col-sm-5 control-label"><a href="<?=site_url('Product_con/productwithnegativequantity')?>">Product with negative quantity</a></label>
                        <label class="col-sm-4 control-label"><?php echo number_format((float)$productnegativequantity[0]->p,0,'.',','); ?></label>     
                    </div>  
                    <?php } ?>
                </div><!--end of col-sm-6 -->
            </div> <!-- end of panel body -->
            
        </div> <!-- end of panel div -->   
    </div>

    

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>