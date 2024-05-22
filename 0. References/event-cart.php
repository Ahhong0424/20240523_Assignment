<?php session_start(); $this_page='Event'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Ticket Cart|Badminton Club</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
  <meta content="" name="description">
  <meta content="" name="keywords">

<!--====link====-->
<?php include('assets/Includes/link.php');
require_once('assets/Includes/yqhelper.php');
?>
<!--====End link====-->

 <link rel="stylesheet" href="assets/css/payment-form.css">
  <style>

#header {
background-color: #040919;
}     
.tbl-cart th {
  background-color: #E0E0E0;
}


.no-records {
	text-align: center;
	clear: both;
	margin: 38px 0px;
}
#btnEmpty {
	background-color: #ffffff;
	border: #d00000 1px solid;
	padding: 5px 10px;
	color: #d00000;
	float: right;
	text-decoration: none;
	border-radius: 3px;
	margin: 10px 0px;
}


.cart-item-image {
  	
  height: 70px;
  width: 160px;
  transition: all ease-in-out 0.3s;
  vertical-align: middle;
  box-sizing: border-box;
  overflow: hidden;
  border-radius: 50%;
  float: left;
  margin: 0 10px 10px 0;
}

div[role=alert]{
  text-align: center;
  margin: auto;
  width: 40%;
  border: 3px ;
  padding: 10px;
}

</style>
</head>

<body>

<!--====Header====-->

<?php include('assets/Includes/header.php');?>

<!--====End Header====-->
  
  <section id="event">
<!--====Side nav====-->

<?php include('assets/Includes/side-nav.php');?>

