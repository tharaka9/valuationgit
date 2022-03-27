<?php
if(isset($_GET['id'])){
    $uid = $_GET['id'];
    $qry1 = $conn->query("SELECT * FROM `add_feature` where uid = '{$_GET['id']}'");

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
            <form action="" id="product-form" method="POST">
                <input type="hidden" name="uid" value="<?php echo $uid ?>">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6">
                            <?php 
                                    $qry = $conn->query("SELECT * FROM `feature_list` where `status` = 1 ".(isset($finance_id) ? " or id = '{$finance_id}'" : "" )." order by `name` asc");
                                    while($row = $qry->fetch_assoc()):
                                        $res = mysqli_fetch_assoc($qry1);
                                    ?>       
                            <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="name[]" value="<?= ucwords($row['name']) ?>" <?= isset($res['name']) ? "checked='checked'" :"" ?>>
                        <label class="form-check-label" for="inlineCheckbox1"><?= ucwords($row['name']) ?></label>
                        </div>
                        <?php endwhile; ?>

                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="card-footer rounded-0">
        <button class="btn btn-primary" type="submit" name="submit" form="product-form">Save Inquery</button>
        <a class="btn btn-secondary" href="./?page=?products">Cancel</a>
    </div>
    </form>
</div>

<?php 
if(isset($_POST['submit']))
{

	foreach ($_POST['name'] as $key => $value) {

			$query="INSERT INTO add_feature (name, uid) VALUES ('$value', '$uid')";     
		
			$save = $conn->query($query);
    }

    redirect($url = 'admin/?page=products');
}


?>