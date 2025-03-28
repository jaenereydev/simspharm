<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<style>
    .select2-container {
    width: 100% !important; /* Makes sure it occupies full width */
    min-width: 300px; /* Adjust as needed */
}
</style>
<div class="col-md-8 main" style="margin-top:60px;" >
    <div class="panel panel-default">
        <div class="panel-heading ">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-shopping-cart" ></span> Point Of Sales
            </h3>            
            <div class="panel-toolbar text-right">
                <a title="Dashboard" class="btn btn-default btn-sm" href="<?=site_url('dashboard')?>"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a>      
                <a title="Expenses" class="btn btn-info btn-sm" href="<?=site_url('Expenses_con')?>"><span class="glyphicon glyphicon-list-alt"></span> Expenses</a>   
                <a title="Return Sales" class="btn btn-danger btn-sm" href="<?=site_url('Salesreturn_con')?>"><span class="glyphicon glyphicon-shopping-cart"></span> Return Sales</a>
                <a title="Credit Sales" class="btn btn-warning btn-sm" href="<?=site_url('Salescredit_con')?>"><span class="glyphicon glyphicon-book"></span> Credit Sales</a>      
                <a title="Transaction List" class="btn btn-default btn-sm" href="<?=site_url('Sales_con/transactionlist')?>"><span class="glyphicon glyphicon-tags"></span> Transaction List</a>                   
            </div>
        </div> <!-- end of panel heading -->  
        
        <div class="panel-body">  
            <div class="">
                    <table class="table table-hover table-responsive table-bordered table-striped info"  > 
                        <thead>
                            <tr class="info">                       
                                <td class="text-center"><strong>Barcode</strong></td> 
                                <td class="text-center"><strong>Name</strong></td>    
                                <td class="text-center"><strong>Price</strong></td>     
                                <td class="text-center"><strong>QTY</strong></td> 
                                <td class="text-center"><strong>Discount %</strong></td> 
                                <td class="text-center"><strong>Amount</strong></td>  
                                <td class="text-center"><strong>Action</strong></td>  
                            </tr> 
                        </thead>
                        <tbody>
                            <?php if(sizeof($tl)): $qty=0; $ta=0; $tldiscount=0;   foreach ($tl as $key => $item):  ?>                      
                            <tr>    
                                <?php $tldiscount+=$item->discountamount; ?>                                             
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->barcode ?> </td>
                                <td class="text-left" style="text-transform: capitalize"><?php echo $item->name.'<br>'.$item->description.'<br>'.$item->expiration_date ?> </td>
                                <td class="text-center" style="text-transform: capitalize">
                                    <a title="Edit Product Price" 
                                    data-tlno="<?php echo $item->tl_no;?>"                                
                                    data-name="<?php echo $item->name;?>"
                                    data-srpprice="<?php echo $item->srpprice;?>"
                                    data-price2="<?php echo $item->price2;?>"
                                    data-price3="<?php echo $item->price3;?>"     
                                    data-discount="<?php echo $item->discount;?>"
                                    data-qty="<?php echo $item->tlqty;?>"                     
                                    data-toggle="modal" data-target="#editproductprice" 
                                    class="btn btn-sm btn-warning editproductprice">
                                    <?php echo number_format((float)$item->price,2,'.',','); ?>
                                    </a>
                                </td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->tlqty; $qty+=$item->tlqty; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->discount ?>%</td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->totalamount,2,'.',','); $ta+=$item->totalamount; ?></td>
                                <td class="text-center" style="text-transform: capitalize">
                                    <a title="Edit Product" 
                                    data-tlno="<?php echo $item->tl_no;?>" 
                                    data-pno="<?php echo $item->product_p_no;?>"                                     
                                    data-name="<?php echo $item->name;?>"
                                    data-price="<?php echo $item->price;?>"                            
                                    data-discount="<?php echo $item->discount;?>"
                                    data-qty="<?php echo $item->tlqty;?>"
                                    data-plh="<?php echo $item->plh_number;?>"
                                    data-toggle="modal" data-target="#editproduct" 
                                    class="glyphicon glyphicon-pencil btn btn-sm btn-info editproduct"
                                    data-backdrop="static" data-keyboard="false"></a>

                                    <a title="Edit" href="<?=site_url('Sales_con/deletetransactionline/'.$item->tl_no)?>" class="glyphicon glyphicon-trash btn btn-sm btn-danger" onclick="return confirm('Do you want to delete this product');"></a>
                                </td>
                            </tr>
                            <?php endforeach;  else: $qty=0; $ta=0; $tldiscount=0; ?>
                                <tr class="text-center">
                                    <td colspan="7">There are no Data</td>
                                </tr>
                            <?php endif  ?> 
                            <tr class="warning">
                                <td colspan="3"><strong>Total</strong></td>
                                <td class="text-center"><strong><?php echo $qty; ?></strong></td>
                                <td class="text-center"></td>
                                <td class="text-center"><strong>Php <?php echo number_format((float)$ta,2,'.',','); ?></strong></td>
                                <td class="text-center"></td>
                            </tr>
                        </tbody>
                    </table>            
            </div>
        </div> <!-- end of panel body -->        
        
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<div class="col-md-4" style="margin-top:60px;" >    
    <div class="panel panel-default">
        <div class="panel-heading ">                
            <div class="panel-toolbar text-right" >               
                <input type="button" class="btn btn-sm btn-info text-center " data-toggle="modal" data-target="#addproduct" value="ADD PRODUCT" />                  
            </div>
        </div> <!-- end of panel heading -->  
        <form onsubmit="return processform(this);" role="form" method="post" action="<?=site_url('Sales_con/processsales')?>">                        
            <div class="panel-body"> 
                <div class="row">
                    <div class="col-md-12 md">
                        <label for="customer">Select Customer (Optional)
                        <span><a title="New Customer" class="btn btn-success btn-sm" href="<?=site_url('Customer_con')?>">New!</a></span>
                        </label>
                        <?php if($customer == null){ ?>
                        <button style="text-transform: capitalize" class="form-control input-sm"  type="button" data-toggle="modal" data-target="#selectcustomer"><strong><?php echo "No Customer"?></strong></button>
                        <?php }else { ?>
                        <div class="row">
                            <div class="col-md-10">
                                <button style="text-transform: capitalize" class="form-control input-md"  type="button" data-toggle="modal" data-target="#selectcustomer"><strong><?php echo $customer[0]->name; ?></strong></button>
                            </div>
                            <div class="col-md-2">                        
                                <a title="Edit" href="<?=site_url('Sales_con/deletecustomer/'.$customer[0]->c_no)?>" class="glyphicon glyphicon-minus btn btn-danger btn-sm" onclick="return confirm('Do you want to Remove this Customer');"></a>
                            </div>
                        </div>
                        <?php } ?>     
                                        
                    </div>
                </div>  
                <?php if($ta == '0') {}else { ?>
                <hr>
                <div class="form-group row">                  
                    <div class="col-md-12">
                        <label for="customer">S.I.#</label>
                        <input type="text"  name="refno" class="form-control input-sm text-center" value="<?php if($refno == null){ echo ''; } else { echo $this->session->userdata('refno'); } ?>" placeholder="Sales Invoice Number" required autocomplete="off" >
                    </div>
                </div>
                <div class="form-group row">

                    <input type="text" name="date" class="hide"  value="<?php echo date('Y/m/d'); ?>"  >
                    <input type="number" step="any" name="totalamount" class="hide" value="<?php echo $ta; ?>"  >
                    <input type="number" step="any" name="tldiscount" class="hide" value="<?php echo $tldiscount; ?>"  >
                    <input type="number" step="any" name="totalqty" class="hide" value="<?php echo $qty; ?>"  >

                    <div class="col-md-12">
                        <label for="customer">Discount Amount</label>
                        <input type="number" step="any" name="discount" class="form-control input-sm text-center" value="<?php if($discount == null){ echo '0'; } else { echo $this->session->userdata('discount'); } ?>" placeholder="Discount amount" autocomplete="off" >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">                        
                        <label for="customer">Cash on Hand</label>
                        <select name="type" class="input-sm dropdown-toggle " data-toggle="dropdown" aria-expanded="true" required>                             
                                    <option value="CASH" <?php if($this->session->userdata('type') == 'CASH'){ echo 'selected'; } ?>> CASH</option>
                                    <option value="CHECK" <?php if($this->session->userdata('type') == 'CHECK'){ echo 'selected'; } ?>> CHECK</option>                                    
                                </select>  
                        <input type="number" step="any" name="cashonhand" class="form-control input-sm text-center"  value="<?php if($cashonhand == null){ echo ''; } else { echo $this->session->userdata('cashonhand'); } ?>" placeholder="Amount" required autocomplete="off" >                       
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php if($ta == '0' ) {}else { ?>
            <div class="modal-footer">               
                <a title="Reset" href="<?=site_url('Sales_con/resettransaction')?>"  onclick="return confirm('Do you want to reset this transaction');" type="button" class="btn btn-warning glyphicon glyphicon-floppy-remove" ></a>
                <input title="Process" type="submit" class="btn btn-primary" name="processbtn" value="Process">
            </div>
            <?php } ?>
        </form>
    </div>   
</div>  

<!-- Modal select customer-->
<div id="selectcustomer" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Select Customer</h4>
        </div>
                        
            <div class="modal-body">                    

                <table class="table table-hover table-responsive table-bordered table-striped info" id="CoTable"> 
                <thead>
                    <tr class="info">                                                                
                        <td class="text-center"><strong>Customer Name</strong></td> 
                        <td class="text-center"><strong>Credit Limit</strong></td> 
                        <td class="text-center"><strong>Balance</strong></td>  
                        <td class="text-center"><strong>Action</strong></td>  
                    </tr> 
                </thead>
                <tbody>
                    <?php foreach ($cus as $key => $item): ?>                      
                    <tr>                         
                        <td class="text-left" style="text-transform: capitalize"><?php echo $item->name ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->credit_limit,2,'.',','); ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->balance,2,'.',','); ?></td>
                        <td class="text-center">     
                            <a title="Select" href="<?=site_url('Sales_con/selectcustomer/'.$item->c_no)?>" class=" btn btn-info">SELECT</a>
                        </td>
                    </tr>
                    <?php endforeach;  ?>     
                </tbody>
            </table>
            </div>                           
    </div>
