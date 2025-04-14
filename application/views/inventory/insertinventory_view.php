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

                <div class="col-md-6">
                    <div class="form-group row ">                        
                        <label class="col-sm-4 control-label">Doc. No.</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm " type="text" disabled value="<?php echo $this->session->userdata('ino'); ?>"   />
                        </div>    
                    </div>
                </div>  

                <div class="col-md-6">
                    <div class="form-group row ">   
                        <?php if($inv[0]->post == 'YES') {}else { ?>
                            <div class="col-sm-12">
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
                    <?php $ta=0;$q=0; if(sizeof($invline)):  foreach ($invline as $key => $item):  ?>                      
                    <tr>     
                        <?php if($inv[0]->post == 'YES') {}else { ?>    
                        <td class="text-center" style="text-transform: capitalize">
                            <a title="Edit" href="<?=site_url('Inventoryinfo_con/deleteinventoryline/'.$item->il_no)?>" class="glyphicon glyphicon-trash btn btn-danger" onclick="return confirm('Do you want to delete this product');"></a>
                        </td>
                        <?php } ?>
                        <td class="text-left" style="text-transform: capitalize"><?php echo $item->barcode.'<br>'.$item->name.'<br>'.$item->lot_number.'<br>'.$item->expiration_date ?> </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->unitcost,2,'.',',') ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->qty; $q+=$item->qty; ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->unitcost*$item->qty,2,'.',','); $ta+=$item->unitcost*$item->qty; ?></td>
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
                        <label class="col-sm-2 control-label">Remarks</label>
                        <div class="col-sm-10">
                            <input class="form-control input-sm " type="text" name="remarks" value="<?php echo $inv[0]->remarks ?>"  autocomplete="off" <?php if($inv[0]->post == 'YES') { echo 'disabled'; } ?>  />
                        </div>                                   
                    </div>
                </div>                    
            </div>
        </div> <!-- end of panel body -->
        <div class="modal-footer">            
            <a title="Close" href="<?=site_url('Inventory_con')?>" onclick="return confirm('Do you want to go back');" type="button" class="btn btn-warning" >BACK</a>    
            <?php if($inv[0]->post == 'YES') {}else { 
                if($q <= 0){}else{
                ?>        
                <input type="submit" onclick="return confirm('Do you want to save this file?');" class="btn btn-primary" name="insertinventorybtn" value="SUBMIT">
            <?php } } ?>
        </div>
    </form>
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->



<!-- Modal -->
<div id="addproduct" class="modal fade" role="dialog">
<div class="modal-dialog modal-md"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Add Quantity</h4>
        </div>
            
        <form onsubmit="return qtyform(this);" role="form" method="post" action="<?=site_url('Inventoryinfo_con/insertinventoryline')?>">             
            <div class="modal-body">   
                <div class="form-group row row-offcanvas">                                       
                    <label class="col-sm-3 control-label">Lot Number</label>
                    <div class="col-sm-9">
                        <select id="lot_number" name="lot_number" class="form-control"></select>
                    </div>  
                </div>
            
                <div class="form-group row row-offcanvas">                                       
                    <label class="col-sm-3 control-label">Qty</label>
                    <div class="col-sm-9">
                        <input id="qty" class="form-control input-sm " type="text" name="qty" required autocomplete="off" />
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


<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>
<!-- jQuery (Required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        $('#lot_number').select2({
            placeholder: "Search Lot Number/Product Name...",
            allowClear: true,
            minimumInputLength: 1,
            ajax: {
                url: "<?= site_url('Product_con/getLotNumbersinventory') ?>",
                type: "POST",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (lot) {
                            return {
                                id: lot.plh_number,
                                text: lot.name + " - " + lot.lot_number + " - " + lot.expiration_date + " - (" + lot.remaining_quantity + ")"
                            };
                        })
                    };
                },
                cache: true
            }
        });
    });

}

</script>