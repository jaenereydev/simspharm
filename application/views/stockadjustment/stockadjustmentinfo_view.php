<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<style>
    .select2-container {
    width: 100% !important; /* Makes sure it occupies full width */
    min-width: 300px; /* Adjust as needed */
}
</style>
<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-barcode" ></span> Insert Inventory
            </h3>            
        </div> <!-- end of panel heading -->        
        
        <form onsubmit="return insertinventoryform(this);" role="form" method="post" action="<?=site_url('Inventoryinfo_con/updateinventory')?>">             
        <div class="panel-body">  

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group row ">                        
                        <label class="col-sm-1 control-label">Doc. No.</label>
                        <div class="col-sm-2">
                            <input class="form-control input-sm " type="text" disabled value="<?php echo $this->session->userdata('ino'); ?>"   />
                        </div>    
                        <?php if($inv[0]->post == 'YES') {}else { ?>
                            <div class="col-sm-2">
                                <button type="button" data-toggle="modal" data-target="#addproduct" class="btn btn-success pull-right" >INSERT PRODUCT</button> 
                            </div>   
                        <?php } ?>
                    </div>
                </div>  

            </div>           
            <table class="table table-hover table-responsive table-bordered table-striped info" 
                <?php if($c[0]->ilno >= '11'){ ?>
                    id="MTable"
                <?php } ?> 
                > 
                <thead>
                    <tr class="info">        
                        <?php if($inv[0]->post == 'YES') {}else { ?>                                                    
                            <td class="text-center"><strong>Action</strong></td>  
                        <?php } ?>                                           
                        <td class="text-center"><strong>Description</strong></td>                        
                        <td class="text-center"><strong>Unit Cost</strong></td> 
                        <td class="text-center"><strong>QTY</strong></td> 
                        <td class="text-center"><strong>Amount</strong></td>   
                    </tr> 
                </thead>
                <tbody>
                    <?php $ta=0; if(sizeof($invline)):  foreach ($invline as $key => $item):  ?>                      
                    <tr>     
                        <?php if($inv[0]->post == 'YES') {}else { ?>    
                        <td class="text-center" style="text-transform: capitalize">
                            <a title="Edit QTY" 
                            data-dlno="<?php echo $item->il_no;?>"                                
                            data-name="<?php echo $item->name;?>"
                            data-unitcost="<?php echo $item->unitcost;?>"
                            data-qty="<?php echo $item->qty;?>"
                            data-oldqty="<?php echo $item->oqty;?>"
                            data-ln="<?php echo $item->lot_number;?>"
                            data-plh="<?php echo $item->plh_number;?>"
                            data-pno="<?php echo $item->product_p_no;?>"
                            data-toggle="modal" data-target="#editqty" 
                            class="glyphicon glyphicon-pencil btn btn-info editqty"
                            data-backdrop="static" data-keyboard="false"></a>

                            <a title="Edit" href="<?=site_url('Inventoryinfo_con/deleteinventoryline/'.$item->il_no)?>" class="glyphicon glyphicon-trash btn btn-danger" onclick="return confirm('Do you want to delete this product');"></a>
                        </td>
                        <?php } ?>
                        <td class="text-left" style="text-transform: capitalize"><?php echo $item->barcode.'<br>'.$item->name.'<br>'.$item->lot_number.'<br>'.$item->expiration_date ?> </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->unitcost,2,'.',',') ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->qty ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->price,2,'.',','); $ta+=$item->price ?></td>
                    </tr>
                    <?php endforeach; else: ?>
                        <tr class="text-center">
                            <td colspan="6">There are no Data</td>
                        </tr>
                    <?php endif?> 
                </tbody>
            </table>
            <div class="row">
                <input class="hide" type="text" name="totalamount" value="<?php echo $ta ?>" />
                <div class="col-md-12">
                    <div class="form-group row row-offcanvas">                    
                        <label class="col-sm-2 control-label">Ref. No.</label>
                        <div class="col-sm-4">
                            <input class="form-control input-sm " type="textarea" name="refno" value="<?php echo $inv[0]->ref_no ?>" autocomplete="off"   <?php if($inv[0]->post == 'YES') { echo 'disabled'; } ?>   />
                        </div>                                   
                    </div>
                </div>    
                <div class="col-md-12">
                    <div class="form-group row row-offcanvas">                    
                        <label class="col-sm-2 control-label">Remarks</label>
                        <div class="col-sm-4">
                            <input class="form-control input-sm " type="text" name="remarks" value="<?php echo $inv[0]->remarks ?>"  autocomplete="off" <?php if($inv[0]->post == 'YES') { echo 'disabled'; } ?>  />
                        </div>                                   
                    </div>
                </div>                    
            </div>
        </div> <!-- end of panel body -->
        <div class="modal-footer">            
            <a title="Close" href="<?=site_url('Inventory_con')?>" onclick="return confirm('Do you want to go back');" type="button" class="btn btn-warning" >BACK</a>    
            <?php if($inv[0]->post == 'YES') {}else { ?>        
            <input type="submit" onclick="return confirm('Do you want to save this file?');" class="btn btn-primary" name="insertinventorybtn" value="SUBMIT">
            <?php } ?>
        </div>
    </form>
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->


