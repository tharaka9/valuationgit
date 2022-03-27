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
        <h5 class="card-title"><?= isset($id) ? "Add New Product" : "Update Product Details" ?></h5>
    </div>
    <div class="card-body rounded-0">
        <div class="container-fluid">
            <form action="" id="product-form">
                <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_title" class="control-label text-dark">Full Amount</label>
                                <input type="text" name="fullamount" id="fullamount" class="form-control form-control-border" placeholder="" value ="<?php echo isset($res['fullamount']) ? $res['fullamount'] : '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="price" class="control-label text-dark">Valuation Fee</label>
                                <input type="text" name="valuationfee" id="valuationfee" class="form-control form-control-border" placeholder="" value ="<?php echo isset($res['valuationfee']) ? $res['valuationfee'] :"" ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="price" class="control-label text-dark">Finance Company Fee</label>
                                <input type="text" name="companyfee" id="companyfee" class="form-control form-control-border" placeholder="" value ="<?php echo isset($res['companyfee']) ? $res['companyfee'] :"" ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="model" class="control-label text-dark">Inspection Person Fee</label>
                                <input type="text" name="inspectionpersonfee" id="inspectionpersonfee" class="form-control form-control-border" placeholder="" value ="<?php echo isset($res['inspectionpersonfee']) ? $res['inspectionpersonfee'] : "" ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="year" class="control-label text-dark">Interduction Person Fee</label>
                                <input type="text" name="interductionpersonfee" id="interductionpersonfee" class="form-control form-control-border" placeholder="" value ="<?php echo isset($res['interductionpersonfee']) ? $res['interductionpersonfee'] : "" ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="mileage" class="control-label text-dark">Head Office Fee</label>
                                <input type="text" name="headofficefee" id="headofficefee" class="form-control form-control-border" placeholder="" value ="<?php echo isset($res['headofficefee']) ? $res['headofficefee'] : "" ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="fuel" class="control-label text-dark">Total</label>
                                <input type="text" name="total" id="total" class="form-control form-control-border" placeholder="" value ="<?php echo isset($res['total']) ? $res['total'] : "" ?>" required>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-footer rounded-0">
        <button class="btn btn-primary" type="submit" form="product-form">Save</button>
        <a class="btn btn-secondary" href="?page=products">Cancel</a>
    </div>
</div>
<script>
    function displayMag(input,_this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#product-cover').attr('src', e.target.result);
                _this.siblings('label').text(input.files[0].name)
            }
            reader.readAsDataURL(input.files[0]);
        }else{
            _this.siblings('label').text('Choose file')
            $('#product-cover').attr('src', "<?php echo validate_image(isset($banner_path) ? $banner_path :'') ?>");
        }
    }
    function showName(_this){
        if (_this[0].files && _this[0].files[0]) {
                _this.siblings('label').text(_this[0].files[0].name)
        }else{
            _this.siblings('label').text('Choose file')
        }
    }
    $(function(){
       
        $('.select2').select2();
        $('.summernote').summernote({
		        height: '40vh',
		        placeholder: $(this).attr('data-placeholder') || "Write here",
		        toolbar: [
		            [ 'font', [ 'bold', 'italic', 'clear'] ],
		            [ 'fontname', [ 'fontname' ] ],
		            [ 'color', [ 'color' ] ],
		            [ 'para', [ 'ol', 'ul', 'paragraph' ] ],
		            [ 'view', [ 'undo', 'redo' ] ]
		        ]
		    })
        $('#product-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_payment",
				data: new FormData($(this)[0]),
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
                        location.reload();
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
                }
            })
        })
    })
</script>