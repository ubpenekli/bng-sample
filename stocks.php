<?php
// required simplest function file for the app. we don't have to explore america again :)
try {
	require_once("function.php");
}
catch(Exception $e) {
	$_status = 204;
	$rt = array(
		"code" => 50,
		"msg" => "Missing Files Error. Please contact with your system administrator."
	);
}
/*database connection start*/
try {
	$db = new PDO("mysql:host=localhost;dbname=ubpenekli_bng","ubpenekli_bng","._v60iNN]P&L");
	$db->query("SET CHARACTER SET utf8");
}
catch(PDOException $e) {
	$_status = 204;
	$rt['code'] = 51;
	$rt['msg'] = "Database Connection Error. Please contact with your system administrator.";
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
		$rt['code'] = 52;
		$rt['msg'] = "Database Action Error. Please contact with your system administrator.";
	}
}
elseif($_request == "POST") {
	$product_id = intval($_POST['product_id']);
	$name = trim(addslashes($_POST['name']));
	$stock = intval($_POST['stock']);
	$created_date = $_POST['created_date'];
	if( empty(preg_match("/^[0-9]*$/",$_POST['product_id'])) ) {
		$_status = 400;
		$rt['code'] = 41;
		$rt['msg'] = "'product_id' value is required and must be integer.";
		$rt['product_id'] = $product_id;
		$rt['product_id_p'] = $_POST['product_id'];
	}
	elseif(empty($name)) {
		$_status = 400;
		$rt['code'] = 42;
		$rt['msg'] = "'name' value is required.";
	}
	elseif( empty(preg_match("/^[0-9]*$/",$_POST['stock'])) ) {
		$_status = 400;
		$rt['code'] = 43;
		$rt['msg'] = "'stock' value is required and must be integer.";
	}
	elseif( !is_datetime($created_date) ) {
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
			$rt['code'] = 53;
			$rt['msg'] = 'Database Action Error. Please contact with your system administrator.';
		}
	}
}
else {
	$_status = 400;
	$rt['code'] = 10;
	$rt['msg'] = "Your request type is not valid.";
}
SetHeader($_status);
echo json_encode($rt);
?>