<!--====End side nav====-->

  <section id="schedule" class="section-with-bg">
      <div class="container" data-aos="">
        <div class="section-header">
          <h2>Your Cart Item</h2>
        </div>
        <div class="tab-content row justify-content-center" data-aos="" data-aos-delay="">

          <?php 
            if(@$_GET['eventid']){ // add to cart 
              $eventID=strtoupper(trim($_GET['eventid']));
              $studentID = @$_SESSION['studentid'];
              $quantity = 1; 
              $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);  
              $eventID = $con->real_escape_string($eventID);    

              $sql="INSERT INTO cart(Cart,Quantity,EventID,StudentID) VALUE (?,?,?,?)";

              $stmt = $con->prepare($sql);
              $stmt->bind_param('iiss',$con -> insert_id,$quantity,$eventID,$studentID);
       

                  // check whether the event already exist in cart
                if (isEventExist($studentID,$eventID)) { 
                      echo '<div class="alert alert-warning" role="alert">
                      Item Already Added into cart before.
                    </div>';
                  }else if (empty($studentID)){
                    echo '<script>alert("Please login to buy the ticket! ")</script>';
                  }
                  else{
                    // insert id 
                      if( $stmt->execute()){
                          echo '<div class="alert alert-success" role="alert">
                          The item is added into cart successfully.
                        </div>';
                     
                      }else{
                          echo '<div class="alert alert-danger" role="alert">
                          Database Error Please try agian!
                        </div>';
                      }
                  }
            }else if (isset($_POST['save'])) { # save-button was clicked 
            $arrquantity=array();
            $arrquantity = @$_POST['update'];
            $arrCart = @$_POST['cartID'];
      
            $con= new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
             //numberic validation 
            $valid = 1 ;
                if(!empty($arrquantity)){  // solve the uncaught type error 
                  
                for ($i=0; $i < count(@$arrquantity) ; $i++) {
                  // clear sql injection 
                $arrquantity[$i]=$con->real_escape_string($arrquantity[$i]);
                $arrCart[$i]=$con->real_escape_string($arrCart[$i]);
                  // validation
                if (!is_numeric($arrquantity[$i])||($arrquantity[$i]<1 || $arrquantity[$i]>10)) {
                        $valid = 0 ; 
                        break;
                }
                }
              }
        
              if($valid == 1){ // if number valid 
                  if(!empty($arrCart)){ // solve the uncaught type error 
                    for ($i=0; $i < count($arrCart); $i++) { 
                      $sql2 = "UPDATE Cart SET Quantity = '$arrquantity[$i]' WHERE Cart='$arrCart[$i]'";
                      if($result=$con->query($sql2)){
                        
                      }else{
                        echo'<div class="alert alert-danger" role="alert">
                        Unable to connect to the database.
                      </div>';
                      }              
                    }
                  }

                    echo'<div class="alert alert-success" role="alert">
                    Quantity updated successfully.
                  </div>';
              }else{
                  echo '<div class="alert alert-danger" role="alert">
                  Quantity must be a number and an account can buy 1 to 10 tickets only!!
                </div>';

              }


          }

          elseif (isset($_POST['cartDelete'])) { // delete single item
            $CartID = $_POST['cartDelete'];
            $eventID = $_POST['eventID'];
            $con= new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            //validation 
            $CartID=$con->real_escape_string($CartID);
            $sqldeletecart="DELETE FROM Cart WHERE Cart='$CartID';";
            if ($result=$con->query($sqldeletecart)) {
                echo"<div class='alert alert-warning' role='alert'>
                The event with code $eventID has been remove from cart.
              </div>";
            }
          }
            elseif (isset($_POST['empty'])) { // empty whole cart 
              $CartID = $_POST['empty'];
              $studentID = @$_SESSION['studentid'];
              $con= new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
              //validation 
              $CartID=$con->real_escape_string($CartID);
              $sqldeletecart="DELETE FROM Cart WHERE StudentID='$studentID';";
      
              if ($result=$con->query($sqldeletecart)) {
                  echo'<div class="alert alert-success" role="alert">
                  Your cart is empty now.
                </div>';
              }


          }

          ?> 


          <!-- Schdule-->
          <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
          <div role="tabpanel" class="col-lg-12" >
          <input type="submit" id="btnEmpty" name="empty" onclick="return confirm('Are you sure you want to empty the cart?')" value="Empty Cart">
        
          <br><br><br>       
          <table class="tbl-cart" cellpadding="10" cellspacing="1">
            <tbody>
            <tr>
              <th style="text-align:left;" width="15%">Event</th>
              <th style="text-align:left;" width="40%">Event Title</th>
              <th style="text-align:center;" width="10%">Event Code</th>
              <th style="text-align:center;" width="15%">Quantity <input type="submit" name="save" value="Save"></th>
              <th style="text-align:center;" width="10%">Unit Price</th>
              <th style="text-align:center;" width="10%">Price</th>
              <th style="text-align:center;" width="10%">Remove</th>
            </tr>	
            <!--- Display Cart item -->
               <?php //
                    //connect PHP app with MYSQL
                    //need satablish connection - need const catiable from helper.php
                    //$studentID=$_SESSION['studentID'];
                    $studentID = @$_SESSION['studentid'];
                    $con= new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                    $sql= "SELECT cart.Cart,cart.Quantity,cart.EventID,event.images,event.ETtitle,event.ETprice,cart.StudentID
                    FROM cart,event
                    WHERE  StudentID = '$studentID' AND cart.EventID=event.ETid;";
                  //call connect obj to run sql statement 
                  $counttotal=0;
                  $totalPrice=0;
                  if($result=$con->query($sql)){
                        while($row=$result->fetch_object()){
                            printf('
                            <tr>
                            <td><img src="assets/img/Event/%s" class="cart-item-image" /></td>
                            <td>%s</td>
                            <td style="text-align:center;">%s</td>
                            <input type="hidden" name="eventID" value="%s">
                            <td  style="text-align:center;"><input type="number" min="1" max="10" name="update[]" id="" value="%d" style="width: 3em"  ></td>
                            <input type="hidden" name="cartID[]" value="%d">
                            <td  style="text-align:center;">RM%.2d</td>
                            <td  style="text-align:center;">RM%.2d</td>
                            <td style="text-align:center;"> <button type="submit" name="cartDelete" value="%d">Delete</button>
                            </td>
          
          
                            </tr>
                            ',$row->images,$row->ETtitle,$row->EventID,$row->EventID,$row->Quantity,$row->Cart,$row->ETprice,$row->Quantity*$row->ETprice,$row->Cart);

                          $counttotal=$counttotal+$row->Quantity;
                          $totalPrice= $totalPrice+($row->Quantity*$row->ETprice);
                        }
                      }
               
                
                    printf('
                    <tr>
                    <td colspan="2">
                    %d item(s) In your Cart.
                    </td>
                    <td style="text-align:center;  font-weight:bold;">Total:</td>
                    <td style="text-align:center;  font-weight:bold;">%d</td>
                    <td></td>
                    <td style="text-align:center;  font-weight:bold;">RM%.2d</td>
                    </tr>
                    ',$result->num_rows,$counttotal,$totalPrice);

                    $result->free();
                    $con->close();
                    
                ?>


           
            </tbody>


          </table>	
          </form>
          </div>
          <!-- End Schdule-->
          <br><br>
  
        </div>
        
      </div>
      
    </section><!-- End Event Calendar Section -->
    
<?php
include('assets/includes/footer.php');
?>
</body>
</html>