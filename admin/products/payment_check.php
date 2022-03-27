<?php
if(isset($_GET['id'])){
    $uid = $_GET['id'];
    $qry = $conn->query("SELECT * FROM `payment_status` where uid = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $k = $v;
        }
    }

    // if(is_null($date_updated))
    // $date_updated = strtotime($date_created);
    // else
    // $date_updated = strtotime($date_updated);
}


?>

<style>
    #product-cover{
        object-fit:scale-down;
        object-position: center center;
        height:30vh;
        width:20vw;
    }
</style>

<div class="card card-outline card-primary rounded-0 shadow-sm my-3">
    <div class="card-header rounded-0">
        <h5 class="card-title"><?= isset($id) ? "Add New Product Inquery" : "Add Vehicle Features" ?></h5>
    </div>
    <div class="card-body rounded-0">
        <div class="container-fluid">
            <form action="" id="product-form">
                <input type="hidden" name="uid" value="<?php echo $uid ?>">
                <?php 
   $qry = $conn->query("SELECT * FROM `payment_status` where uid = '{$_GET['id']}' ".(isset($id) ? " or id = '{$id}'" : "" )." order by `id` asc");
    $row = $qry->fetch_assoc();
    ?>  


  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Full Amount</label>
      <input type="text" class="form-control" placeholder="Full Amount" value="Rs: <?= ucwords($row['fullamount']) ?>" disabled>
    </div>
    <div class="form-group col-md-6">
      <input type="hidden" name="fullamount_check_agent" value="0">
    <input type="checkbox" class="form-check-input" style="height: 1.2rem;width: 1.2rem;margin-left: 10%;margin-top: 4%;" id="exampleCheck1" name="fullamount_check_agent" value="1" <?= isset($row['fullamount_check_agent']) && $row['fullamount_check_agent'] == 1 ? "checked" :"" ?>> 
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Valuation Fee</label>
      <input type="text" class="form-control" placeholder="Valuation Fee" value="Rs: <?= ucwords($row['valuationfee']) ?>" disabled>
    </div>
    <div class="form-group col-md-6">
      <input type="hidden" name="valuationfee_check_agent" value="0">
    <input type="checkbox" class="form-check-input" style="height: 1.2rem;width: 1.2rem;margin-left: 10%;margin-top: 4%;" id="exampleCheck1" name="valuationfee_check_agent" value="1" <?= isset($row['valuationfee_check_agent']) && $row['valuationfee_check_agent'] == 1 ? "checked" :"" ?>> 
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Finance Company Fee</label>
      <input type="text" class="form-control" placeholder="Finance Company Fee" value="Rs: <?= ucwords($row['companyfee']) ?>" disabled>
    </div>
    <div class="form-group col-md-6">
      <input type="hidden" name="companyfee_check_agent" value="0">
    <input type="checkbox" class="form-check-input" style="height: 1.2rem;width: 1.2rem;margin-left: 10%;margin-top: 4%;" id="exampleCheck1" name="companyfee_check_agent" value="1" <?= isset($row['companyfee_check_agent']) && $row['companyfee_check_agent'] == 1 ? "checked" :"" ?>> 
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Inspection Person Fee</label>
      <input type="text" class="form-control" placeholder="Inspection Person Fee" value="Rs: <?= ucwords($row['inspectionpersonfee']) ?>" disabled>
    </div>
    <div class="form-group col-md-6">
      <input type="hidden" name="inspectionpersonfee_check_agent" value="0">
    <input type="checkbox" class="form-check-input" style="height: 1.2rem;width: 1.2rem;margin-left: 10%;margin-top: 4%;" id="exampleCheck1" name="inspectionpersonfee_check_agent" value="1" <?= isset($row['inspectionpersonfee_check_agent']) && $row['inspectionpersonfee_check_agent'] == 1 ? "checked" :"" ?>> 
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Interduction Person Fee</label>
      <input type="text" class="form-control" placeholder="Interduction Person Fee" value="Rs: <?= ucwords($row['interductionpersonfee']) ?>" disabled>
    </div>
    <div class="form-group col-md-6">
      <input type="hidden" name="interductionpersonfee_check_agent" value="0">
    <input type="checkbox" class="form-check-input" style="height: 1.2rem;width: 1.2rem;margin-left: 10%;margin-top: 4%;" id="exampleCheck1" name="interductionpersonfee_check_agent" value="1" <?= isset($row['interductionpersonfee_check_agent']) && $row['interductionpersonfee_check_agent'] == 1 ? "checked" :"" ?>> 
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Head Office Fee</label>
      <input type="text" class="form-control" placeholder="Head Office Fee" value="Rs: <?= ucwords($row['headofficefee']) ?>" disabled>
    </div>
    <div class="form-group col-md-6">
      <input type="hidden" name="headofficefee_check_agent" value="0">
    <input type="checkbox" class="form-check-input" style="height: 1.2rem;width: 1.2rem;margin-left: 10%;margin-top: 4%;" id="exampleCheck1" name="headofficefee_check_agent" value="1" <?= isset($row['headofficefee_check_agent']) && $row['headofficefee_check_agent'] == 1 ? "checked" :"" ?>> 
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Total</label>
      <input type="text" class="form-control" placeholder="Total" value="Rs: <?= ucwords($row['total']) ?>" disabled>
    </div>
    <div class="form-group col-md-6">
      <input type="hidden" name="total_check_agent" value="0">
    <input type="checkbox" class="form-check-input" style="height: 1.2rem;width: 1.2rem;margin-left: 10%;margin-top: 4%;" id="exampleCheck1" name="total_check_agent" value="1" <?= isset($row['total_check_agent']) && $row['total_check_agent'] == 1 ? "checked" :"" ?>> 
    </div>
  </div>



            </form>
        </div>
    </div>
    <div class="card-footer rounded-0">
        <button class="btn btn-primary" type="submit" form="product-form">Save Inquery</button>
        <a class="btn btn-secondary" href="./?page=?products">Cancel</a>
    </div>
</div>
<script>

     
        $('#product-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=payment_check",
				data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
                success:function(resp){
                    if(resp.status == 'success'){
                        location.replace("./?page=products/");
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }else{
                        el.addClass("alert-danger")
                        el.text("An error occurred due to unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    end_loader();
                    $('html, body').animate({scrollTop:0},'fast')
                }
            })
        })

    
</script>