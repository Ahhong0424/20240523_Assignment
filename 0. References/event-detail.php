<?php session_start(); $this_page='Event'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Event detail</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

 

<!--====link===-->
<?php  include('assets/Includes/link.php');?>
<!--====End link====-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/event-detail.css">
</head>

<body>

<!--====Header====-->

<?php include('assets/Includes/header.php');?>

<!--====End Header====-->
  
  <main id="main" class="main-page">

    <!-- ======= Events Details Sectionn ======= -->
    <section id="speakers-details">
      <div class="Back_span_button">
          
        <span>                      
            <a onclick="goBack()" class="Back_viewEvent">
                <i class="fa fa-arrow-left" style="font-size:24px;"></i>
            </a>
        </span>
        <div class="Back_span_button_content">
            <p>Return to View Event Page</p>
        </div>
    </div>
      <div class="container">
        <div class="section-header">
          <h2>Event Details</h2>
        </div>
        <?php
        require_once './Event_Include/Event_helper.php';
        if($_SERVER['REQUEST_METHOD']=='GET'){      
        
        $id = trim($_GET['Eventid']); 
        
        $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        
        $sql="SELECT * FROM event WHERE ETid ='$id'";
        
        $result = $con->query($sql);
        
        if($row = $result->fetch_object()){
                $id = $row->ETid;
                $title = $row->ETtitle;
                $info = $row->ETinfo;
                $day = $row->ETday;
                $time = $row->ETtime;
                $number = $row->ETnum;
                $venue = $row->ETvenue;
                $price = $row->ETprice;
                $image = $row->images;
                printf('
       <div class="row">
          <div class="col-md-6">
            <img src="assets/img/Event/%s" alt="" class="img-fluid" style="margin-left: 120px; width: 900px; height:auto;">
          </div>

          <div class="col-md-6">
            <div class="details">
              <h2 style="text-decoration: underline;">Event Title</h2>
              <strong>%s</strong>
              <h2 style="text-decoration: underline;">Event information</h2>
              <p><strong>%s</strong></p>
              <h2 style="text-decoration: underline;">Time & Location</h2>
              <p><strong>Date: </strong>%s</p>
              <p><strong>Time: </strong>%s</p>
              <p><strong>Venue: </strong>%s</p>
              <h2 style="text-decoration: underline;">Number of participants</h2>
              <p><strong>Support %d people to participate</strong></p>

              <h2 style="text-decoration: underline;">Ticket of Event</h2>
              <p><strong>%.2f/Ticket</strong>
              <br>
              <br>
              <form action="%s" method="get">
              <input type="hidden" name="eventid" value="%s">
              <input type="submit" value="Add to Cart" onclick=""/>
              </form>    
            </div>
          </div>

            ',$image,$title,$info,$day,$time,$venue,$number,$price,isset($_SESSION['studentid'])?'event-cart.php?eventid=?':'memberlogin.php',$id);
           if(isset($_SESSION['adminid'])){
              printf('
            <div class="AdminEventOption" style="margin:0px 0px 0px 1000px;">
                <span> 
                    <i class="fa fa-gear fa-spin" style="font-size:30px; color: brown; margin-top: 5px;"></i>
                </span>
                <form method="POST">
                <div class="EventOption-content" style="width: 170px;">
                    <i style="text-decoration:underline">Option</i>
                <input name="id" value="%s"  hidden=""/>
                <input name="title" value="%s" hidden=""/>
                <input type="submit" value="Delete Event" name="Del" id="del" style="width: 150px;"/>
                  <button class="edit"><a href="Admin_Editevent.php?Eventid=%s">Edit Event</a></button>
              </div>
              </form>                  
            </div>',$id,$title,$id);
            }
        } else{
            echo '
            <div class="error">
            Database error. Record not found.
            [<a href=\'event.php\'>Back to Event Page</a>]
            </div>
                ';
        }
       $result->free();
       $con->close();
       }else{
            $id = trim($_POST['id']);
            $title = trim($_POST['title']);
             $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
             $sql="DELETE FROM event WHERE ETid=?";
             $stmt = $con->prepare($sql);
             $stmt->bind_param('s', $id);
             $stmt->execute();
             if($stmt->affected_rows>0){
                 printf('
                         <div class="info">
                         Event <b>%s</b> has been deleted.
                         [<a href=\'event.php\'>Back to Event Page</a>]
                            </div>
                        ',$title);
             }else{
                   echo '
                      <div class="error">
                      Error unable to delete record.
                      Please try again!!!!
                      </div>
                        ';
             }
        }
        ?>

    </section>
  </main><!-- End #main -->
  <script>
        //Go Back to previous URL 
        function goBack() {
            window.history.back();
        }
        </script>
  <?php
    include('assets/includes/footer.php');
?>

</body>

</html>