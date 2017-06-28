<!DOCTYPE html>

<html lang="en">

<head>
 <title>Login</title>

 <style type="text/css">
 @import url(https://fonts.googleapis.com/css?family=Roboto:300);

 .login-page {
   width: 360px;
   padding: 8% 0 0;
   margin: auto;
 }
 .form {
   position: relative;
   z-index: 1;
   background: #FFFFFF;
   max-width: 360px;
   margin: 0 auto 100px;
   padding: 45px;
   text-align: center;
   box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
 }
 .form input {
   font-family: "Roboto", sans-serif;
   outline: 0;
   background: #f2f2f2;
   width: 100%;
   border: 0;
   margin: 0 0 15px;
   padding: 15px;
   box-sizing: border-box;
   font-size: 14px;
 }
 .form button {
   font-family: "Roboto", sans-serif;
   text-transform: uppercase;
   outline: 0;
   background: #5A384B;
   width: 100%;
   border: 0;
   padding: 15px;
   color: #FFFFFF;
   font-size: 14px;
   -webkit-transition: all 0.3 ease;
   transition: all 0.3 ease;
   cursor: pointer;
 }
 .form button:hover,.form button:active,.form button:focus {
   background: #BD5D70;
 }
 .form .message {
   margin: 15px 0 0;
   color: #b3b3b3;
   font-size: 12px;
 }
 .form .message a {
   color: #4CAF50;
   text-decoration: none;
 }
 .form .register-form {
   display: none;
 }
 .container {
   position: relative;
   z-index: 1;
   max-width: 300px;
   margin: 0 auto;
 }
 .container:before, .container:after {
   content: "";
   display: block;
   clear: both;
 }
 .container .info {
   margin: 50px auto;
   text-align: center;
 }
 .container .info h1 {
   margin: 0 0 15px;
   padding: 0;
   font-size: 36px;
   font-weight: 300;
   color: #1a1a1a;
 }
 .container .info span {
   color: #4d4d4d;
   font-size: 12px;
 }
 .container .info span a {
   color: #000000;
   text-decoration: none;
 }
 .container .info span .fa {
   color: #EF3B3A;
 }
 body {
   background: #878787; /* fallback for old browsers */
   background: -webkit-linear-gradient(right, #878787, #532A3C);
   background: -moz-linear-gradient(right, #878787, #532A3C);
   background: -o-linear-gradient(right, #878787, #532A3C);
   background: linear-gradient(to left, #878787, #532A3C);
   font-family: "Roboto", sans-serif;
   -webkit-font-smoothing: antialiased;
   -moz-osx-font-smoothing: grayscale;
 }
    </style>

 <meta charset = "utf-8">
</head>

<body>
  <div class="login-page">
    <div class="form">
    </form>
    <p>
      <img src="../assets/img/icon.png" class="flex-center">
      <b>Mis Aves</b>
    </p>
      <br>
      <form action="checklogin.php" class="register-form" method="post">
        <input type="text" placeholder="rut" name="rut" />
        <input type="password" placeholder="password"  name="password"/>
        <input type="text" placeholder="rut" name="rut"/>
        <button>create</button>

      </form>
      <form action="checklogin.php" class="login-form"  method="post">
        <input type="text" placeholder="rut" name="rut"/>
        <input type="password" placeholder="password" name="password"/>
        <button>login</button>
      </form>
    </div>
  </div>
 </body>
<script>
$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
</script>

</html>