<!-- Modal -->
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
                    <td class="text-center"><strong>Qty</strong></td>  
                    <td class="text-center"><strong>Action</strong></td>  
                </tr> 
            </thead>
            <tbody>
                <?php foreach ($prod as $key => $item): ?>                      
                <tr>                         
                    <td class="text-center" style="text-transform: capitalize"><?php echo $item->barcode ?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->qty,2,'.',',') ?></td>
                    <td class="text-center">                                
                        <button title="Add QTY" 
                            data-pno="<?php echo $item->p_no;?>"                                
                            data-name="<?php echo $item->name;?>"
                            data-oldqty="<?php echo $item->qty;?>"
                            data-unitcost="<?php echo $item->unitcost;?>"                                
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

<!-- Modal -->
<div id="addqty" class="modal fade" role="dialog">
<div class="modal-dialog modal-md"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Add Quantity</h4>
        </div>
            
        <form onsubmit="return qtyform(this);" role="form" method="post" action="<?=site_url('Inventoryinfo_con/insertinventoryline')?>">             
        <div class="modal-body">            

            <input id="pno" class="form-control input-sm hide" type="text" name="pno" />
            <input id="unitcost" class="form-control input-sm hide" type="text" name="unitcost" /> 
            <input id="oldqty" class="form-control input-sm hide" type="text" name="oldqty" /> 
        
            <div class="form-group row row-offcanvas">                                                        
                <label class="col-sm-4 control-label">Product Name</label>
                <div class="col-sm-8">
                    <input id="name" class="form-control input-sm " type="text" name="name" disabled />
                </div>   
            </div>

            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-4 control-label">Qty</label>
                <div class="col-sm-8">
                    <input id="qty" class="form-control input-sm " type="text" name="qty" required autocomplete="off" />
                </div>   
            </div>

            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-4 control-label">Lot Number</label>
                <div class="col-sm-8">
                    <select id="lot_numberinventory" name="lot_number" class="form-control"></select>
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


<!-- Modal -->
<div id="editqty" class="modal fade" role="dialog">
<div class="modal-dialog modal-md"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Edit Quantity</h4>
        </div>
            
        <form onsubmit="return editqtyform(this);" role="form" method="post" action="<?=site_url('Inventoryinfo_con/updateinventoryline')?>">             
        <div class="modal-body">            

            <input id="dlno" class="form-control input-sm hide" type="text" name="dlno" />
            <input id="unitcost" class="form-control input-sm hide" type="text" name="unitcost" /> 
            <input id="oldqty" class="form-control input-sm hide" type="text" name="oldqty" /> 
        
            <div class="form-group row row-offcanvas">                                                        
                <label class="col-sm-4 control-label">Product Name</label>
                <div class="col-sm-8">
                    <input id="name" class="form-control input-sm " type="text" name="name" disabled />
                </div>   
            </div>

            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-4 control-label">Qty</label>
                <div class="col-sm-8">
                    <input id="qty" class="form-control input-sm " type="text" name="qty" required autocomplete="off" />
                </div>   
            </div>
        
            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-4 control-label">Lot Number</label>
                <div class="col-sm-8">
                    <select id="lot_number" name="lot_number" class="form-control"></select>
                </div>  
            </div> 

        </div>
        <div class="modal-footer">
                <input type="submit" class="btn btn-primary" name="qtyeditbtn" value="submit">
            </div>
        </form>

    </div>
</div>
</div> <!-- End of model -->


<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script type="text/javascript">

function qtyform(formObj) {            
        formObj.qtyaddbtn.disabled = true;  
        formObj.qtyaddbtn.value = 'Please Wait...';  
        return true;    
    }  

function insertinventoryform(formObj) {            
        formObj.insertinventorybtn.disabled = true;  
        formObj.insertinventorybtn.value = 'Please Wait...';  
        return true;    
    }      

function editqtyform(formObj) {            
        formObj.qtyeditbtn.disabled = true;  
        formObj.qtyeditbtn.value = 'Please Wait...';  
        return true;    
    } 


window.onload = function()
{                         

    $(document).ready(function () {
        $(document).on('click', '.addqty', function(event) {        
            var pno = $(this).data('pno');
            var name = $(this).data('name');
            var unitcost = $(this).data('unitcost');
            var oldqty = $(this).data('oldqty');

            $(".modal-body #pno").val( pno );
            $(".modal-body #name").val( name );
            $(".modal-body #unitcost").val( unitcost );
            $(".modal-body #oldqty").val( oldqty );

            // Initialize Select2 with AJAX search
            $(".modal-body #lot_numberinventory").select2({
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
        $(document).on('click', '.editqty', function(event) {        
            var dlno = $(this).data('dlno');
            var pno = $(this).data('pno');
            var name = $(this).data('name');
            var unitcost = $(this).data('unitcost');
            var qty = $(this).data('qty');
            var oldqty = $(this).data('oldqty');
            var plh = $(this).data('plh');

            $(".modal-body #dlno").val( dlno );
            $(".modal-body #name").val( name );
            $(".modal-body #unitcost").val( unitcost );
            $(".modal-body #qty").val( qty );
            $(".modal-body #oldqty").val( oldqty );
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
}

</script>