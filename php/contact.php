<?php
    header("Content-Type: application/json; charset=utf-8");

	$f = fopen("file.txt", "a");

	require_once('rb.php');
	R::setup("mysql:host=localhost:3306;dbname=gurujan","root","password");

	fwrite($f, "connected");
	if (isset($_POST['name'])) {
		fwrite($f, "Checking variables");

		/* Getting Form Data Variables */
		$name = isset($_POST['name'])?$_POST['name']:null;
		$email = isset($_POST['email'])?$_POST['email']:null;
		$message = isset($_POST['message'])?$_POST['message']:null;

		// Validate
	 /*   $failures = array();
		if (strlen($name)) $failures[] = "Name is required";
		if (strlen($email)) $failures[] = "Email is required";
		if (filter_var($email,FILTER_VALIDATE_EMAIL) === false) $failures[] = "Email is invalid";
		if (strlen($message)) $failures[] = "Message is required";
	*/
		// If validation errors, render them

		/* Subject and Email Variables */
			$contact = R::dispense('contactform');
			$contact->name = $name;
			$contact->email = $email;
			$contact->message = $message;
			fwrite($f, "Contact Set to: $contact");
			$id = R::store($contact);
			
			fwrite($f, "\n Stored");
			$contactform = R::load('contactform',$id);    
			R::close();

			fwrite($f, "\n Retrieved: CONTACT: $contactform");
			echo '<div id="contact_formsuccess">Form Submitted successfully. We will get back to you soon!</div>';
			return ;
		}

		fwrite($f, "\n Failed. Please try again.");
	fclose($f);  

?>