</div>
</div> <!-- End of model -->

<!-- Modal add product -->
<div id="addproduct" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Select Product</h4>
        </div>
                        
        <div class="modal-body">                   
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
            <thead>
                <tr class="info">                                        
                    <td class="text-center"><strong>Barcode</strong></td>                        
                    <td class="text-center"><strong>Product</strong></td>  
                    <td class="text-center"><strong>SRP Price</strong></td>  
                    <td class="text-center"><strong>QTY</strong></td>  
                    <td class="text-center"><strong>Action</strong></td>  
                </tr> 
            </thead>
            <tbody>
                <?php foreach ($prod as $key => $item): ?>                      
                <tr>                         
                    <td class="text-center" style="text-transform: capitalize"><?php echo $item->barcode ?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->srpprice,2,'.',','); ?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $item->qty ?></td>
                    <td class="text-center">                                
                        <button title="Add QTY" 
                            data-pno="<?php echo $item->p_no;?>"                                
                            data-name="<?php echo $item->name;?>"
                            data-unitcost="<?php echo $item->unitcost;?>" 
                            data-srp="<?php echo $item->srpprice;?>"                                
                            data-toggle="modal" data-target="#addqty" 
                            class="glyphicon glyphicon-plus btn btn-info addqty"
                            data-backdrop="static" data-keyboard="false"></button>
                    </td>
                </tr>
                <?php endforeach;  ?>     
            </tbody>
            </table>
        </div>                           
    </div>
