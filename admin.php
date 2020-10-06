<html>
<head>
<title> Log In - Bioskop Raya </title>
<link rel="shortcut icon" href="favicon.ico" />
<script language="javascript">
function validasi(form){
  if (form.id_user.value == ""){
    alert("Anda belum mengisikan Username.");
    form.id_user.focus();
    return (false);
  }
     
  if (form.password.value == ""){
    alert("Anda belum mengisikan Password.");
    form.password.focus();
    return (false);
  }

  if (form.kode.value == ""){
    alert("Anda belum mengisikan Security Code.");
    form.kode.focus();
    return (false);
  }
  return (true);
}
</script>

<link href="view/login.css" rel="stylesheet" type="text/css" />
</head>
<body OnLoad="document.login.username.focus();">
<div id="login">
	<h1>LOGIN ADMIN</h1>
		<div class="fieldContainer">
			<form name="login" action="cek_login.php" method="POST" onSubmit="return validasi(this)">
        <div class="formRow">
            <div class="field">
                <input type="text" name="id_user" id="id_user" placeholder=" username...">
				<input type="hidden" name="level" value='Admin'>
            </div>
        </div>
        <div class="formRow">     
            <div class="field">
                <input type="password" name="password" id="password" placeholder=" password...">
            </div>
        </div>
		</div>
		
	<div class="signupButton">
        <input type="submit" name="submit" id="submit" value="Login" />
    </div>
			</form>
			
</div>
	
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
