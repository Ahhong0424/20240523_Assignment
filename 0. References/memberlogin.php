<!DOCTYPE html>
<?php 

session_start();


require_once "./assets/includes/yqhelper.php";

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Login|Tarc Badminton Club</title>
  <!-- Tab bar icons -->
  <link href="assets/img/Badminton-icon.png" rel="icon">
  <link href="assets/img/Badminton-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script>
      // clear form resubmission error 
      if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
      }
</script>
<style>

body {
    font-family: "Raleway", sans-serif;
    background: url(assets/img/login-bg.png)no-repeat ;
    background-size: cover;

}


#loginbox {
  padding: 40px;
  background-color: white;
  border: 2px solid lightgrey;
  margin: 10% auto 10% auto; 
  width: 40%;

}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 13px 0;    
  display: inline-block;
  border: 1px solid lightgrey;
  background: #f1f1f1;
  box-sizing: border-box;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: white;
  outline: none;
}

button {
  background-color: skyblue;
  color: whitesmoke;
  padding: 12px 21px;
  margin: 13px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
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

.img-container {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.badminton {
  width: 20%;
  border-radius: 25%;
}

.login-container {
  padding: 12px;
  width: 100%;
}

.box{
  border-radius: 5px;
  background-color: white;
  border: 2px solid lightgrey;
  padding: 50px;
  width: 70%;
  margin-left: 100px;
  margin-top: 50px;
}

span.pass {
  float: right;
  padding-top: 16px;
}

hr {
  border: 1px solid lightgray;
  margin-bottom: 25px;
}
</style>
</head>

<body>

<div id="loginbox" class="box">
<?php
 if(isset($_GET['eventid'])){
  echo '<script>alert("Please login to buy the ticket!")</script>';
 }
if(isset($_POST['login']))
{
$studentid = $_POST['studentid'];
$password = $_POST['password'];

if(empty($studentid) || empty($password)) //if he adminid and password field is blank
{
    printf("<div class='alert alert-danger' role='alert'>Please enter your student ID and password !</div>");
}
else
{
    $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $sql = "SELECT * FROM users WHERE studentid = ? AND password = ? ;";
    $studentid = $con->real_escape_string($studentid);
    $password = $con->real_escape_string($password);  
    $stmt = $con->prepare($sql);
    $stmt -> bind_param('ss', $studentid, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    

    if($row = $result->fetch_array(MYSQLI_ASSOC)) // use array 
    {
       
        $_SESSION['studentid'] = $row['studentid'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['name']=$row['name'];
         printf("<div class='alert alert-light' role='alert'>Login Successfully !</br>");
        header("location: home.php");
        
    }
    else
    {
      if(isStudentExist($studentid)==false){
        printf("<div class='alert alert-danger'>The studentID doesn't exist in the system</br>
        </div>");
      }if(isStudentExist($studentid)==true&&isPasswordreal($password)==false){
        printf("<div class='alert alert-danger'>Wrong Password please keyin again !</br>
        </div>");
      }
        
    }
            
}
}
?>  


 <h1 style='text-align: center;'>MEMBER LOGIN</h1>
  
  
<h1 class="title" style='text-align: center;'>TARC BADMINTON Club</h1>
<br>
<br>
  <form class="box-content animate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

 
    <div class="login-container">
      <label for="adminid"><b>User ID</b></label>
      <input type="text" placeholder="Enter Student ID" name="studentid" value="<?php echo empty(@$_POST['studentid'])?"":$studentid; ?>" >

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" value="<?php echo empty(@$_POST['password'])?"":$password; ?>" >
        
      <button type="submit" name="login">Login</button>

      <hr>
      <label>
        <input type="checkbox" name="remember" checked="checked"/> Remember me
      </label>
      <hr>
      <span class="pass"><a href="register.php">Didn't have an account ?</a></span>

    </div>
  </form>
</body>
</html>
