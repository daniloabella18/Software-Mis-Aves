<!DOCTYPE html>

<html lang="en">

<head>
 <title>Login</title>

 <meta charset = "utf-8">
</head>

<body>

<h1>Login de Usuarios</h1>
<hr />

<form action="checklogin.php" method="post" >

<label>Nombre Usuario:</label><br>
<input name="rut" type="text" id="rut" required>
<br><br>

<label>Password:</label><br>
<input name="password" type="password" id="password" required>
<br><br>

<input type="submit" name="Submit" value="LOGIN">

</form>
<hr />

 </body>
</html>
