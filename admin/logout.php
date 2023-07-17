<?php

session_start();
unset($_SESSION["username"]);
unset($_SESSION["level"]);
// redirect

      header("Location:form_login.php");
      exit();

?>