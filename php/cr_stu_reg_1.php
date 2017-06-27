<?php
    header("Content-Type: application/json; charset=utf-8");
	$f = fopen("file.txt", "a");
	fwrite($f, "\nInside stu Reg");


	require_once('rb.php');
	R::setup("mysql:host=localhost:3306;dbname=gurujan","root","password");
	R::debug(0);
	fwrite($f, "Connected in Reg");
	if (isset($_POST['stu_reg_name'])) {

		fwrite($f, "Contact Set to: ");
		$stu_reg = R::dispense('stureg');
		$user = R::dispense('user');
		/* Getting Form Data Variables */
		$stu_reg_name = isset($_POST['stu_reg_name'])?$_POST['stu_reg_name']:null;
		$stu_login_id = isset($_POST['stu_login_id'])?$_POST['stu_login_id']:null;
		$stu_password = isset($_POST['stu_password'])?$_POST['stu_password']:null;
		$stu_subj = isset($_POST['stu_subj'])?$_POST['stu_subj']:null;
		$stu_area = isset($_POST['stu_area'])?$_POST['stu_area']:null;
		$stu_city = isset($_POST['stu_city'])?$_POST['stu_city']:null;

		$stu_reg->login= $stu_login_id;
		$stu_reg->stu_reg_name = $stu_reg_name;
		$stu_reg->stu_subj = $stu_subj;
		$stu_reg->stu_area = $stu_area;
		$stu_reg->stu_city = $stu_city;
		
		/* Login details will go in login user details table*/
		$user->login= $stu_login_id;
		$user->password= $stu_password;
		$user->user_type = "S";
		
		fwrite($f, "Contact Set to: $stu_reg");
		$id = R::store($user);
		fwrite($f, "1");
		if ($user->id) 		
		{
		fwrite($f, "2");
			$id = R::store($stu_reg);
			fwrite($f, "3");
			if ($stu_reg->id) {
			fwrite($f, "4");
				fwrite($f, "\n Stored");
				$user_r = R::load('user',$id);
				fwrite($f, "5");
				$stu_reg_r = R::load('stureg',$id); 
				fwrite($f, "6");
				fwrite($f, "Finding: $stu_reg_r");
				$table = "Your Student Account Successfully created."; 
			}
			else { $table = " 1 Encountered error while creatig account. PLease try once again";
				echo "1 Encountered error while creatig account. PLease try once again";} 
		}	
		else { $table = "2 Encountered error while creatig account. PLease try once again";
		echo "2 Encountered error while creatig account. PLease try once again";} 
	
		echo "Creating JSON object";
		$json = array( "isSuccess" => $found, "table" => $table);
		echo json_encode($json, JSON_FORCE_OBJECT);
		R::close();		
		return false;
	}
	fwrite($f, "\n Failed. Please try again.");
	fclose($f);  
?>