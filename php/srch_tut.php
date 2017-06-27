<?php
    header("Content-Type: application/json; charset=utf-8");
	$f = fopen("file.txt", "a");
	fwrite($f, "Inside Tut Reg\n");
//	fwrite($f, var_dump($_GET));

	require_once('rb.php');
	R::setup("mysql:host=localhost:3306;dbname=gurujan","root","password");
	R::debug(0);
	fwrite($f, "Connected in Reg");
	if (isset($_GET['tut_srch_name']) or isset($_GET['tut_subj']) or isset($_GET['tut_area']) or isset($_GET['tut_city'])) {

		fwrite($f, "Contact Set to: ");
		/* Getting Form Data Variables */
		
		$tut_srch_name = isset($_GET['tut_srch_name'])?$_GET['tut_srch_name']:null;
		$tut_subj = isset($_GET['tut_subj'])?$_GET['tut_subj']:null;
		$tut_area = isset($_GET['tut_area'])?$_GET['tut_area']:null;
		$tut_city = isset($_GET['tut_city'])?$_GET['tut_city']:null;
		fwrite($f, "Finding: $tut_srch_name, $tut_subj, $tut_area, $tut_city");

		/* Search SQL*/
		$all_tuts=R::find('tutreg', "tut_reg_name like ? and tut_subj like ? and tut_area like ? and tut_city like ? ", array("%$tut_srch_name%", "%$tut_subj%","%$tut_area%","%$tut_city%") );
		//$all_tuts=R::$f->begin() ->select('id, tut_reg_name, tut_login_id')->from('tutreg')->where(' tut_reg_name = ? ')->put($tut_srch_name)-> and(' tut_login_id = ? ') ->put($tut_login_id)->get();

		$found = false;

		/* For creating the display table */
		$srch_res = "\n";
		if ( isset($all_tuts)) {
			foreach ($all_tuts as $each_tut) {
				$srch_res = $srch_res."{$each_tut->tut_reg_name}\n";
				$srch_res = $srch_res."{$each_tut->tut_subj}\n";
				$srch_res = $srch_res."{$each_tut->tut_area}\n";
				$srch_res = $srch_res."{$each_tut->tut_city}</br>";
				fwrite($f, "Search result is {$each_tut->id}\n");
				}
		fwrite($f, "\n The response string is: $srch_res");
		}
		else{fwrite($f, "\n Found Decode:");}
		
		R::close();
		return false;
	} else{ fwrite($f, "\n No results found \n");
			$srch_res = "No matching results found. PLease chnage your search criteria.\n";}

	fwrite($f, "\n Failed. Please try again.");
	fclose($f);  

?>
