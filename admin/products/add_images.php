<?php

if(isset($_GET['id'])){
    $uid = $_GET['id'];
    $qry = $conn->query("SELECT * FROM images WHERE uid = '{$_GET['id']}'");
    while ($row = mysqli_fetch_assoc($qry)) {

	if ($row['details'] == "img_fside") {
		$img_fside = $row['image'];
	}

	elseif ($row['details'] == "img_rside") {

		$img_rside = $row['image'];
	}

	elseif ($row['details'] == "img_selfie") {

		$img_selfie = $row['image'];
	}

	elseif ($row['details'] == "img_cnumber") {

		$img_cnumber = $row['image'];
	}

	elseif ($row['details'] == "video") {

		$video = $row['image'];
	}

	elseif ($row['details'] == "img_importent1") {

		$img_importent1 = $row['image'];
	}
	
	elseif ($row['details'] == "img_importent2") {

		$img_importent2 = $row['image'];
	}
	
	elseif ($row['details'] == "img_importent3") {

		$img_importent3 = $row['image'];
	}

	elseif ($row['details'] == "place") {

		$place = $row['location'];
	}

    }


}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Multiple Images in Single Colomn from Multiple Input Field</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<div class="card">
						<div class="card-header  text-center bg-primary text-white text-uppercase">
						ADD PAYMENT
						</div>
						<div class="card-body">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label>Location</label>
								<input type="text" name="location" class="form-control" value ="<?php echo isset($place) ? $place : '' ?>">
								</div>
								<div class="form-group">
									<label>Front Side</label>
								<input type="file" name="img_fside" class="form-control">
								<br>
								<img src="<?php echo isset($img_fside) ? $img_fside : '' ?>" width="200" height="100"> 
								</div>
								<div class="form-group">
									<label>Rear Side</label>
								<input type="file" name="img_rside" class="form-control">
								<br>
								<img src="<?php echo isset($img_rside) ? $img_rside : '' ?>" width="200" height="100"> 
								</div>
								<div class="form-group">
									<label>Selfie</label>
								<input type="file" name="img_selfie" class="form-control">
								<br>
								<img src="<?php echo isset($img_selfie) ? $img_selfie : '' ?>" width="200" height="100"> 
								</div>
								<div class="form-group">
									<label>Chassis Number</label>
								<input type="file" name="img_cnumber" class="form-control">
								<br>
								<img src="<?php echo isset($img_cnumber) ? $img_cnumber : '' ?>" width="200" height="100"> 
								</div>
								<div class="form-group">
									<label>Video</label>
								<input type="file" name="video" class="form-control">
								<br>
								<img src="<?php echo isset($video) ? $video : '' ?>" width="200" height="100"> 
								</div>
								<div class="form-group">
									<label>Importent Images</label>
								<input type="file" name="img_importent1" class="form-control">
								<br>
								<img src="<?php echo isset($img_importent1) ? $img_importent1 : '' ?>" width="200" height="100"> 
								</div>
								<div class="form-group">
									
								<input type="file" name="img_importent2" class="form-control">
								<br>
								<img src="<?php echo isset($img_importent2) ? $img_importent2 : '' ?>" width="200" height="100"> 
								</div>
								<div class="form-group">
									
								<input type="file" name="img_importent3" class="form-control">
								<br>
								<img src="<?php echo isset($img_importent3) ? $img_importent3 : '' ?>" width="200" height="100"> 
								</div>
								<div class="form-group">
									<input type="submit" name="submit" class="btn btn-primary
									">
									<a class="btn btn-secondary" href="?page=products">Cancel</a>
								</div>
								
							</form>
						</div>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</div>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script></body>
