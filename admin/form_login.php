<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login User</title>
<link rel="stylesheet" href="style/style_login.css" type="text/css"  />
</head>

<body>
<div class="LoginBody">
<form action="login.php" method="post" name="form_login" id="form_login">
	<div class="LoginHeader"><div class="teks">LOGIN USER</div></div>
    <div class="LoginLabel">username</div>
	<div class="LoginInput">
	  <label>
	    <input name="username" type="text" id="noBorder" size="" maxlength="90" />
      </label>
	</div>
    <div class="LoginLabel">password</div>
    <div class="LoginInput">
      <label>
        <input name="password" type="password" id="noBorder" size="" maxlength="90" />
      </label>
    </div>
    
       <div class="tempatBtn"><input type="submit" name="login" id="btnLogin" value="login" /></div>

</form>
</div>
</body>
</html>
