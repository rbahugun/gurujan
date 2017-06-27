<?php
    header("Content-Type: application/json; charset=utf-8");
	$f = fopen("file.txt", "a");
	fwrite($f, "Inside stu Reg\n");

	$srch_res="";

	require_once('rb.php');
	R::setup("mysql:host=localhost:3306;dbname=gurujan","root","password");
	R::debug(0);
	fwrite($f, "Connected in Reg\n");
	if (isset($_POST["stu_srch_name"]) or isset($_POST["stu_subj"]) or isset($_POST["stu_area"]) or isset($_POST["stu_city"]) ) {

		fwrite($f, "Contact Set to: ");
		/* Getting Form Data Variables */
		$stu_srch_name = isset($_POST['stu_srch_name'])?$_POST['stu_srch_name']:null;
		$stu_subj = isset($_POST['stu_subj'])?$_POST['stu_subj']:null;
		$stu_area = isset($_POST['stu_area'])?$_POST['stu_area']:null;
		$stu_city = isset($_POST['stu_city'])?$_POST['stu_city']:null;
		fwrite($f, "Finding: $stu_srch_name, $stu_subj, $stu_area, $stu_city");

		/* Search SQL*/
		$all_stus=R::find('stureg', "stu_reg_name like ? and stu_subj like ? and stu_area like ? and stu_city like ? ", array("%$stu_srch_name%", "%$stu_subj%","%$stu_area%","%$stu_city%") );
		//$all_stus=R::$f->begin() ->select('id, stu_reg_name, stu_login_id')->from('stureg')->where(' stu_reg_name = ? ')->put($stu_srch_name)-> and(' stu_login_id = ? ') ->put($stu_login_id)->get();

		$found = false;

		/* For creating the display table */
		foreach ($all_stus as $all_stu){
			fwrite($f, "Search result is $all_stu->id \n");
			$found = true;
		}
		if($found){
				$srch_res ="<p>Here are your search results: <div id='result'>";
				foreach( $all_stus as $all_stu){
				$srch_res = $srch_res. "<div> Name - {$all_stu->stu_reg_name} Area - {$all_stu->stu_area} </div>";
				}
				$srch_res = $srch_res."</div>";
				$srch_res = $srch_res."</p>";
				
				fwrite($f, "\n$srch_res\n");
				fwrite($f, "\n Search Results consolidated.");
								
				$json = array( "isSuccess" => $found, "table" => $srch_res);
				echo json_encode($json, JSON_FORCE_OBJECT);
				R::close();
				return false;
				}
		else{
			fwrite($f, "\n No matching results found.");
			}
	}
	fwrite($f, "\n Failed. Please try again.");
	fclose($f);  
?>