</div>
</div> <!-- End of model -->

<!-- Modal add product quantity -->
<div id="addqty" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg"> 
<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">                    
        <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
        <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Add Quantity</h4>
    </div>
            
        <form onsubmit="return qtyform(this);" role="form" method="post" action="<?=site_url('Sales_con/inserttransactionline')?>">             
        <div class="modal-body">            

            <input id="pno" class="form-control input-sm hide" type="text" name="pno" />
            <input id="unitcost" class="form-control input-sm hide" type="text" name="unitcost" /> 
            <input id="srp" class="form-control input-sm hide" type="text" name="price" /> 
        
            <div class="form-group row row-offcanvas">                                                        
                <label class="col-sm-4 control-label">Product Name</label>
                <div class="col-sm-8">
                    <input id="name" class="form-control input-sm " type="text" name="name" disabled />
                </div>   
            </div>

            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-4 control-label">Qty</label>
                <div class="col-sm-8">
                    <input  class="form-control input-sm " min="1" type="number" value="1" name="qty" required autocomplete="off" />
                </div>  
            </div>

            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-4 control-label">Lot Number</label>
                <div class="col-sm-8">
                    <select id="lot_numbersales" name="lot_number" class="form-control">
                    </select>
                </div>  
            </div>

            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-4 control-label">Discount %</label>
                <div class="col-sm-8">
                    <input class="form-control input-sm " min="0" type="number" name="discount" value="0" required autocomplete="off" />
                </div>   
            </div>

        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary" name="qtyaddbtn" value="submit">
        </div>
        </form>

    </div>
</div>
</div> <!-- End of model -->

