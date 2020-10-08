<?php
require_once("function.php"); // required simplest function file for the app. we don't have to explore america again :)
/*database connection start*/
try {
	$db = new PDO("mysql:host=localhost;dbname=bng","root","1");
	$db->query("SET CHARACTER SET utf8");
}
catch(PDOException $e) {
	$_status = 500;
	$rt['code'] = 50;
	$rt['msg'] = "System Error. Please contact with your system administrator.";
}
/*database connection end*/
$_request = $_SERVER['REQUEST_METHOD']; // get request method
// then check request method.
// if it's get, list the data
// if it's post, check and add the data
if($_request == "GET") {
	try {
		$list_data = $db->query("SELECT * FROM stocks ORDER BY created_date DESC")->fetchAll(PDO::FETCH_ASSOC);
		$_status = 200;
		$rt['code'] = 0;
		$rt['msg'] = "success";
		$rt['data'] = $list_data;
	}
	catch(PDOException $e) {
		$_status = 500;
		$rt['code'] = 51;
		$rt['msg'] = "System Error. Please contact with your system administrator.";
	}
}
elseif($_request == "POST") {
	$product_id = $_POST['product_id'];
	$name = trim(addslashes($_POST['name']));
	$stock = $_POST['stock'];
	$created_date = $_POST['created_date'];
	if(( (int)$product_id != $product_id ) || empty($product_id)) {
		$_status = 400;
		$rt['code'] = 41;
		$rt['msg'] = "'product_id' value is required and must be integer.";
	}
	elseif(empty($name)) {
		$_status = 400;
		$rt['code'] = 42;
		$rt['msg'] = "'name' value is required.";
	}
	elseif(( (int)$stock != $stock ) || empty($stock)) {
		$_status = 400;
		$rt['code'] = 43;
		$rt['msg'] = "'stock' value is required and must be integer.";
	}
	elseif(!is_datetime($created_date) || empty($created_date)) {
		$_status = 400;
		$rt['code'] = 44;
		$rt['msg'] = "'created_date' value is required and must be date.";
	}
	else {
		try {
			$check_exist = $db->query("SELECT * FROM stocks WHERE product_id=$product_id")->rowCount();
			if($check_exist == 0) {
				$add_data = array(
					"product_id" => $product_id,
					"name" => $name,
					"stock" => $stock,
					"created_date" => $created_date
				);
				$db
					->prepare("INSERT INTO stocks SET
						product_id=:product_id,
						name=:name, 
						stock=:stock, 
						created_date=:created_date")
					->execute($add_data);
				$_status = 201;
				$rt['code'] = 0;
				$rt['msg'] = 'success';
				$rt['data'] = $db
					->query("SELECT * FROM stocks WHERE product_id=$product_id")
					->fetch(PDO::FETCH_ASSOC);
			}
			else {
				$_status = 400;
				$rt['code'] = 40;
				$rt['msg'] = "'product_id' value must be unique and this row exists on database. $check_exist";
			}
		}
		catch(PDOException $e) {
			$_status = 500;
			$rt['code'] = 52;
			$rt['msg'] = 'System Error. Please contact with your system administrator.';
		}
	}
}
else {
	$_status = 400;
	$rt['code'] = 10;
	$rt['msg'] = "Your request is not valid.";
}
SetHeader($_status);
echo json_encode($rt);
?>
