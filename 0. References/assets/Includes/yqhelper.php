
<?php
// Database connection detail 
// needed to link between php app to MYSQL 
// declare constant variable - hostname, username, password , dbname ; 
// involve sensitive cases so create in this page 

define("DB_HOST",'localhost'); // declare constant for host  
define("DB_USER",'root'); // declare constant user name
define("DB_PASS",''); // declare constant password
define("DB_NAME",'asm'); // declare constant sql name 


//establish database connection 建立与数据库的连接 
 $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);


 function isEventExist($studentID,$eventID){
    // flag
    $exist=false;
    //establish database connection 建立与数据库的连接 
    $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME); // SEQUENCE MUST SAME WITH CONSTANT AT TOP OF CODE 

    //real_escape_string prevent sql injection attack  prevent user keyin the sql key word(OR , AND , WHERE) ; real_escape_string change the key word to normal 
    $eventID=$con->real_escape_string($eventID);
    $sql = "SELECT * FROM cart WHERE eventID = '$eventID' AND studentID='$studentID'";
    //retreive record based on sql 
    if($result=$con->query($sql)){

        if($result->num_rows>0){// same PK founded
            $exist=true;
        }
    }
    $result->free();
    $con->close(); 
    return  $exist;
}

 function isCartExist($cartID){

    $exist=false;
    //establish database connection 建立与数据库的连接 
    $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME); 

   $cartID=$con->real_escape_string($cartID);
    $sql = "SELECT * FROM cart WHERE Cart = '$cartID'";

    if($result=$con->query($sql)){

        if($result->num_rows>0){// same PK founded
            $exist=true;
        }
    }
    $result->free();
    $con->close(); 
    return  $exist;
}

function isStudentExist($studentID){

    $exist=false;
    //establish database connection 建立与数据库的连接 
    $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME); 

   $cartID=$con->real_escape_string($studentID);
    $sql = "SELECT * FROM users WHERE studentID = '$studentID'";

    if($result=$con->query($sql)){

        if($result->num_rows>0){// same PK founded
            $exist=true;
        }
    }
    $result->free();
    $con->close(); 
    return  $exist;
}

function isPasswordreal($password){

    $exist=false;
    //establish database connection 建立与数据库的连接 
    $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME); 

   $cartID=$con->real_escape_string($password);
    $sql = "SELECT * FROM users WHERE password = '$password'";

    if($result=$con->query($sql)){

        if($result->num_rows>0){// same PK founded
            $exist=true;
        }
    }
    $result->free();
    $con->close(); 
    return  $exist;
}
?>