<!-- Modal edit product-->
<div id="editproduct" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Update Product</h4>
        </div>
            
        <form onsubmit="return editproductform(this);" role="form" method="post" action="<?=site_url('Sales_con/updatetransactionline')?>">             
        <div class="modal-body">            

            <input id="tlno" class="form-control input-sm hide" type="text" name="tlno" />           
            <input id="price" class="form-control input-sm hide" type="text" name="price" />
            <input id="plh" class="form-control input-sm hide" type="text" name="plh_number" />

            <div class="form-group row row-offcanvas">                                                        
                <label class="col-sm-4 control-label">Product Name</label>
                <div class="col-sm-8">
                    <input style="text-transform: capitalize" id="name" class="form-control input-sm " type="text" name="name" disabled />
                </div>   
            </div>
        

            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-4 control-label">Qty</label>
                <div class="col-sm-8">
                    <input id="qty" class="form-control input-sm " min="1" type="number" name="qty" required autocomplete="off" />
                </div>   
            </div>

            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-4 control-label">Lot Number</label>
                <div class="col-sm-8">
                    <select id="lot_number" name="lot_number" class="form-control">
                        <option value="">Select Lot</option>
                    </select>
                </div>  
            </div>         

            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-4 control-label">Discount %</label>
                <div class="col-sm-8">
                    <input id="discount" class="form-control input-sm " type="number" name="discount" required autocomplete="off" />
                </div>   
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary" name="editproductbtn" value="submit">
        </div>
        </form>

    </div>
</div>
</div> <!-- End of model -->

<!-- Modal edit product price-->
<div id="editproductprice" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Update Product Price</h4>
        </div>
            
        <div class="modal-body">      
            <div class="form-group row row-offcanvas">                                                        
                <label class="col-sm-6 control-label">Product Name</label>
                <div class="col-sm-6">
                    <input style="text-transform: capitalize" id="name" class="form-control input-sm " type="text" name="name" disabled />
                </div>   
            </div>
            <hr>
            <form onsubmit="return editproductpriceform(this);" role="form" method="post" action="<?=site_url('Sales_con/updatetransactionlineprice')?>">    
            <input id="tlno" class="form-control input-sm hide" type="text" name="tlno" />
            <input id="discount" class="form-control input-sm hide" type="text" name="discount" />
            <input id="qty" class="form-control input-sm hide" type="text" name="qty" />
                <div class="form-group row row-offcanvas">                                       
                    <label class="col-sm-6 control-label">Price 1</label>
                    <div class="col-sm-6">
                        <input id="srpprice" type="submit" class="form-control btn btn-primary" name="price" >
                    </div>   
                </div>
            </form>

            <form onsubmit="return editproductpriceform(this);" role="form" method="post" action="<?=site_url('Sales_con/updatetransactionlineprice')?>">    
            <input id="tlno" class="form-control input-sm hide" type="text" name="tlno" />
            <input id="discount" class="form-control input-sm hide" type="text" name="discount" />
            <input id="qty" class="form-control input-sm hide" type="text" name="qty" />
                <div class="form-group row row-offcanvas">                                       
                    <label class="col-sm-6 control-label">Price 2</label>
                    <div class="col-sm-6">
                        <input id="price2" type="submit" class="form-control btn btn-primary" name="price" >
                    </div>   
                </div>
            </form>

            <form onsubmit="return editproductpriceform(this);" role="form" method="post" action="<?=site_url('Sales_con/updatetransactionlineprice')?>">   
            <input id="tlno" class="form-control input-sm hide" type="text" name="tlno" /> 
            <input id="discount" class="form-control input-sm hide" type="text" name="discount" />
            <input id="qty" class="form-control input-sm hide" type="text" name="qty" />
                <div class="form-group row row-offcanvas">                                       
                    <label class="col-sm-6 control-label">Price 3</label>
                    <div class="col-sm-6">
                        <input id="price3" type="submit" class="form-control btn btn-primary" name="price" >
                    </div>   
                </div>
            </form>
            <hr>
            <form onsubmit="return editproductpriceform(this);" role="form" method="post" action="<?=site_url('Sales_con/updatetransactionlineprice')?>">   
            <input id="tlno" class="form-control input-sm hide" type="text" name="tlno" /> 
            <input id="discount" class="form-control input-sm hide" type="text" name="discount" />
            <input id="qty" class="form-control input-sm hide" type="text" name="qty" />
                <div class="form-group row row-offcanvas">                                       
                    <label class="col-sm-6 control-label text-danger">OVERRIDE PRICE</label>
                    <div class="col-sm-4">
                        <input id="price3" type="number" min="0" class="form-control input" name="price" >
                    </div>   
                    <div class="col-sm-2">
                        <input  type="submit"  class="form-control btn btn-success" value="SAVE">
                    </div>   
                </div>
            </form>

        </div>               
    </div>
</div>
</div> <!-- End of model -->


