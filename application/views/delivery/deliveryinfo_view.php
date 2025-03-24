<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>
<div class="col-md-8 main" style="margin-top:60px;" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                <span class="glyphicon glyphicon-qrcode" ></span> Delvery Information
            </h3>            
        </div> <!-- end of panel heading -->        
        
        <div class="panel-body"> 
            <table class="table table-hover table-responsive table-bordered table-striped info" > 
                <thead>
                    <tr class="info">  
                        <?php if($del[0]->post == 'YES'){}else { ?>                                           
                            <td class="text-center"><strong>Action</strong></td>    
                        <?php } ?>                        
                        <td class="text-center"><strong>Barcode/Name</strong></td>          
                        <td class="text-center"><strong>Lot No.</strong></td>    
                        <td class="text-center"><strong>Exp. Date</strong></td>                  
                        <td class="text-center"><strong>Unit Cost</strong></td> 
                        <td class="text-center"><strong>QTY</strong></td> 
                        <td class="text-center"><strong>Amount</strong></td>   
                    </tr> 
                </thead>
                <tbody>
                      <?php if(sizeof($delline)):  foreach ($delline as $key => $item): ?>                      
                    <tr>     
                        <?php if($del[0]->post == 'YES'){}else { 
                            if($item->expiration_date == null){
                                $expdate = '';
                            }else{
                                $expdate = date_format(date_create($item->expiration_date), 'm/d/Y');
                            } ?> 
                            <td class="text-center" style="text-transform: capitalize">
                                <a 
                                    title="Edit QTY" 
                                    data-dlno="<?php echo $item->dl_no;?>"                                
                                    data-name="<?php echo $item->name;?>"
                                    data-unitcost="<?php echo $item->unitcost;?>"
                                    data-lotnumber="<?php echo $item->lot_number;?>"
                                    data-expdate="<?php echo  $expdate ?>" 
                                    data-qty="<?php echo $item->qty;?>"
                                    data-toggle="modal" data-target="#editqty" 
                                    class="glyphicon glyphicon-pencil btn btn-info btn-sm editqty"
                                    data-backdrop="static" data-keyboard="false">
                                </a>

                                <a title="Edit" 
                                    href="<?=site_url('Deliveryinfo_con/deletedeliveryline/'.$item->dl_no)?>" 
                                    class="glyphicon glyphicon-trash btn btn-danger btn-sm" 
                                    onclick="return confirm('Do you want to delete this product');">
                                </a>
                            </td>
                        <?php } ?>
                        <td class="" style="text-transform: capitalize"><?php echo $item->barcode.'<br>'.$item->name ?> </td>
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
             
        </div> <!-- end of panel body -->
       
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->
   
