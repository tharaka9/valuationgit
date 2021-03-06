<?php 
require_once('../../config.php');

$name = $_POST['name'];

switch ($name) {
    case "customer":
?>

<h1 class="text-center">Customers</h1>
<table id="mytable" class="table table-striped table-bordered">
			<colgroup>
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>Customer Name</th>
						<th>Address</th>
						<th>Email</th>
						<th>Contact No</th>
						<th>Paid Amount</th>
                        <th>Date</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$qry = $conn->query("SELECT inquery_list.name, inquery_list.address, inquery_list.email, inquery_list.contactno, payment_status.fullamount, payment_status.date_created from inquery_list INNER JOIN payment_status ON inquery_list.id = payment_status.uid ORDER by inquery_list.id");
						while($row = $qry->fetch_assoc()):
						
					?>
						<tr>
                            <td><?php echo ucwords($row['name']) ?></td>
                            <td><?php echo ucwords($row['address']) ?></td>
                            <td><?php echo ucwords($row['email']) ?></td>
                            <td><?php echo ucwords($row['contactno']) ?></td>
                            <td><?php echo ucwords($row['fullamount']) ?></td>
							<td class=""><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>

            
<?php        break;
    case "finance":
?>
		<h1 class="text-center">Finance Company</h1>
		<table id="mytable" class="table table-striped table-bordered">
					<colgroup>
							<col width="10%">
							<col width="10%">
							<col width="10%">
							<col width="10%">
						</colgroup>
						<thead>
							<tr>
								<th>Finance Company</th>
								<th>Branch</th>
								<th>Amount</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$qry = $conn->query("SELECT
								finance_company_list.name,
								branch_list.name AS bname,
								payment_status.companyfee,
								payment_status.date_created
							FROM
								inquery_list
							INNER JOIN payment_status ON inquery_list.uid = payment_status.uid
							INNER JOIN finance_company_list ON inquery_list.finance_id = finance_company_list.id
							INNER JOIN branch_list ON inquery_list.branch_id = branch_list.id");
								while($row = $qry->fetch_assoc()):
								
							?>
								<tr>
									<td><?php echo ucwords($row['name']) ?></td>
									<td><?php echo ucwords($row['bname']) ?></td>
									<td><?php echo ucwords($row['companyfee']) ?></td>
									<td class=""><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
								</tr>
							<?php endwhile; ?>
						</tbody>
				</table>

				<?php
        break;
    case "employee":
?>

		<h1 class="text-center">Employee</h1>
		<table id="mytable" class="table table-striped table-bordered">
					<colgroup>
							<col width="10%">
							<col width="10%">
							<col width="10%">
							<col width="10%">
							<col width="10%">
						</colgroup>
						<thead>
							<tr>
								<th>Employee</th>
								<th>Contact No</th>
								<th>Email</th>
								<th>Amount</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$qry = $conn->query("SELECT
								employee_list.fname,
								employee_list.lname,
								employee_list.contactno,
								employee_list.email,
								payment_status.fullamount,
								payment_status.date_created
							FROM
								employee_list
							INNER JOIN payment_status ON employee_list.id = payment_status.employee");
								while($row = $qry->fetch_assoc()):
								
							?>
								<tr>
									<td><?php echo ucwords($row['fname']." ".$row['lname']) ?></td>
									<td><?php echo ucwords($row['contactno']) ?></td>
									<td><?php echo ucwords($row['email']) ?></td>
									<td><?php echo ucwords($row['fullamount']) ?></td>
									<td class=""><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
								</tr>
							<?php endwhile; ?>
						</tbody>
				</table>
<?php
        break;
    case "test2":
        echo "Your favorite color is test2!";
        break;
    default:
      echo "Your favorite color is neither red, blue, nor green!";
  }



?>