<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script type="text/javascript">

function processform(formObj) {            
        formObj.processbtn.disabled = true;  
        formObj.processbtn.value = 'Please Wait...';  
        return true;    
    }  

function qtyform(formObj) {            
        formObj.qtyaddbtn.disabled = true;  
        formObj.qtyaddbtn.value = 'Please Wait...';  
        return true;    
    }  

function editproductform(formObj) {            
        formObj.editproductbtn.disabled = true;  
        formObj.editproductbtn.value = 'Please Wait...';  
        return true;    
    }

function editproductpriceform(formObj) {            
        formObj.editproductpricebtn.disabled = true;  
        formObj.editproductpricebtn.value = 'Please Wait...';  
        return true;    
    }


window.onload = function()
{                         

    $(document).ready(function () {
        $(document).on('click', '.addqty', function(event) {        
            var pno = $(this).data('pno');
            var name = $(this).data('name');
            var srp = $(this).data('srp');
            var unitcost = $(this).data('unitcost');

            $(".modal-body #pno").val( pno );
            $(".modal-body #name").val( name );
            $(".modal-body #unitcost").val( unitcost );
            $(".modal-body #srp").val( srp );

            // Initialize Select2 with AJAX search
            $(".modal-body #lot_numbersales").select2({
                placeholder: "Search Lot Number...",
                allowClear: true,
                minimumInputLength: 1, // Only search when the user types at least 1 character
                ajax: {
                    url: "<?= site_url('Sales_con/getLotNumbers') ?>", // Controller URL
                    type: "POST",
                    dataType: "json",
                    delay: 250, // Delay for better performance
                    data: function (params) {
                        return {
                            search: params.term, // Send search term to server
                            product_no: pno // Send product number to filter results
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (lot) {
                                return {
                                    id: lot.plh_number,
                                    text: lot.lot_number + " - " + lot.expiration_date + " - " + lot.remaining_quantity
                                };
                            })
                        };
                    },
                    cache: true
                }
            });
        });
    });

    $(document).ready(function () {
    $(document).on('click', '.editproduct', function(event) {        
        var tlno = $(this).data('tlno');
        var name = $(this).data('name');
        var price = $(this).data('price'); 
        var discount = $(this).data('discount');
        var qty = $(this).data('qty');
        var plh = $(this).data('plh');
        var pno = $(this).data('pno');

        $(".modal-body #tlno").val(tlno);
        $(".modal-body #name").val(name);
        $(".modal-body #discount").val(discount);
        $(".modal-body #qty").val(qty);
        $(".modal-body #price").val(price);
        $(".modal-body #plh").val(plh);

        // Initialize Select2 with AJAX search
        $(".modal-body #lot_number").select2({
            placeholder: "Search Lot Number...",
            allowClear: true,
            minimumInputLength: 1, // Search starts after typing 1 character
            ajax: {
                url: "<?= site_url('Sales_con/getLotNumbers') ?>", 
                type: "POST",
                dataType: "json",
                delay: 250, // Delay for better performance
                data: function (params) {
                    return {
                        search: params.term, // Search term typed by user
                        product_no: pno
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (lot) {
                            return {
                                id: lot.plh_number,
                                text: lot.lot_number + " - " + lot.expiration_date + " - " + lot.remaining_quantity
                            };
                        })
                    };
                },
                cache: true
            }
        });

        // Pre-select the current lot if it exists
        if (plh) {
            $.ajax({
                url: "<?= site_url('Sales_con/getLotDetails') ?>",
                type: "POST",
                data: { plh_number: plh },
                dataType: "json",
                success: function (data) {
                    if (data) {
                        var option = new Option(data.lot_number + " - " + data.expiration_date + " - " + data.remaining_quantity, data.plh_number, true, true);
                        $(".modal-body #lot_number").append(option).trigger('change');
                    }
                }
            });
        }
    });
});


    $(document).ready(function () {
        $(document).on('click', '.editproductprice', function(event) {        
            var tlno = $(this).data('tlno');
            var name = $(this).data('name');  
            var srpprice = $(this).data('srpprice');   
            var price2 = $(this).data('price2');   
            var price3 = $(this).data('price3'); 
            var discount = $(this).data('discount');
            var qty = $(this).data('qty');           
            $(".modal-body #tlno").val( tlno );
            $(".modal-body #name").val( name );
            $(".modal-body #srpprice").val( srpprice );
            $(".modal-body #price2").val( price2 );
            $(".modal-body #price3").val( price3 );
            $(".modal-body #discount").val( discount );
            $(".modal-body #qty").val( qty );
        });
    });

}

</script>