<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $password = $_POST['password'];
  $emaillog = trim(filter_input(INPUT_POST, "emaillog", FILTER_SANITIZE_EMAIL));
  $passwordlog = trim(filter_input(INPUT_POST, "passwordlog", FILTER_SANITIZE_STRING));
  $name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
  $emailsign = trim(filter_input(INPUT_POST, "emailsign", FILTER_SANITIZE_EMAIL));

  if (isset( $_POST['submit1'] ) ){
    if($emaillog =="" || $passwordlog=="" ){
      echo "<script type='text/javascript'>alert('Please fill in required fields.');</script>";
    }
    $link = mysqli_connect("localhost", "root", "root", "users");
    //check if username exists
    $sql = "SELECT * FROM users WHERE email = '".$emaillog."' AND password ='".$passwordlog."'";
    $result = mysqli_query($link,$sql);
    if(mysqli_num_rows($result)>=1){
        echo "<script type='text/javascript'>alert('You have successfully loged in');</script>";
      } else {
        echo "<script type='text/javascript'>alert('Wrong email or password.');</script>";
      }
  } else if (isset( $_POST['submit2'] ) ){
    if($name =="" || $emailsign=="" || $passwordsign="" ){
      echo "<script type='text/javascript'>alert('Please fill in required fields.');</script>";

    }
    $link = mysqli_connect("localhost", "root", "root", "users");

    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // Attempt insert query execution
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$emailsign', '$password')";
    if(mysqli_query($link, $sql)){
        echo "Records inserted successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    // Close connection
    mysqli_close($link);
  }
}

?>


<html>
    <head>
        <link href="style.css" rel="stylesheet"/>
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
        <script src="jquery-1.10.2.min.js"></script>
        <script src="script.js"></script>

    </head>
    <body>
        <div id="box">
            <div id="main"><img id="bdfolds" src="images/bg_folds.png" alt="Background folds" align="left"></div>

            <div id="loginform">
			<form action="index.php" method="post" name="login">
                <h1>LOGIN<img src="images/logo.png" alt="Magebit logo" style="width:38px;height:28px;" align="right"></h1>
				<div id="underline"></div>
                <input id="loginemail" name="emaillog" type="email" placeholder="Email*"/><br>
                <input id="loginpass" name="passwordlog" type="password" placeholder="Password*"/><br>
                <input id="login_btnform" type="submit" name="submit1" value="LOGIN" style="width: 140px; height: 50px; margin-top: 30px;"/><p id="forgot">Forgot?</p>
            </div>

            <div id="signupform">
			<form action="index.php" method="post" name="reg">
                <h1>SIGN UP<img src="images/logo.png" alt="Magebit logo" style="width:38px;height:28px;" align="right"></h1>
				<div id="underline"></div>
                <input id="signupname" name="name" type="text" placeholder="Name*"/><br>
                <input id="signupemail" name="emailsign" type="email" placeholder="Email*"/><br>
                <input id="signuppass" name="password" type="password" placeholder="Password*"/><br>
                <input id="signup_btnform" type="submit" name="submit2" value="SIGN UP" style="width: 140px; height: 50px; margin-top: 30px;"/>
            </div>

            <div id="login_msg">Have an account?<div id="underline1"></div></div>
			      <div id="login_msg2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
            <div id="signup_msg">Don't have an account?<div id="underline1"></div>	</div>
            <div id="signup_msg2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
            <button id="login_btn">LOGIN</button>
            <button id="signup_btn">SIGN UP</button>

        </div>
    </body>
</html>
