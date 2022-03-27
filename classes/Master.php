<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function save_category(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `finance_company_list` set {$data} ";
		}else{
			$sql = "UPDATE `finance_company_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `finance_company_list` where `name`='{$name}' ".($id > 0 ? " and id != '{$id}'" : ""))->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Finance Company Name Already Exists.";
		}else{
			$save = $this->conn->query($sql);
			if($save){
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = "Finance Company details was successfully added.";
				else
					$resp['msg'] = "Finance Company details was successfully updated.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	
	function delete_category(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `finance_company_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Finance Company has successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}

	function save_employee(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `employee_list` set {$data} ";
		}else{
			$sql = "UPDATE `employee_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `employee_list` where `fname`='{$fname}' ".($id > 0 ? " and id != '{$id}'" : ""))->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Employee Name Already Exists.";
		}else{
			$save = $this->conn->query($sql);
			if($save){
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = "was successfully added.";
				else
					$resp['msg'] = "was successfully updated.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}

	function delete_employee(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `employee_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}

	function save_branch(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `branch_list` set {$data} ";
		}else{
			$sql = "UPDATE `branch_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `branch_list` where `name`='{$name}' ".($id > 0 ? " and id != '{$id}'" : ""))->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Branch Name Already Exists.";
		}else{
			$save = $this->conn->query($sql);
			if($save){
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = "Branch details was successfully added.";
				else
					$resp['msg'] = "Branch details was successfully updated.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	
	function delete_branch(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `branch_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Branch has successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}


	function save_brand(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `brand_list` set {$data} ";
		}else{
			$sql = "UPDATE `brand_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `brand_list` where `name`='{$name}' ".($id > 0 ? " and id != '{$id}'" : ""))->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Brand Name Already Exists.";
		}else{
			$save = $this->conn->query($sql);
			if($save){
				$bid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = "Brand details was successfully added.";
				else
					$resp['msg'] = "Brand details was successfully updated.";
				if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
					$fname = 'uploads/brands/brand-'.$bid.'.png';
					$dir_path =base_app. $fname;
					$upload = $_FILES['img']['tmp_name'];
					$type = mime_content_type($upload);
					$allowed = array('image/png','image/jpeg');
					if(!in_array($type,$allowed)){
						$resp['msg'].=" But Image failed to upload due to invalid file type.";
					}else{
						$new_height = 200; 
						$new_width = 250; 
				
						list($width, $height) = getimagesize($upload);
						$t_image = imagecreatetruecolor($new_width, $new_height);
						imagealphablending( $t_image, false );
						imagesavealpha( $t_image, true );
						$gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
						imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
						if($gdImg){
								if(is_file($dir_path))
								unlink($dir_path);
								$uploaded_img = imagepng($t_image,$dir_path);
								imagedestroy($gdImg);
								imagedestroy($t_image);
						}else{
						$resp['msg'].=" But Image failed to upload due to unkown reason.";
						}
					}
					if(isset($uploaded_img)){
						$this->conn->query("UPDATE brand_list set `image_path` = CONCAT('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$bid}' ");
					}
				}
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_brand(){
		extract($_POST);
		$get = $this->conn->query("SELECT * FROM `brand_list` where id = '{$id}'");
		$del = $this->conn->query("DELETE FROM `brand_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Brand has successfully deleted.");
			if($get->num_rows>0){
				$res = $get->fetch_array();
				$res['image_path'] = explode('?',$res['image_path'])[0];
				if(is_file(base_app.$res['image_path']))
					unlink(base_app.$res['image_path']);
			}
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function save_type(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `type_list` set {$data} ";
		}else{
			$sql = "UPDATE `type_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `type_list` where `name`='{$name}' ".($id > 0 ? " and id != '{$id}'" : ""))->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Type Name Already Exists.";
		}else{
			$save = $this->conn->query($sql);
			if($save){
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = "Type was successfully added.";
				else
					$resp['msg'] = "Type was successfully updated.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	
	function delete_type(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `type_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Type has successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}

	function save_feature(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `feature_list` set {$data} ";
		}else{
			$sql = "UPDATE `feature_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `feature_list` where `name`='{$name}' ".($id > 0 ? " and id != '{$id}'" : ""))->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Feature Already Exists.";
		}else{
			$save = $this->conn->query($sql);
			if($save){
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = "Feature was successfully added.";
				else
					$resp['msg'] = "Feature was successfully updated.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	
	function delete_feature(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `feature_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Feature has successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}

	function save_valuation(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `valuation_list` set {$data} ";
		}else{
			$sql = "UPDATE `valuation_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `valuation_list` where `name`='{$name}' ".($id > 0 ? " and id != '{$id}'" : ""))->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Valuation Company Name Already Exists.";
		}else{
			$save = $this->conn->query($sql);
			if($save){
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = "Valuation Company details was successfully added.";
				else
					$resp['msg'] = "Valuation Company details was successfully updated.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}

	function delete_valuation(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `valuation_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Valuation Company has successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_inquiry(){
		$_POST['status'] = 1;
		$_POST['name'] = htmlentities($_POST['name']);
		$_POST['address'] = htmlentities($_POST['address']);
		$_POST['email'] = htmlentities($_POST['email']);
		$_POST['contactno'] = htmlentities($_POST['contactno']);
		$_POST['attractionperson'] = htmlentities($_POST['attractionperson']);
		$_POST['paymentcollectionperson'] = htmlentities($_POST['paymentcollectionperson']);
		$_POST['uid'] = htmlentities($_POST['uid']);
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
				$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `inquery_list` set {$data} ";
		}else{
			$sql = "UPDATE `inquery_list` set {$data} where id = '{$id}' ";
		}
		
		$save = $this->conn->query($sql);
		if($save){
			$cid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['id'] = $cid;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "Product was successfully added.";
			else
				$resp['msg'] = "Product was successfully updated.";
				// if(isset($_FILES['banner']) && $_FILES['banner']['tmp_name'] != ''){
				// 	$fname = 'uploads/banners/car-'.$cid.'.png';
				// 	$dir_path =base_app. $fname;
				// 	$upload = $_FILES['banner']['tmp_name'];
				// 	$type = mime_content_type($upload);
				// 	$allowed = array('image/png','image/jpeg');
				// 	if(!in_array($type,$allowed)){
				// 		$resp['msg'].=" But Image failed to upload due to invalid file type.";
				// 	}else{
				// 		$new_height = 450; 
				// 		$new_width = 800; 
				
				// 		list($width, $height) = getimagesize($upload);
				// 		$t_image = imagecreatetruecolor($new_width, $new_height);
				// 		imagealphablending( $t_image, false );
				// 		imagesavealpha( $t_image, true );
				// 		$gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
				// 		imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				// 		if($gdImg){
				// 				if(is_file($dir_path))
				// 				unlink($dir_path);
				// 				$uploaded_img = imagepng($t_image,$dir_path);
				// 				imagedestroy($gdImg);
				// 				imagedestroy($t_image);
				// 		}else{
				// 		$resp['msg'].=" But Image failed to upload due to unkown reason.";
				// 		}
				// 	}
				}
				// if(isset($_FILES['images']) && count($_FILES['images']['tmp_name']) > 0){
				// 	foreach($_FILES['images']['tmp_name'] as $k => $v){
				// 		if(!empty($_FILES['images']['tmp_name'][$k])){
				// 			if(!is_dir(base_app."uploads/cars/{$cid}"))
				// 				mkdir(base_app."uploads/cars/{$cid}");
				// 			$fname = "uploads/cars/{$cid}/car-".$cid.'_'.(time()).'.png';
				// 			$dir_path =base_app. $fname;
				// 			$i= 1;
				// 			while(true){
				// 				if(!is_file($dir_path)){
				// 					break;
				// 				}else{
				// 					$fname = "uploads/cars/{$cid}/car-".$cid.'_'.(time()).'_'.$i.'.png';
				// 					$dir_path =base_app. $fname;
				// 					$i++;
				// 				}
				// 			}
				// 			$upload = $_FILES['images']['tmp_name'][$k];
				// 			$type = mime_content_type($upload);
				// 			$allowed = array('image/png','image/jpeg');
				// 			if(!in_array($type,$allowed)){
				// 				$resp['msg'].=" But Image failed to upload due to invalid file type.";
				// 			}else{
				// 				$new_height = 450; 
				// 				$new_width = 800; 
						
				// 				list($width, $height) = getimagesize($upload);
				// 				$t_image = imagecreatetruecolor($new_width, $new_height);
				// 				imagealphablending( $t_image, false );
				// 				imagesavealpha( $t_image, true );
				// 				$gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
				// 				imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				// 				if($gdImg){
				// 						if(is_file($dir_path))
				// 						unlink($dir_path);
				// 						$uploaded_img = imagepng($t_image,$dir_path);
				// 						imagedestroy($gdImg);
				// 						imagedestroy($t_image);
				// 				}else{
				// 				$resp['msg'].=" But Image failed to upload due to unkown reason.";
				// 				}
				// 			}
				// 		}
				// 	}
				// }
		// }else{
		// 	$resp['status'] = 'failed';
		// 	$resp['msg'] = "An error occured.";
		// 	$resp['err'] = $this->conn->error."[{$sql}]";
		// }
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_inquery(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `inquery_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Inquery has successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	
	public function read_inquiry(){
		extract($_POST);
		$update = $this->conn->query("UPDATE `inquiry_list` set `status` = 1 where id = $id");
		if($update){
			$this->settings->set_flashdata('success','inquiry has successfully verified.');
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
		}
		return json_encode($resp);
	}

	function save_payment(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `payment_status` set {$data} ";
		}else{
			$sql = "UPDATE `payment_status` set {$data} where id = '{$id}' ";
		}
		
			$save = $this->conn->query($sql);
			if($save){
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = "was successfully added.";
				else
					$resp['msg'] = "was successfully updated.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
	
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}

	function save_images(){
		$_POST['status'] = isset($_POST['status']) && $_POST['status'] == 'on' ? 1 : 0;
		// $_POST['img'] = htmlentities($_POST['img']);
		// $_POST['address'] = htmlentities($_POST['address']);
		// $_POST['email'] = htmlentities($_POST['email']);
		// $_POST['contactno'] = htmlentities($_POST['contactno']);
		// $_POST['attractionperson'] = htmlentities($_POST['attractionperson']);
		// $_POST['paymentcollectionperson'] = htmlentities($_POST['paymentcollectionperson']);
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
				$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `images` set {$data} ";
		}else{
			$sql = "UPDATE `images` set {$data} where id = '{$id}' ";
		}

			if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = 'uploads/avatar-'.$id.'.png';
			$dir_path =base_app. $fname;
			$upload = $_FILES['img']['tmp_name'];
			$type = mime_content_type($upload);
			$allowed = array('image/png','image/jpeg');
			if(!in_array($type,$allowed)){
				$resp['msg'].=" But Image failed to upload due to invalid file type.";
			}else{
				$new_height = 200; 
				$new_width = 200; 
		
				list($width, $height) = getimagesize($upload);
				$t_image = imagecreatetruecolor($new_width, $new_height);
				imagealphablending( $t_image, false );
				imagesavealpha( $t_image, true );
				$gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
				imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				if($gdImg){
						if(is_file($dir_path))
						unlink($dir_path);
						$uploaded_img = imagepng($t_image,$dir_path);
						imagedestroy($gdImg);
						imagedestroy($t_image);
				}else{
				$resp['msg'].=" But Image failed to upload due to unkown reason.";
				}
			}
			if(isset($uploaded_img)){
				$this->conn->query("UPDATE users set `avatar` = CONCAT('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$id}' ");
				if($id == $this->settings->userdata('id')){
						$this->settings->set_userdata('avatar',$fname);
				}
			}
		}
		if(isset($resp['msg']))
		$this->settings->set_flashdata('success',$resp['msg']);
		return  $resp['status'];
		
		
	}


	function add_fea(){

		$checkBox = implode(',', $_POST['name']);
			// $query="INSERT INTO add_feature (name) VALUES ('".$checkBox."')";     
		
			// $save = $this->conn->query($query);
		
			// echo "Complete";
	}		


	function payment_check(){

		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
				$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}

			$sql = "UPDATE `payment_status` set {$data} where uid = '{$uid}' ";

			$save = $this->conn->query($sql);
			if($save){
				$resp['status'] = 'success';
					$resp['msg'] = "successfully updated.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
	
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);


		}




		// if(empty($id)){
		// 	$sql = "INSERT INTO `add_feature` set {$data} ";
		// }else{
		// 	$sql = "UPDATE `add_feature` set {$data} where id = '{$id}' ";
		// }
		// 	$save = $this->conn->query($sql);
		// 	if($save){
		// 		$rid = !empty($id) ? $id : $this->conn->insert_id;
		// 		$resp['status'] = 'success';
		// 		if(empty($id))
		// 			$resp['msg'] = "Feature was successfully added.";
		// 		else
		// 			$resp['msg'] = "Feature was successfully updated.";
		// 	}else{
		// 		$resp['status'] = 'failed';
		// 		$resp['msg'] = "An error occured.";
		// 		$resp['err'] = $this->conn->error."[{$sql}]";
		// 	}
		// if($resp['status'] =='success')
		// $this->settings->set_flashdata('success',$resp['msg']);
		// return json_encode($resp);


}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save_category':
		echo $Master->save_category();
	break;
	case 'delete_category':
		echo $Master->delete_category();
	break;
	case 'save_employee':
		echo $Master->save_employee();
	break;
	case 'delete_employee':
		echo $Master->delete_employee();
	break;
	case 'save_branch':
		echo $Master->save_branch();
	break;
	case 'delete_branch':
		echo $Master->delete_branch();
	break;
	case 'save_brand':
		echo $Master->save_brand();
	break;
	case 'delete_brand':
		echo $Master->delete_brand();
	break;
	case 'save_type':
		echo $Master->save_type();
	break;
	case 'delete_type':
		echo $Master->delete_type();
	break;
	case 'save_feature':
		echo $Master->save_feature();
	break;
	case 'delete_feature':
		echo $Master->delete_feature();
	break;
	case 'save_valuation':
		echo $Master->save_valuation();
	break;
	case 'delete_valuation':
		echo $Master->delete_valuation();
	break;
	case 'save_inquiry':
		echo $Master->save_inquiry();
	break;
	case 'delete_inquery':
		echo $Master->delete_inquery();
	break;
	case 'save_payment':
		echo $Master->save_payment();
	break;
	case 'save_images':
		echo $Master->save_images();
	break;
	case 'add_fea':
		echo $Master->add_fea();
	break;
	case 'payment_check':
		echo $Master->payment_check();
	break;
	// case 'delete_inquiry':
	// 	echo $Master->delete_inquiry();
	// break;
	// default:
	// case 'read_inquiry':
	// 	echo $Master->read_inquiry();
	// break;
		// echo $sysset->index();
	
}