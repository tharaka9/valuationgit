<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `finance_company_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $k = $v;
        }
    }
}


?>

<div class="container-fluid">
    <form action="" id="category-form">
        <input type="hidden" name="id" value="<?php echo isset($res['id']) ? $res['id'] : '' ?>">
        <div class="form-group">
            <input type="text" name="name" id="name" class="form-control form-control-border" placeholder="Finance Company Name" value ="<?php echo isset($res['name']) ? $res['name'] : '' ?>" required>
        </div>
        <div class="form-group">
            <textarea rows="3" name="description" id="description" class="form-control form-control-border" placeholder="Finance Company descrtion" required><?php echo isset($res['description']) ? $res['description'] : '' ?></textarea>
        </div>
        <div class="form-group">
            <select name="status" id="status" class="form-control form-control-border" required>
                <option value="1" <?= isset($status) && $status == 1 ? "selected" :"" ?>>Active</option>
                <option value="0" <?= isset($status) && $status == 0 ? "selected" :"" ?>>Inactive</option>
            </select>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#uni_modal #category-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_category",
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