<div class="col-md-4" style="margin-top:60px;" >    
    <div class="panel panel-default">
        <div class="panel-heading ">                
            <div class="panel-toolbar text-right" >               
                <?php if($del[0]->post == 'YES'){}else { ?>
                    <button type="button" data-toggle="modal" data-target="#addproduct" class="btn btn-sm btn-info text-center" >INSERT PRODUCT</button> 
                <?php } ?>
            </div>
        </div> <!-- end of panel heading -->  
        <form onsubmit="return updatedeliveryform(this);" role="form" method="post" action="<?=site_url('Deliveryinfo_con/updatedelivery')?>">             
            <div class="panel-body">  

                    <div class="col-md-12">
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-10 ">
                                <input 
                                    id="mbirthday" 
                                    class="form-control input-sm text-center" 
                                    type="text" 
                                    name="date" 
                                    value="<?php echo date_format(date_create($del[0]->date), 'm/d/Y');?>" 
                                    autocomplete="off" <?php if($del[0]->post == 'YES'){ echo 'disabled'; }else {} ?>/>
                            </div>     
                        </div>      
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row row-offcanvas">     
                            <label class="col-sm-2 control-label">Ref.No.</label>
                            <div class="col-sm-10">
                                <input 
                                    class="form-control input-sm text-center" 
                                    type="text" name="refno" 
                                    value="<?php echo $del[0]->ref_no;?>" <?php if($del[0]->post == 'YES'){ echo 'disabled'; }else {} ?> />
                            </div>   
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row row-offcanvas">    
                            <label class="col-sm-2 control-label">Supplier Name</label>
                            <div class="col-sm-10">
                                <button style="text-transform: capitalize" 
                                class="form-control input-sm"  
                                type="button" 
                                data-toggle="modal" 
                                data-target="#changesupplier"<?php if($del[0]->post == 'YES'){ echo 'disabled'; }else {} ?> >
                                    <strong><?php echo $del[0]->name;?>...</strong >
                                </button>
                            </div> 
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Discount Amount</label>
                            <div class="col-sm-10">
                                <button style="text-transform: capitalize" class="form-control input-sm"  type="button" data-toggle="modal" data-target="#updatediscount" <?php if($del[0]->post == 'YES'){ echo 'disabled'; }else {} ?>><strong><?php echo number_format((float)$del[0]->discount,2,'.',',');?></strong></button>
                            </div> 
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row row-offcanvas">
                            <label class="col-sm-2 control-label">Total Amount</label>
                            <div class="col-sm-10">
                                <p <?php if($del[0]->post == 'YES'){ echo 'disabled'; }else {} ?> class="form-control input-sm text-center" type="text" ><?php echo number_format((float)$del[0]->totalamount,2,'.',',');?> </p>
                            </div>   

                           
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group row row-offcanvas">                    
                            <label class="col-sm-2 control-label">Remarks</label>
                            <div class="col-sm-10">
                                <input class="form-control input-sm text-center" type="textarea" name="remarks" value="<?php echo $del[0]->remarks;?>" autocomplete="off" <?php if($del[0]->post == 'YES'){ echo 'disabled'; }else {} ?>  />
                            </div>                                   
                        </div>
                    </div>      

            </div>            
            <div class="modal-footer">
                <a title="Close" href="<?=site_url('delivery_con')?>" onclick="return confirm('Do you want to go back');" type="button" class="btn btn-warning" >BACK</a>
                <?php if($del[0]->post == 'YES'){}else { ?> 
                    <input type="submit" class="btn btn-primary" name="updatedeliverybtn" value="SUBMIT">
                <?php } ?>
            </div>    
            </div>
        </form>
    </div>
</div>
<!-- Modal -->
<div id="changesupplier" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Select Supplier</h4>
        </div>
                           
            <div class="modal-body">                   
                <table class="table table-hover table-responsive table-bordered table-striped info" id="CoTable"> 
                <thead>
                    <tr class="info">                                                                
                        <td class="text-center"><strong>Supplier</strong></td>  
                        <td class="text-center"><strong>Action</strong></td>  
                    </tr> 
                </thead>
                <tbody>
                      <?php foreach ($sup as $key => $item): ?>                      
                    <tr>                         
                        <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                        <td class="text-center info">     
                            <a title="Select" href="<?=site_url('deliveryinfo_con/changesupplier/'.$item->s_no)?>" class=" btn btn-info">SELECT</a>
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
                    <td class="text-center"><strong>Action</strong></td>  
                </tr> 
            </thead>
            <tbody>
                  <?php foreach ($prod as $key => $item): ?>                      
                <tr>                         
                    <td class="text-center" style="text-transform: capitalize"><?php echo $item->barcode ?></td>
                    <td class="text-center" style="text-transform: capitalize"><?php echo $item->name ?></td>
                    <td class="text-center info">                                
                        <button title="Add QTY" 
                            data-pno="<?php echo $item->p_no;?>"                                
                            data-name="<?php echo $item->name;?>"
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
               
        <form onsubmit="return qtyform(this);" role="form" method="post" action="<?=site_url('Deliveryinfo_con/insertdeliveryline')?>">             
            <div class="modal-body">            

                <input id="pno" class="form-control input-sm hide" type="text" name="pno" />
                <input id="unitcost" class="form-control input-sm hide" type="text" name="unitcost" /> 
            
                <div class="form-group row row-offcanvas">                                                        
                    <label class="col-sm-4 control-label">Product Name</label>
                    <div class="col-sm-8">
                        <input id="name" class="form-control input-sm " type="text" name="name" disabled />
                    </div>   
                </div>

                <div class="form-group row row-offcanvas">                                       
                    <label class="col-sm-4 control-label">Qty</label>
                    <div class="col-sm-8">
                        <input id="qty" class="form-control input-sm " type="number" step="any" name="qty" required autocomplete="off" />
                    </div>   
                </div>

                <div class="form-group row row-offcanvas">                                       
                    <label class="col-sm-4 control-label">LOT No.</label>
                    <div class="col-sm-8">
                        <input id="lot_number" class="form-control input-sm " type="text" name="lot_number" autocomplete="off" />
                    </div>   
                </div>

                <div class="form-group row row-offcanvas">                                       
                    <label class="col-sm-4 control-label">Expiration Date</label>
                    <div class="col-sm-8">
                        <input id="fbirthday" class="form-control input-sm" type="text" name="expiration_date" autocomplete="off" />
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
               
        <form onsubmit="return editqtyform(this);" role="form" method="post" action="<?=site_url('Deliveryinfo_con/updatedeliveryline')?>">             
        <div class="modal-body">            

            <input id="dlno" class="form-control input-sm hide" type="text" name="dlno" />
            <input id="unitcost" class="form-control input-sm hide" type="text" name="unitcost" /> 
          
            <div class="form-group row row-offcanvas">                                                        
                <label class="col-sm-4 control-label">Product Name</label>
                <div class="col-sm-8">
                    <input id="name" class="form-control input-sm " type="text" name="name" disabled />
                </div>   
            </div>

            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-4 control-label">Qty</label>
                <div class="col-sm-8">
                    <input id="qty" class="form-control input-sm " type="number" step="any" name="qty" required autocomplete="off" />
                </div>   
            </div>
        
            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-4 control-label">LOT No.</label>
                <div class="col-sm-8">
                    <input id="lotnumber" class="form-control input-sm " type="text" name="lot_number" autocomplete="off" />
                </div>   
            </div>

            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-4 control-label">Expiration Date</label>
                <div class="col-sm-8">
                    <input id="to" class="form-control input-sm" type="text" name="expiration_date" autocomplete="off" />
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

