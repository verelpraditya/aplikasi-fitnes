<?php
class regex {
	function validEmail($email) {
		$pola="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$";
		if (!eregi($pola, $email)) {
			return false;
		}
		else {
			return true;
		}
	}
}
?>