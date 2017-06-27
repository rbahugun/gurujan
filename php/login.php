<?php
    header("Content-Type: application/json; charset=utf-8");
	$f = fopen("file.txt", "a");
	fwrite($f, "Inside login");


	require_once('rb.php');
	R::setup("mysql:host=localhost:3306;dbname=gurujan","root","password");
	R::debug(0);
	fwrite($f, "Connected in login");
	
	if (isset($_POST['login'])) {
		/* Getting Form Data Variables */
		$login = isset($_POST['login'])?$_POST['login']:null;
		$password = isset($_POST['password'])?$_POST['password']:null;

		/* Subject and Email Variables */
		fwrite($f, "Finding: $login, $password");
		$found = false;		$table = ''; 	$user_type =''; 	$user_name ='';

		try {
			$user=R::findOne('user',' login = ? and password = ? ',array($login, $password));
			if (!$user)	{ fwrite($f, "\nLogin password Not Found"); throw new Exception('Login password Not Found');} 
			else
			{	fwrite($f, "\nUser Found , Type : $user->user_type"); $found =true;
				switch ($user->user_type) {
				case 'T': fwrite($f, "\nInside Switch T"); $userdet=R::findOne('tutreg',' tut_login_id = ? ', array($login)); break;
				case 'S': fwrite($f, "\nInside Switch S"); $userdet=R::findOne('stureg',' stu_login_id = ? ', array($login)); break;
				case 'A': fwrite($f, "\nInside Switch T"); $userdet=R::findOne('tutreg',' tut_login_id = ? ', array($login)); break;
				default : fwrite($f, "\nInside Switch Default"); throw new Exception('User Details not found'); break; } 

				if(!$userdet)	{ fwrite($f, "User Name is  $user_name, $user_type not found"); throw new Exception('User Name not found');}
				else {
					switch ($user->user_type) {
						case 'T': fwrite($f, "\nInside Switch T"); $user_name = $userdet->tut_reg_name; $user_type = "T"; break;
						case 'S': fwrite($f, "\nInside Switch S"); $user_name = $userdet->stu_reg_name; $user_type = "S"; break;
						case 'A': fwrite($f, "\nInside Switch T"); $user_name = $userdet->tut_reg_name; $user_type = "T"; break;
						default : fwrite($f, "\nInside Switch Default"); throw new Exception('User Details not found'); break; } 
				}
			}
		
			
				
			if($found)
			{	fwrite($f, "\n Found : ");
				setcookie("CK_LOGINUSER", $login , time()+3600);		

				/* Getting data from DB */
				fwrite($f, "\nFinding for Account Details: $login\n");
				$acc_dets=R::find('acc_details', ' login = ? ', array($login) );

				if($acc_dets)
				{
					$table= "Welcome Dear <b>$user_name</b> <br/><br/><h3>Your Account Details</h3><br/><br/>";
					/* For creating the display table */
					$table= $table . "<table class='hovertable'>";
					$table= $table . "<tr><th>ID</th><th>Login</th><th>Date Used</th><th>Service</th></tr>";
					foreach ($acc_dets as $acc_det){
						fwrite($f, "Account Details is $acc_det \n");
						$table= $table . "<tr><td>{$acc_det->id}</td><td>{$acc_det->login}</td><td>{$acc_det->date_used}</td><td>{$acc_det->service}</td></tr>";
					}
					$table= $table . "</table>";} else {$table="Welcome Dear <b>$user_name</b> <br/>Account Details not found"; }
			}
			fwrite($f, "\n Found : $found");	fwrite($f, "User Name : $user_name");	fwrite($f, "user_type : $user_type"); fwrite($f, " table : $table");
			/* JSON Row */
		}catch(Exception $pe){ $table = $pe->getMessage(); $user_name = 'guest'; $user_type = 'G';}

		$json = array( "isSuccess" => $found, "loginid" => $login, "user_type" => $user_type, "table" => $table);
		echo json_encode($json, JSON_FORCE_OBJECT);
	}

	fclose($f);  
	R::close();
	return false;
?>
