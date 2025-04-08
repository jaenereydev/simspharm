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
                Insert Stock Adjustment
            </h3>            
        </div> <!-- end of panel heading -->        
        
        <form onsubmit="return insertstockadjustmentform(this);" role="form" method="post" action="<?=site_url('Stockadjustmentinfo_con/poststockadjustment')?>">             
        <div class="panel-body">  

            <div class="row">

                <div class="col-md-8">
                    <div class="form-group row ">                        
                        <label class="col-sm-2 control-label">Doc. No.</label>
                        <div class="col-sm-4">
                            <input class="form-control input-sm " type="text" disabled value="<?php echo $stockadjustmentinfo[0]->sa_no; ?>"   />
                        </div>    
                        <label class="col-sm-2 control-label">Sign</label>
                        <div class="col-sm-4">
                        <?php if($stockadjustmentinfo[0]->post == 'YES') { ?>
                            <input class="form-control input-sm " type="text" disabled value="<?php 
                                                                                        if ($stockadjustmentinfo[0]->status == '+') {
                                                                                            echo "+ Positive Adjustment";
                                                                                        } else {
                                                                                            echo "- Negative Adjustment";
                                                                                        }
                                                                                        ?>"   />
                        <?php }else { ?>
                            <select id="status" name="status" class="form-control" style="width: 100% !important" required>
                                <option value="">Please select Sign</option>
                                <option value="+" <?= ($stockadjustmentinfo[0]->status == '+') ? 'selected' : '' ?>>+ Postive Adjustment</option>
                                <option value="-" <?= ($stockadjustmentinfo[0]->status == '-') ? 'selected' : '' ?>>- Negative Adjustment</option>
                            </select>
                        <?php } ?>
                        </div> 
                    </div>
                </div>  
                <div class="col-md-4">
                    <div class="form-group row ">                         
                        <?php if($stockadjustmentinfo[0]->post == 'YES') {}else { ?>
                            <div class="col-sm-12">
                                <button type="button" data-toggle="modal" data-target="#addproduct" class="btn btn-success pull-right" >INSERT PRODUCT</button> 
                            </div>   
                        <?php } ?>
                    </div>
                </div> 

            </div>           
            <table class="table table-hover table-responsive table-bordered table-striped info" 
                <?php if($sa[0]->sano >= '11'){ ?>
                    id="MTable"
                <?php } ?> 
                > 
                <thead>
                    <tr class="info">        
                        <?php if($stockadjustmentinfo[0]->post == 'YES') {}else { ?>                                                    
                            <td class="text-center"><strong>Action</strong></td>  
                        <?php } ?>                                           
                        <td class="text-center"><strong>Description</strong></td>
                        <td class="text-center"><strong>Lot Number</strong></td>    
                        <td class="text-center"><strong>Expiration Date</strong></td>                            
                        <td class="text-center"><strong>Unit Cost</strong></td> 
                        <td class="text-center"><strong>QTY</strong></td> 
                        <td class="text-center"><strong>Amount</strong></td>   
                    </tr> 
                </thead>
                <tbody>
                    <?php $ta=0; if(sizeof($stockadjustmentline)):  foreach ($stockadjustmentline as $key => $item):  ?>                      
                    <tr>     
                        <?php if($stockadjustmentinfo[0]->post == 'YES') {}else { ?>    
                        <td class="text-center" style="text-transform: capitalize">
                            <a title="Edit" href="<?=site_url('Stockadjustmentinfo_con/deletestockadjustmentline/'.$item->sal_no)?>" class="glyphicon glyphicon-trash btn btn-danger" onclick="return confirm('Do you want to delete this product');"></a>
                        </td>
                        <?php } ?>
                        <td class="text-left" style="text-transform: capitalize"><?php echo $item->barcode.'<br>'.$item->name ?> </td>
                        <td class="text-left" style="text-transform: capitalize"><?php echo $item->lot_number?> </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->expiration_date ?> </td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->unit_cost,2,'.',',') ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->qty ?></td>
                        <td class="text-center" style="text-transform: capitalize"><?php echo number_format((float)$item->unit_cost*$item->qty,2,'.',','); $ta+=$item->unit_cost*$item->qty ?></td>
                    </tr>
                    <?php endforeach; else: ?>
                        <tr class="text-center">
                            <td colspan="5">There are no Data</td>
                        </tr>
                    <?php endif?> 
                </tbody>
            </table>
            <div class="row">
                <input class="hide" type="text" name="totalamount" value="<?php echo $ta ?>" />
            </div>
        </div> <!-- end of panel body -->
        <div class="modal-footer">            
            <a title="Close" href="<?=site_url('Stockadjustment_con')?>" onclick="return confirm('Do you want to go back');" type="button" class="btn btn-warning" >BACK</a>    
            <?php if($stockadjustmentinfo[0]->post == 'YES') {}else { 
                ?>        
                <input type="submit" onclick="return confirm('Do you want to save this file?');" class="btn btn-primary" value="SUBMIT AND POST">
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
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Search Product</h4>
        </div>
                        
        <form onsubmit="return qtyform(this);" role="form" method="post" action="<?=site_url('Stockadjustmentinfo_con/insertstockadjustmentline')?>">             
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

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script type="text/javascript">

function qtyform(formObj) {            
        formObj.qtyaddbtn.disabled = true;  
        formObj.qtyaddbtn.value = 'Please Wait...';  
        return true;    
    }  

window.onload = function()
{                         

    $(document).ready(function () {
        $('#lot_number').select2({
            placeholder: "Search Lot Number...",
            allowClear: true,
            minimumInputLength: 1,
            ajax: {
                url: "<?= site_url('Product_con/getLotNumbers') ?>",
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


    $(document).ready(function() {
    $('#status').on('change', function() {
        const status = $(this).val();
        const sa_no = '<?= $stockadjustmentinfo[0]->sa_no ?>'; // or session if needed

        $.ajax({
            url: "<?= site_url('Stockadjustmentinfo_con/updatestatus') ?>",
            type: "POST",
            data: {
                status: status,
                sa_no: sa_no
            },
            success: function(response) {
                alert("Status updated successfully!");
            },
            error: function(xhr) {
                alert("Failed to update status.");
            }
        });
    });
});
}

</script>