<!-- Modal -->
<div id="updatediscount" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Update Discount</h4>
        </div>
               
        <form onsubmit="return updatediscountform(this);" role="form" method="post" action="<?=site_url('Deliveryinfo_con/updatediscount')?>">             
        <div class="modal-body">             

            <div class="form-group row row-offcanvas">                                       
                <label class="col-sm-6 control-label">Discount</label>
                <div class="col-sm-6">
                    <input class="form-control input-sm " type="number" step="any" name="discount" required autocomplete="off" />
                </div>   

            </div>
        
        </div>
        <div class="modal-footer">
                <a title="Close" href="<?=site_url('Deliveryinfo_con')?>" onclick="return confirm('Do you want to cancel');" type="button" class="btn btn-danger glyphicon glyphicon-floppy-remove" ></a>
              <input type="submit" class="btn btn-primary" name="updatediscountbtn" value="submit">
            </div>
        </form>

    </div>
  </div>
</div> <!-- End of model -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>

<script type="text/javascript">

function qtyform(formObj) {            
        formObj.qtyaddbtn.disabled = true;  
        formObj.qtyaddbtn.value = 'Please Wait...';  
        return true;    
    }  

function updatedeliveryform(formObj) {            
        formObj.updatedeliverybtn.disabled = true;  
        formObj.updatedeliverybtn.value = 'Please Wait...';  
        return true;    
    }      

function editqtyform(formObj) {            
        formObj.qtyeditbtn.disabled = true;  
        formObj.qtyeditbtn.value = 'Please Wait...';  
        return true;    
    } 

function updatediscountform(formObj) {            
        formObj.updatediscountbtn.disabled = true;  
        formObj.updatediscountbtn.value = 'Please Wait...';  
        return true;    
    } 

window.onload = function()
{                         

    $(document).ready(function () {
        $(document).on('click', '.addqty', function(event) {        
            var pno = $(this).data('pno');
            var name = $(this).data('name');
            var unitcost = $(this).data('unitcost');
            $(".modal-body #pno").val( pno );
            $(".modal-body #name").val( name );
            $(".modal-body #unitcost").val( unitcost );
        });
    });

    $(document).ready(function () {
        $(document).on('click', '.editqty', function(event) {        
            var dlno = $(this).data('dlno');
            var name = $(this).data('name');
            var unitcost = $(this).data('unitcost');
            var qty = $(this).data('qty');
            var lotnumber = $(this).data('lotnumber');
            var expdate = $(this).data('expdate');
            $(".modal-body #dlno").val( dlno );
            $(".modal-body #name").val( name );
            $(".modal-body #unitcost").val( unitcost );
            $(".modal-body #qty").val( qty );
            $(".modal-body #lotnumber").val( lotnumber );
            $(".modal-body #to").val( expdate );
        });
    });
}

</script>