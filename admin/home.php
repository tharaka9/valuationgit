<?php
require_once('../config.php');

    $qry = $conn->query("SELECT COUNT(id) AS id FROM `inquery_list`");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
    }

    $qry1 = $conn->query("SELECT COUNT(id) AS id FROM `valuation_list`");
    if($qry1->num_rows > 0){
        $res1 = $qry1->fetch_array();
    }

    $qry2 = $conn->query("SELECT SUM(fullamount) AS fullamount FROM payment_status WHERE MONTH(date_created) = MONTH(CURRENT_DATE())");
    if($qry2->num_rows > 0){
        $res2 = $qry2->fetch_array();
    }

?>


<style>

.border-start-primary{
border-left-color: #00ac69 !important;
border-left-width: 0.25rem !important;
color: #00ac69 !important;
}

</style>

<h1>Welcome to <?php echo $_settings->info('name') ?></h1>


<div class="container-fluid">

		<div class="row">
                            <div class="col-xl-4 col-md-6">
                                <div class="card mb-4 border-start-primary">
                                    <div class="card-body text-center">Total Inquiries</div>
									<h6 class="text-center"><?php echo isset($res['id']) ? $res['id'] : '' ?></h6>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small stretched-link" href="#">View Details</a>
                                        <div class="small "><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
							<div class="col-xl-4 col-md-6">
                                <div class="card mb-4 border-start-primary">
                                    <div class="card-body text-center">Total Valuation Companies</div>
                                    <h6 class="text-center"><?php echo isset($res1['id']) ? $res1['id'] : '' ?></h6>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small stretched-link" href="#">View Details</a>
                                        <div class="small "><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card mb-4 border-start-primary">
                                    <div class="card-body text-center">This Month Total Amount</div>
                                    <h6 class="text-center">Rs. <?php echo isset($res2['fullamount']) ? $res2['fullamount'] : '' ?></h6>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small stretched-link" href="#">View Details</a>
                                        <div class="small "><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

		</div>