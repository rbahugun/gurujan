<?php
    header("Content-Type: application/json; charset=utf-8");
	$f = fopen("file.txt", "a");
	fwrite($f, "Inside LoginAction");


	require_once('rb.php');
	R::setup("mysql:host=localhost:3306;dbname=gurujan","root","password");
	R::debug(0);
	fwrite($f, "Connected in LoginAction");
	if (isset($_POST['login'])) {

		/* Getting Form Data Variables */
		$login = isset($_POST['login'])?$_POST['login']:null;
		$password = isset($_POST['password'])?$_POST['password']:null;

		/* Subject and Email Variables */
		fwrite($f, "Finding: $login, $password");
		$all_user=R::find('user', "login = ? and password = ?", array($login, $password) );
		$found = false;
		$table = " ";

		foreach ($all_user as $user){
			fwrite($f, "Login User is $user \n");
			$found = true;
		}
		if($found)
		{	fwrite($f, "\n Found : ");
			setcookie("CK_LOGINUSER", $login , time()+3600);		

			/* Getting data from DB */
			fwrite($f, "\nFinding for Account Details: $login\n");
			$acc_dets=R::find('acc_details', "login = ?", array($login) );
			$found = false;
			fwrite($f, "\nTest\n");
			$table= "Welcome <b>$login</b> </br></br><h3>Your Account Details<h3></br></br>";
			if($acc_dets)
			{
				
				/* For creating the display table */
				$table= $table . "<table class='hovertable'>";
				$table= $table . "<tr><th>ID</th><th>Login</th><th>Date Used</th><th>Service</th></tr>";
				foreach ($acc_dets as $acc_det){
					fwrite($f, "Account Details are $acc_det \n");
					$table= $table . "<tr><td>{$acc_det->id}</td><td>{$acc_det->login}</td><td>{$acc_det->date_used}</td><td>{$acc_det->service}</td></tr>";
					$found = true;
				}
				$table= $table . "</table>";
				fwrite($f, "\n Account Table done: ");
			}
		}else {
		$table= $table . "No records found";
		}
		
		/* JSON Row */
		$json = array( "isSuccess" => $found, "table" => $table);
			
		echo json_encode($json, JSON_FORCE_OBJECT);
			
		R::close();
		return false;
	}
	

	fwrite($f, "\n Failed. Please try again.");
	fclose($f);  

?>
