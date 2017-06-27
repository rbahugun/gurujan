<?php
    header("Content-Type: application/json; charset=utf-8");
	$f = fopen("file.txt", "a");
	fwrite($f, "*********New Student Register******User Inside tut Reg");

	require_once('rb.php');
	R::setup("mysql:host=localhost:3306;dbname=gurujan","root","password");
	R::debug(0);
	$table = " ";
	$saved= false;
	
	fwrite($f, "\n Connected in Reg");
	if (isset($_POST['tut_reg_name'])) {

		fwrite($f, "\nContact Set to: ");
		$tut_reg = R::dispense('tutreg');
		$user = R::dispense('user');
		/* Getting Form Data Variables */
		$tut_reg_name = isset($_POST['tut_reg_name'])?$_POST['tut_reg_name']:null;
		$tut_reg_lname = isset($_POST['tut_reg_lname'])?$_POST['tut_reg_lname']:null;
		$tut_login_id = isset($_POST['tut_login_id'])?$_POST['tut_login_id']:null;
		$tut_qualification = isset($_POST['tut_qualification'])?$_POST['tut_qualification']:null;
		$tut_subj_id = isset($_POST['tut_subj'])?$_POST['tut_subj']:null;
		$tut_state_id = isset($_POST['tut_state'])?$_POST['tut_state']:null;
		$tut_city = isset($_POST['tut_city'])?$_POST['tut_city']:null;
		$tut_tools = isset($_POST['tut_tools'])?$_POST['tut_tools']:null;
		$tut_password = isset($_POST['tut_password'])?$_POST['tut_password']:null;
		$user_password = isset($_POST['tut_password'])?$_POST['tut_password']:null;
		$user_login_id = isset($_POST['stu_login_id'])?$_POST['stu_login_id']:null;
		$service_home = (isset($_POST['service_Home']) && $_POST['service_Home'] == 'true') ?true:false;
		$service_online = (isset($_POST['service_Online']) && $_POST['service_Online'] == 'true') ?true:false;
		$service_coaching = (isset($_POST['service_Coaching']) && $_POST['service_Coaching'] == 'true') ?true:false;		

		$user_type = "T";

		
		$tut_reg->tut_login_id = $tut_login_id;
		$tut_reg->tut_reg_name = $tut_reg_name;
		$tut_reg->tut_reg_lname = $tut_reg_lname;
		$tut_reg->tut_qualification = $tut_qualification;
		$tut_reg->tut_subj_id = $tut_subj_id;
		$tut_reg->tut_state_id = $tut_state_id;
		$tut_reg->tut_city = $tut_city;
		$tut_reg->tut_tools = $tut_tools;
		$tut_reg->online = $service_online;
		$tut_reg->home_tution = $service_home;
		$tut_reg->coaching_classes = $service_coaching;
		
		
		/* Login details will go in login user details table*/
		$user->login= $tut_login_id;
		$user->password= $tut_password;
		$user->user_type = $user_type;
		
		fwrite($f, "Contact Set to: $tut_reg");
		fwrite($f, "\n User Set to: $user");
		R::begin();
		try {
			$user_id = R::store($user);
			fwrite($f, "\nFinding: $user_id");

			fwrite($f, "\njust to check");
			$tut_reg_id = R::store($tut_reg);
			fwrite($f, "\nFinding: $tut_reg_id");
			
			$table = "Registered successfully";
			fwrite($f, "\n Tutor User Created successfully");
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