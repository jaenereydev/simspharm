<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>

<div class="col-md-10 main" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">            
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-user" ></span> Product Information - <?php echo $prod[0]->name;?>
            </h3>                            
        </div> <!-- end of panel heading -->              
        
        <ul class="nav nav-tabs">
            <li role="presentation" class="<?php if($active == "1") { echo "active";} ?>"><a href="#productdetails" data-toggle="tab">Product Details</a></li>
            <li role="presentation" class="<?php if($active == "3") { echo "active";} ?>"><a href="#productlothistory" data-toggle="tab">Lot Quantity</a></li>
            <li role="presentation" class="<?php if($active == "2") { echo "active";} ?>"><a href="#producthistory" data-toggle="tab">History</a></li>
        </ul>
        
        <div class="panel-body">  
            
            <?php if($alert == null){}else { ?>
                <div class="form-group row row-offcanvas"  id="message">
                    <label style="font-size: 30px" class="col-sm-12 control-label text-danger text-center"><?php echo $message; ?></label>                          
                </div>  
            <?php } ?>

                <div class=" tab-content">
                    
                    <div class="tab-pane <?php if($active == "1") { echo "active";} ?>" id="productdetails">
                        <form role="form" method="post" action="<?=site_url('productinfo_con/updateproduct')?>">
                                                
                            <div class="modal-body">  
                                
                                <div class="form-group row row-offcanvas">
                                    <label class="col-sm-3 control-label">Barcode</label>
                                        <div class="col-sm-5">
                                            <input class="form-control input-sm " type="text" value="<?php echo $prod[0]->barcode;?>" disabled>
                                        </div>                            
                                </div>

                                <div class="form-group row row-offcanvas">
                                    <label class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-5">
                                        <input style="text-transform: capitalize;" 
                                        class="form-control input-sm" 
                                        type="text" 
                                        name="name" 
                                        placeholder="Product Name" 
                                        value="<?php echo $prod[0]->name;?>" 
                                        required autofocus autocomplete="off">
                                    </div>                            
                                </div>  

                                <div class="form-group row row-offcanvas">
                                    <label class="col-sm-3 control-label">Brand</label>
                                    <div class="col-sm-5">
                                        <input style="text-transform: capitalize;" 
                                        class="form-control input-sm" 
                                        type="text" 
                                        name="brand" 
                                        placeholder="Product Name" 
                                        value="<?php echo $prod[0]->brand;?>" 
                                        required autocomplete="off">
                                    </div>                            
                                </div>     

                                <div class="form-group row row-offcanvas">
                                    <label class="col-sm-3 control-label">Category</label>
                                    <div class="col-sm-5">    
                                        <button style="text-transform: capitalize" 
                                        class="form-control input-sm"  
                                        type="button" 
                                        data-toggle="modal" 
                                        data-target="#category" >
                                            <strong><?php echo $prod[0]->cname;?>...</strong >
                                        </button>
                                    </div>                            
                                </div>   

                                <div class="form-group row row-offcanvas">
                                    <label class="col-sm-3 control-label">Supplier</label>         
                                    <div class="col-sm-5">    
                                        <button style="text-transform: capitalize" 
                                        class="form-control input-sm"  
                                        type="button" 
                                        data-toggle="modal" 
                                        data-target="#supplier" >
                                            <strong><?php echo $prod[0]->sname;?>...</strong >
                                        </button>
                                    </div>       
                                </div>                                                                                                                            
                                <div class="form-group row row-offcanvas">
                                    <label class="col-sm-3 control-label">Unit Cost</label>
                                    <div class="col-sm-5">
                                        <input class="form-control input-sm" type="number" name="unitcost" placeholder="Unit Cost" min="0" step="any" value="<?php echo $prod[0]->unitcost; ?>" >
                                    </div>
                                </div>
                                
                                <div class="form-group row row-offcanvas">
                                    <label class="col-sm-3 control-label">Price 1</label>
                                    <div class="col-sm-5">
                                        <input class="form-control input-sm" type="number" name="price1" placeholder="Price" step="any" min="0" value="<?php echo $prod[0]->srpprice; ?>" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row row-offcanvas">
                                    <label class="col-sm-3 control-label">Price 2</label>
                                    <div class="col-sm-5">
                                        <input class="form-control input-sm" type="number" name="price2" placeholder="Price" step="any" min="0" value="<?php echo $prod[0]->price2; ?>" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row row-offcanvas">
                                    <label class="col-sm-3 control-label">Price 3</label>
                                    <div class="col-sm-5">
                                        <input class="form-control input-sm" type="number" name="price3" placeholder="Price" step="any" min="0" value="<?php echo $prod[0]->price3; ?>" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row row-offcanvas">
                                    <label class="col-sm-3 control-label">UOM</label>
                                    <div class="col-sm-5">
                                        <input class="form-control input-sm" type="number" min="1" name="uom" placeholder="Unit of Measure" value="<?php echo $prod[0]->uom ?>">
                                    </div>
                                </div>

                                <!-- <div class="form-group row row-offcanvas">
                                    <label class="col-sm-3 control-label">Quantity</label>
                                    <div class="col-sm-5">
                                    <input 
                                        class="form-control input-sm" 
                                        type="text" 
                                        title="<?php echo $prod[0]->qty . ' pcs'; ?>"
                                        placeholder="Quantity" 
                                        value="<?php 
                                            $qty = $prod[0]->qty;
                                            $uom = $prod[0]->uom;

                                            if( $prod[0]->qty < 0){
                                                echo $qty.'pcs';
                                            }else {
                                                if ($uom == 0) { 
                                                    echo 'Invalid UOM'; // Prevent division by zero
                                                } else {
                                                    $quotient = intdiv($qty, $uom); // Get whole number part
                                                    $remainder = $qty % $uom; // Get remainder
    
                                                    if ($remainder != 0) {
                                                        echo $quotient . ' / ' . abs($remainder); // Ensure remainder is always positive
                                                    } else {
                                                        echo $quotient;
                                                    }
                                                }
                                            }
                                            
                                        ?>" 
                                        disabled>
                                    </div>
                                </div> -->

                                <div class="form-group row row-offcanvas">
                                    <label class="col-sm-3 control-label">Track Inventory</label>
                                    <div class="col-sm-5">
                                        <select name="ti" class="btn btn-default dropdown-toggle" style="width: 100% !important;" data-toggle="dropdown" aria-expanded="true" required>                             
                                            <option value="Yes" <?php if($prod[0]->inventory == 'Yes'){ echo 'selected'; } ?> >Yes</option>
                                            <option value="No" <?php if($prod[0]->inventory == 'No'){ echo 'selected'; } ?> >No</option>
                                        </select>  
                                    </div>
                                </div>
                                
                            </div><!-- end of body -->

                            <div class="modal-footer">
                            <a title="Close" href="<?=site_url('product_con')?>" onclick="return confirm('Do you want to back');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" > Back</a>
                            <button title="Save"  type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" > Save</button>
                            </div>
                        </form>     
                    </div><!-- end of customer details -->                    
                
                    <div class="tab-pane <?php if($active == "3") { echo "active";} ?>" id="productlothistory">
                                
                        <div class="form-group row row-offcanvas">
                            <div class="col-sm-2">    
                                <button style="text-transform: capitalize" 
                                class="form-control input-sm btn btn-info"  
                                type="button" 
                                data-toggle="modal" 
                                data-target="#lotnumber" >
                                    <strong>Add Lot Number</strong >
                                </button>
                            </div>       
                        </div>     
                        <hr>
                        <table class="table table-hover table-responsive table-bordered table-striped info" id="CoTable">      
                            <thead>
                            <tr class="info">                                
                                <td class="text-center"><strong>#</strong></td>    
                                <td class="text-center"><strong>Ref. Number</strong></td>  
                                <td class="text-center"><strong>Date / Description</strong></td>   
                                <td class="text-center"><strong>Supplier</strong></td>  
                                <td class="text-center"><strong>Lot Number</strong></td>
                                <td class="text-center"><strong>Expiration Date</strong></td>
                                <td class="text-center"><strong>Delivered Quantity</strong></td>
                                <td class="text-center"><strong>Delivery Cost</strong></td>
                                <td class="text-center"><strong>Remaining Quantity</strong></td>
                                <td class="text-center"><strong>Total Amount</strong></td>
                                <td class="text-center"><strong>Action</strong></td>
                            </tr> 
                            </thead>
                            <tbody>
                            <?php foreach ($prodlothistory as $key => $item): ?>                    
                            <tr> 
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->plh_number ?></td>                                   
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->ref_number ?></td>   
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->date.'<br>'.$item->description; ?></td>                        
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td> 
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->lot_number?></td>                       
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->expiration_date; ?></td>  
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->delivered_quantity,2,'.',',');?></td>     
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->unit_cost,2,'.',',');?></td>   
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->remaining_quantity,2,'.',',');?></td>        
                                <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)($item->unit_cost*$item->remaining_quantity),2,'.',',');?></td>          
                                <td class="text-center" style="text-transform: capitalize">
                                    <button 
                                        style="text-transform: capitalize" 
                                        class="form-control input-sm btn btn-info view-history-btn"  
                                        type="button" 
                                        data-toggle="modal" 
                                        data-target="#viewhistory" 
                                        data-productid="<?php echo $item->lot_number?>">
                                        <strong>View</strong >
                                    </button>
                                </td>                         
                            </tr>
                            <?php endforeach;  ?>
                            </tbody>
                        </table>          
                    </div>

                    <div class="tab-pane <?php if($active == "2") { echo "active";} ?>" id="producthistory">                        
                            
                        <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable">      
                            <thead>
                            <tr class="info">                               
                                <td class="text-center"><strong>#</strong></td>       
                                <td class="text-center"><strong>Date</strong></td>       
                                <td class="text-center"><strong>Ref No.</strong></td>
                                <td class="text-center"><strong>Description</strong></td>
                                <td class="text-center"><strong>Lot Number</strong></td>
                                <td class="text-center"><strong>Expiration Date</strong></td>
                                <td class="text-center"><strong>In</strong></td>
                                <td class="text-center"><strong>Out</strong></td>
                                <td class="text-center"><strong>Balance</strong></td>
                                <td class="text-center"><strong>User</strong></td>
                            </tr> 
                            </thead>
                            <tbody>
                            <?php foreach ($prodhistory as $key => $item): ?>                    
                            <tr>                                     
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->ph_no ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->date; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->ref_no; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->description; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->lot_number; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->expiration_date; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->inqty; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->outqty; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->bal; ?></td>
                                <td class="text-center" style="text-transform: capitalize"><?php echo $item->name; ?></td>
                            </tr>
                            <?php endforeach;  ?>
                            </tbody>
                        </table>                                             
                    </div> 

                </div>
            
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<!-- Modal -->
        <div id="category" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md"> 
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">     
                    <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                               
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Update Category</h4>
                </div>
                <form role="form" method="post" action="<?=site_url('productinfo_con/updateproductcategory')?>">                    
                    <div class="modal-body">   
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Category</label>
                            <div class="col-sm-9">
                                <select name="cno" class="btn btn-default dropdown-toggle " style="width: 100% !important;" data-toggle="dropdown" aria-expanded="true" required>                             
                                    <option value=""> --Please Select--</option>
                                    <?php for($c=0;$c<count($cat);$c++) { ?>
                                    <option value="<?php echo $cat[$c]->c_no;?>" ><?php echo $cat[$c]->name;?></option>
                                    <?php } ?>
                                </select>  
                            </div>
                        </div>          
                    </div>
                    
                    <div class="modal-footer">
                        <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                    </div>
                </form>
            </div>
        </div>
        </div> <!-- End of model -->

        <!-- Modal -->
        <div id="supplier" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md"> 
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">   
                    <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                                     
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Update Supplier</h4>
                </div>
                <form role="form" method="post" action="<?=site_url('productinfo_con/updateproductsupplier')?>">                    
                    <div class="modal-body">   

                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Supplier</label>
                            <div class="col-sm-9">
                                <select name="sno" class="btn btn-default dropdown-toggle " style="width: 100% !important;" data-toggle="dropdown" aria-expanded="true" required>                             
                                    <option value=""> --Please Select--</option>
                                    <?php for($s=0;$s<count($sup);$s++) { ?>
                                    <option value="<?php echo $sup[$s]->s_no;?>" ><?php echo $sup[$s]->name;?></option>
                                    <?php } ?>
                                </select>  
                            </div>
                        </div>
                                            
                    </div>
                    
                    <div class="modal-footer">
                        <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                    </div>
                </form>
            </div>
        </div>
        </div> <!-- End of model -->

        <!-- Modal -->
        <div id="lotnumber" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg"> 
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header"> 
                    <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>
                    <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Add Lot Information</h4>
                </div>
                <form role="form" method="post" action="<?=site_url('productinfo_con/insertlotinformation')?>">                    
                    <div class="modal-body">   

                        <input class="form-control input-sm hide" name="date" value="<?php echo date('Y/m/d'); ?>" />                
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Supplier</label>
                            <div class="col-sm-9">
                                <select name="sno" class="btn btn-default dropdown-toggle "style="width: 100% !important;" data-toggle="dropdown" aria-expanded="true" required>                             
                                    <option value=""> --Please Select--</option>
                                    <?php for($s=0;$s<count($sup);$s++) { ?>
                                    <option value="<?php echo $sup[$s]->s_no;?>" ><?php echo $sup[$s]->name;?></option>
                                    <?php } ?>
                                </select>  
                            </div>
                        </div>
                        
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Lot Number</label>
                            <div class="col-sm-9">
                                <input class="form-control input-sm" type="text" name="lotnumber" placeholder="Lot Number" required autocomplete="off" >
                            </div>
                        </div>

                        <div class="form-group row row-offcanvas">                                       
                            <label class="col-sm-3 control-label">Expiration Date</label>
                            <div class="col-sm-9">
                                <input id="fbirthday" class="form-control input-sm" type="text" name="expirationdate" placeholder="Expiration Date" required autocomplete="off" />
                            </div>   
                        </div>

                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Unit Cost</label>
                            <div class="col-sm-9">
                                <input class="form-control input-sm" type="number" min="0" step="any" name="unitcost" placeholder="Unit Cost" required autocomplete="off" >
                            </div>
                        </div>

                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-3 control-label">Remaining Quantity</label>
                            <div class="col-sm-9">
                                <input class="form-control input-sm" type="number" min="0" step="any" name="remainingquantity" placeholder="Remaining Quantity per piece" required autocomplete="off" >
                            </div>
                        </div>

                    </div>
                    
                    <div class="modal-footer">
                        <button title="Reset" type="reset" class="btn btn-warning" onclick="return confirm('Do you want to reset this transaction');" >Reset</button>
                        <button title="Save" type="Submit" class="btn btn-success glyphicon glyphicon-floppy-save" ></button>
                    </div>
                </form>
            </div>
        </div>
        </div> <!-- End of model -->

        <!-- Modal -->
        <div id="viewhistory" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg"> 
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header"> 
                        <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Product Lot History</h4>
                    </div>
                        
                        <div class="modal-body">   
                        <table class="table table-hover table-responsive table-bordered table-striped info" >      
                                <thead>
                                <tr class="info">                               
                                    <td class="text-center"><strong>#</strong></td>       
                                    <td class="text-center"><strong>Date</strong></td>       
                                    <td class="text-center"><strong>Ref No.</strong></td>
                                    <td class="text-center"><strong>Description</strong></td>
                                    <td class="text-center"><strong>Lot Number</strong></td>
                                    <td class="text-center"><strong>Expiration Date</strong></td>
                                    <td class="text-center"><strong>In</strong></td>
                                    <td class="text-center"><strong>Out</strong></td>
                                    <td class="text-center"><strong>Balance</strong></td>
                                </tr> 
                                </thead>
                                <tbody id="history-body">
                                    <!-- Content will be inserted here by JavaScript -->
                                </tbody>
                            </table>                       
                        

                        </div>
                        
                </div>
            </div>
        </div> <!-- End of model -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>  

