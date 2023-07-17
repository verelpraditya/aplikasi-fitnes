<?php
class session {
	var $sessionName;
	var $sessionValue;
	function __construct() {
		session_start();
	}
	function reg($sesName, $sesValue) {
		session_register($sesName);
		$_SESSION[$sesName] = $sesValue;
	}
	function unreg($sesName) {
		session_unregister($sesName);
	}
	function read($sesName) {
		return $_SESSION[$sesName];		
	}
	function checkSes($sesName) {
		if (isset($_SESSION[$sesName])) {
			return true;
		}
		else {
			return false;
		}
	}
	function destroy() {
		session_destroy();
	}
}
?>
