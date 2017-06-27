<html>
<body>
<label> Login </label>
<?php
					require_once('rb.php');
					R::setup("mysql:host=localhost:3306;dbname=gurujan","root","password");
						$all_user=R::findAll('user', ' ORDER BY login');
						echo "<select name='id'>";
						foreach ($all_user as $each_user) {

									  unset($id, $name);
									  $id = $each_user->login;
									  $name = $each_user->password;
									  echo '<option value="'.$name.'">'.$id.'</option>';

						}
						echo "</select>";
?>
</body>
<label>$name</label>
</html>

