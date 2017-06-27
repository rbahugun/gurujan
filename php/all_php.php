<?php
function Isauthenticated()
{
	if(isset($_COOKIE["CK_LOGINUSER"])) {
        echo $_COOKIE["first"];}
}
?>