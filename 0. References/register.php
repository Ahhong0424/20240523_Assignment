<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="utf-8">
        <title>Register|Tarc Badminton Club</title>
          <!-- Tab bar icons -->
  <link href="assets/img/Badminton-icon.png" rel="icon">
  <link href="assets/img/Badminton-icon.png" rel="apple-touch-icon">
<style>
body {
    font-family: "Raleway", sans-serif;
    background: url(assets/img/home-bg.jpg);
    background-size: cover;
}

* {
  box-sizing: border-box;
}

body {
    font-family: "Raleway", sans-serif;
    background: url(assets/img/login-bg.png)no-repeat ;
    background-size: cover;

}
.container {
  padding: 20px;
  background-color: white;
  border: 2px solid lightgrey;
  margin: 5% auto 15% auto; 
  width: 50%;
}
.title{
  color: #f82249;
  font-size: 30px;
  margin: 0;
  font-family: "Raleway", sans-serif;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
}
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: 1px solid lightgrey;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: white;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

.registerbtn {
  background-color: skyblue;
  color: whitesmoke;
  padding: 16px 20px;
  margin: 13px 0;
  border: lightblue;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
  font-size: 15px;
}

.registerbtn:hover {
  opacity: 1.5;
}

.resetbtn {
  background-color: lightcoral;
  color: whitesmoke;
  padding: 16px 20px;
  margin: 13px 0;
  border: lightblue;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
  font-size: 15px;
}

.resetbtn:hover {
  opacity: 1.5;
}

a {
  color: blue;
  font-size: 20px;
}

</style>
</head>
<body>

<form action="">
  <div class="container">
    <h1 class="title">TARC BADMINTON Club</h1>
    <h1>Account Registration</h1>
    <p>Please fill in this form to create your own account.</p>
    <hr>

    <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter Name" name="name" id="name" required>

    <label for="studentID"><b>StudentID</b></label>
    <input type="text" placeholder="Enter your student ID" name="studentID" id="StudentID" required>
    
    <b>Gender</b><br>
    <input type="radio" name="gender" value="M" id="male" checked="checked" />
    <label for="male">Male</label>
    
    <input type="radio" name="gender" value="F" id="female" style="margin-left:100px;"/>
    <label for="female">Female</label><br><br>
    
     <label for="tel"><b>Phone number</b></label>
    <input type="text" placeholder="Enter phone number" name="tel" id="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required>
    
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="programme"><b>Program Study</b></label><br>
    <select name="programme" id="programme" >
      <option value="null">---choose your program---</option>
      <option value="foas">FOAS</option>
      <option value="focs">FOCS</option>
      <option value="fafb">FAFB</option>
      <option value="fobe">FOBE</option>
      <option value="foet">FOET</option>
      <option value="fcci">FCCI</option>
      <option value="fssh">FSSH</option>
      <option value="cpus">CPUS</option> <!-- use php array loop option-->
    </select>
    <br>
    <br>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

    <label for="psw-confirm"><b>Confirm Password</b></label>
    <input type="password" placeholder="Confirm Password" name="psw-confirm" id="psw-confirm" required>
    <hr>
    
    <button type="submit" class="registerbtn">Register</button>
    <button type="reset" class="resetbtn">Reset</button>

    <p>Already have an account?  <?php  echo"<a href='login.php?user=member' >Login</a>";?>.</p>
   
  </div>

</form>
</body>
</html>