<script type="text/javascript">
    
window.onload = function()
{                         
    setTimeout(function() {
    $('#message').fadeOut();
    }, 3000 );

    $(document).ready(function(){
        $('.view-history-btn').on('click', function(){
            var product_id = $(this).data('productid');
            
            $.ajax({
                url: '<?= base_url("Productinfo_con/get_product_lot_history") ?>',
                type: 'POST',
                data: { product_id: product_id },
                dataType: 'json',
                success: function(data) {
                    let rows = '';
                    data.forEach(function(item, index){
                        rows += `<tr>
                            <td class="text-center">${index + 1}</td>
                            <td class="text-center">${item.date || ''}</td>
                            <td class="text-center">${item.ref_no || ''}</td>
                            <td class="text-center">${item.description || ''}</td>
                            <td class="text-center">${item.lot_number || ''}</td>
                            <td class="text-center">${item.expiration_date || ''}</td>
                            <td class="text-center">${item.inqty ?? ''}</td>
                            <td class="text-center">${item.outqty ?? ''}</td>
                            <td class="text-center">${item.bal ?? ''}</td>
                        </tr>`;
                    });

                    $('#history-body').html(rows);
                },
                error: function() {
                    alert('Failed to load history data.');
                }
            });
        });
    });
}
</script>   