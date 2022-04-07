<style>
    .img-avatar{
        width:45px;
        height:45px;
        object-fit:cover;
        object-position:center center;
        border-radius:100%;
    }
</style>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Inquery</h3>
		<div class="card-tools">
			<a href="./?page=products/manage_product" id="create_new" class="btn btn-flat btn-sm btn-primary"><span class="fas fa-plus"></span>  Add New Inquery</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped">
				<colgroup>
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead style="font-size: 0.8rem;">
					<tr>
						<th>Date Created</th>
						<th>Customer Name</th>
						<th>Customer Address</th>
						<th>Customer Email address</th>
						<th>Customer Contact Number</th>
						<th>Finance Company</th>
						<th>Branch</th>
						<th>Attraction Person</th>
						<th>Payment Collection Person</th>
						<th>Inquery Added</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody style="font-size: 0.8rem;">
					<?php 
						$qry = $conn->query("SELECT
						inquery_list.id,
						inquery_list.date_created,
						inquery_list.name,
						inquery_list.address,
						inquery_list.email,
						inquery_list.contactno,
						inquery_list.attractionperson,
						inquery_list.paymentcollectionperson,
						inquery_list.status,
						finance_company_list.name AS fname,
						branch_list.name AS bname,
						users.firstname AS uname,
						employee_list.fname AS emp_fname,
						employee_list.lname AS emp_lname
					FROM
						`inquery_list`
					INNER JOIN `branch_list` ON `inquery_list`.branch_id = `branch_list`.id
					INNER JOIN `finance_company_list` ON `inquery_list`.finance_id = `finance_company_list`.id
					INNER JOIN `users` ON `inquery_list`.uid = `users`.id
					INNER JOIN `employee_list` ON `inquery_list`.paymentcollectionperson = `employee_list`.id");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class=""><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td><?php echo ucwords($row['name']) ?></td>
							<td><?php echo ucwords($row['address']) ?></td>
							<td><?php echo ucwords($row['email']) ?></td>
							<td><?php echo ucwords($row['contactno']) ?></td>
							<td class=""><?php echo ucwords($row['fname'] ? $row['fname'] : "") ?></td>
							<td class=""><?php echo ucwords($row['bname'] ? $row['bname'] : "") ?></td>
							<td><?php echo ucwords($row['attractionperson']) ?></td>
							<td class=""><?php echo ucwords($row['emp_fname']." ".$row['emp_lname'] ? $row['emp_fname']." ".$row['emp_lname'] : "") ?></td>
							<td><?php echo ucwords($row['uname']) ?></td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item" href="./?page=products/payment_status&id=<?= $row['id'] ?>" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Payment Status</a>
				                    <div class="dropdown-divider"></div>
									<a class="dropdown-item" href="./?page=products/add_images&id=<?= $row['id'] ?>" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Add Images</a>
				                    <div class="dropdown-divider"></div>
									<a class="dropdown-item" href="./?page=products/vehicle_fea&id=<?= $row['id'] ?>" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Vehicle Features</a>
				                    <div class="dropdown-divider"></div>
									<a class="dropdown-item" href="./?page=products/payment_check&id=<?= $row['id'] ?>" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Payment Check</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
				                  </div>
							</td>
						</tr>
						<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>

	$(document).ready(function(){
		
        $('#create_new').click(function(){
			uni_modal("Finance Company Details","financecompany/manage_category.php")
		})
        $('.edit_data').click(function(){
			uni_modal("Finance Company Details","financecompany/manage_category.php?id="+$(this).attr('data-id'))
		})
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Category permanently?","delete_inquery",[$(this).attr('data-id')])
		})
		$('.view_data').click(function(){
			uni_modal("Finance Company Details","financecompany/view_category.php?id="+$(this).attr('data-id'))
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });
	})
	function delete_inquery($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_inquery",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>

