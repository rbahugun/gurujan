<?php
					require_once('rb.php');
					R::setup("mysql:host=localhost:3306;dbname=gurujan","root","password");
						$all_states=R::findAll('state_ref', ' ORDER BY state');
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name='tut_state' id='tut_state' size='4'>";
						foreach ($all_states as $all_state) {
									  unset($id, $name);
									  $id = $all_state->id;
									  $name = $all_state->state;
									  echo '<option value="'.$id.'">'.$name.'</option>';
						}
						echo "</select>";
?>