</html>
<?php 
if(isset($_POST['submit']))
{
    $place = $_POST['location'];
	$uid = $_GET['id'];

			$query="INSERT INTO images (location, details ,uid) VALUES ('$place', 'place', '$uid')";     
		
			$save = $conn->query($query);



foreach ($_FILES as $key => $value) {
	
	if ($key == "img_fside") {

		$name = $value['name'];
		$tempname = $value['tmp_name'];

		$ext = pathinfo($name, PATHINFO_EXTENSION);
	$newFilename = $key ."_" . time() . "." . $ext;
	move_uploaded_file($tempname, '../uploads/' . $newFilename);
	$location = '../uploads/' . $newFilename;
	$query="insert into images (image, details, uid) values('$location', '$key', '$uid')";
	mysqli_query($conn,$query);

	}

	elseif ($key == "img_rside") {

		$name = $value['name'];
		$tempname = $value['tmp_name'];

	$ext = pathinfo($name, PATHINFO_EXTENSION);
	$newFilename = $key ."_" . time() . "." . $ext;
	move_uploaded_file($tempname, '../uploads/' . $newFilename);
	$location = '../uploads/' . $newFilename;
	$query="insert into images (image, details, uid) values('$location', '$key', '$uid')";
	mysqli_query($conn,$query);

	}

	elseif ($key == "img_selfie") {

		$name = $value['name'];
		$tempname = $value['tmp_name'];

	$ext = pathinfo($name, PATHINFO_EXTENSION);
	$newFilename = $key ."_" . time() . "." . $ext;
	move_uploaded_file($tempname, '../uploads/' . $newFilename);
	$location = '../uploads/' . $newFilename;
	$query="insert into images (image, details, uid) values('$location', '$key', '$uid')";
	mysqli_query($conn,$query);

	}

	elseif ($key == "img_cnumber") {

		$name = $value['name'];
		$tempname = $value['tmp_name'];

	$ext = pathinfo($name, PATHINFO_EXTENSION);
	$newFilename = $key ."_" . time() . "." . $ext;
	move_uploaded_file($tempname, '../uploads/' . $newFilename);
	$location = '../uploads/' . $newFilename;
	$query="insert into images (image, details, uid) values('$location', '$key', '$uid')";
	mysqli_query($conn,$query);

	}

	elseif ($key == "video") {

		$name = $value['name'];
		$tempname = $value['tmp_name'];

	$ext = pathinfo($name, PATHINFO_EXTENSION);
	$newFilename = $key ."_" . time() . "." . $ext;
	move_uploaded_file($tempname, '../uploads/' . $newFilename);
	$location = '../uploads/' . $newFilename;
	$query="insert into images (image, details, uid) values('$location', '$key', '$uid')";
	mysqli_query($conn,$query);

	}

	elseif ($key == "img_importent1") {

		$name = $value['name'];
		$tempname = $value['tmp_name'];

	$ext = pathinfo($name, PATHINFO_EXTENSION);
	$newFilename = $key ."_" . time() . "." . $ext;
	move_uploaded_file($tempname, '../uploads/' . $newFilename);
	$location = '../uploads/' . $newFilename;
	$query="insert into images (image, details, uid) values('$location', '$key', '$uid')";
	mysqli_query($conn,$query);

	}

	elseif ($key == "img_importent2") {

		$name = $value['name'];
		$tempname = $value['tmp_name'];

	$ext = pathinfo($name, PATHINFO_EXTENSION);
	$newFilename = $key ."_" . time() . "." . $ext;
	move_uploaded_file($tempname, '../uploads/' . $newFilename);
	$location = '../uploads/' . $newFilename;
	$query="insert into images (image, details, uid) values('$location', '$key', '$uid')";
	mysqli_query($conn,$query);

	}

	elseif ($key == "img_importent3") {

		$name = $value['name'];
		$tempname = $value['tmp_name'];

	$ext = pathinfo($name, PATHINFO_EXTENSION);
	$newFilename = $key ."_" . time() . "." . $ext;
	move_uploaded_file($tempname, '../uploads/' . $newFilename);
	$location = '../uploads/' . $newFilename;
	$query="insert into images (image, details, uid) values('$location', '$key', '$uid')";
	mysqli_query($conn,$query);

	}



}

redirect($url = 'admin/?page=products');

}




?>
