<?php
    header("Content-Type: application/json; charset=utf-8");
	$f = fopen("file.txt", "a");
	fwrite($f, "*********New Student Register******User Inside stu Reg");

	require_once('rb.php');
	R::setup("mysql:host=localhost:3306;dbname=gurujan","root","password");
	R::debug(0);
	$table = " ";
	$saved= false;
	fwrite($f, "\n Connected in Reg");
	if (isset($_POST['stu_reg_name'])) {

		fwrite($f, "\nContact Set to: ");
		$stu_reg = R::dispense('stureg');
		$user = R::dispense('user');
		/* Getting Form Data Variables */
		$stu_reg_name = isset($_POST['stu_reg_name'])?$_POST['stu_reg_name']:null;
		$stu_reg_lname = isset($_POST['stu_reg_lname'])?$_POST['stu_reg_lname']:null;
		$stu_login_id = isset($_POST['stu_login_id'])?$_POST['stu_login_id']:null;
		$stu_subj = isset($_POST['stu_subj'])?$_POST['stu_subj']:null;
		$stu_state_id = isset($_POST['tut_state'])?$_POST['tut_state']:null;
		$stu_city = isset($_POST['stu_city'])?$_POST['stu_city']:null;
		$user_password = isset($_POST['stu_password'])?$_POST['stu_password']:null;
		$user_login_id = isset($_POST['stu_login_id'])?$_POST['stu_login_id']:null;
		$service_home = (isset($_POST['service_Home']) && $_POST['service_Home'] == 'true') ?true:false;
		$service_online = (isset($_POST['service_Online']) && $_POST['service_Online'] == 'true') ?true:false;
		$service_coaching = (isset($_POST['service_Coaching']) && $_POST['service_Coaching'] == 'true') ?true:false;		
		
		$user_type = "S";
		
		$stu_reg->login= $stu_login_id;
		$stu_reg->stu_reg_name = $stu_reg_name;
		$stu_reg->stu_reg_name = $stu_reg_lname;
		$stu_reg->stu_subj = $stu_subj;
		$stu_reg->stu_state_id = $stu_state_id;
		$stu_reg->stu_city = $stu_city;
		$stu_reg->online = $service_online;
		$stu_reg->home_tution = $service_home;
		$stu_reg->coaching_classes = $service_coaching;

		/* Login details will go in login user details table*/
		$user->login= $stu_login_id;
		$user->password= $user_password;
		$user->user_type = $user_type;

		fwrite($f, "\n Contact Set to: $stu_reg");
		fwrite($f, "\n User Set to: $user");
		
		R::begin();
		try{
				$user_id = R::store($user);
				fwrite($f, "\nFinding: $user_id");
			
				$stu_reg_id = R::store($stu_reg);
				fwrite($f, "\nFinding: $stu_reg_id");

				$table = "Registered successfully";
				fwrite($f, "\n Student User Created successfully");
				fwrite($f, $table);							
				$saved = true;
				R::commit();
		}
		catch(Exception $pe){
			//$errorcode = PDOStatement::errorCode();
				fwrite($f, $pe->getMessage());
				fwrite($f, $pe->getCode());
				$table = "Login id already in use. Please use another login id.";
				R::rollback();
		}
					/* JSON Row */
		$json = array( "isSuccess" => $saved, "table" => $table);
			
		echo json_encode($json, JSON_FORCE_OBJECT);
		R::close();
		return false;
	}
	fwrite($f, "\n Failed. Please try again.");
	fclose($f);
?>