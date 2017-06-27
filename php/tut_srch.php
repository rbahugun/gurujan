<?php
    header("Content-Type: application/json; charset=utf-8");
	$f = fopen("file.txt", "a");
	fwrite($f, "Inside Tut Reg\n");

	$srch_res="";

	require_once('rb.php');
	R::setup("mysql:host=localhost:3306;dbname=gurujan","root","password");
	R::debug(0);
	fwrite($f, "Connected in Reg\n");
//	if (isset($_POST["tut_srch_name"]) or isset($_POST["tut_subj"]) or isset($_POST["tut_area"]) or isset($_POST["tut_city"]) ) {
	if (isset($_POST["tut_subj"]) or isset($_POST["tut_state"]) or isset($_POST["tut_city"]) ) {

		fwrite($f, "Contact Set to: ");
		/* Getting Form Data Variables */
//		$tut_srch_name = isset($_POST['tut_srch_name'])?$_POST['tut_srch_name']:null;
		$tut_subj = isset($_POST['tut_subj'])?$_POST['tut_subj']:null;
		$tut_state = isset($_POST['tut_state'])?$_POST['tut_state']:null;
		$tut_city = isset($_POST['tut_city'])?$_POST['tut_city']:null;
//		fwrite($f, "Finding: $tut_srch_name, $tut_subj, $tut_area, $tut_city");
		fwrite($f, "Finding: $tut_subj, $tut_state, $tut_city");

		/* Search SQL*/
		$all_tuts=R::findAll('tutreg', "tut_subj_id like ? and tut_state_id like ? and tut_city like ? ", array("%$tut_subj%","%$tut_state%","%$tut_city%") );
//		$all_tuts=R::find('tutreg', "tut_reg_name like ? and tut_subj like ? and tut_area like ? and tut_city like ? ", array("%$tut_srch_name%", "%$tut_subj%","%$tut_area%","%$tut_city%") );
		//$all_tuts=R::$f->begin() ->select('id, tut_reg_name, tut_login_id')->from('tutreg')->where(' tut_reg_name = ? ')->put($tut_srch_name)-> and(' tut_login_id = ? ') ->put($tut_login_id)->get();

		$found = false;

		/* For creating the display table */
		foreach ($all_tuts as $all_tut){
			fwrite($f, "Search result is $all_tut->id \n");
			$found = true;
		}
		if($found){
				$srch_res ="Here are your search results: <div id='result'>";
				foreach( $all_tuts as $all_tutor){
				$srch_res = $srch_res. "<div > Name - {$all_tutor->tut_reg_name} Area - {$all_tutor->tut_state_id} </div>";
				}
				$srch_res = $srch_res."</div>";
				
				fwrite($f, "\n$srch_res\n");
				fwrite($f, "\n Search Results consolidated.");
								
				}
		else{
			fwrite($f, "\n No matching results found.");
			srch_res = "\n No matching results found.";
			}
	} else {
			fwrite($f, "\n Please provide a seletion criteria.");
			srch_res = "\n Please provide a seletion criteria."
	}
			
				$json = array( "isSuccess" => $found, "table" => $srch_res);
				echo json_encode($json, JSON_FORCE_OBJECT);
	fclose($f);  
	R::close();
	return false;
?>