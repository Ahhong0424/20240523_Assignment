 <!DOCTYPE html>
 <?php 

session_start();
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Insert New Event</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" href="assets/css/UploadPic.css" rel="stylesheet">
        <link href="assets/css/addevent.css" rel="stylesheet" type="text/css"/>
        <style>
        #header {
            background-color: #040919;
        }   
        </style>
        <!--====link===-->
        <?php  include('assets/Includes/link.php');?>
    </head>
    <body style="background-color:#e6eeff;">
        <!--====Header====-->
        <?php 
        include('assets/Includes/header.php');
        require_once './Event_Include/Event_helper.php';
        ?>

        <?php
        $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $query = "select*from event order by ETid desc limit 1";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        $lastid = $row['ETid'];
            if($lastid ==" "){
                $etid = "ET1";
            }else {
                $etid = substr($lastid,2);
                $etid = intval($etid);
                $etid = "ET".($etid + 1);
            }

            
        ?>
        

        <div id="Add_Event_Form">    
            <h2 style="text-decoration: underline; font-size: 40px">Insert New Event</h2>      
       <?php
      
        if(!empty($_POST)){
            $id = trim($_POST['id']);
            $title = trim($_POST['title']);
            $info = trim($_POST['info']);
            $day = trim($_POST['day']);
            $time = trim($_POST['time']);
            $number = trim($_POST['number']);
            $venue = trim($_POST['venue']);
            $price = trim($_POST['price']);

            $error['title'] = validateEventTitle($title);
            $error['info'] = validateEventInfo($info);
            $error['day'] = validateEventDay($day);
            $error['time'] = validateEventTime($time);
            $error['number'] = validateNumberofParticipate($number);
            $error['venue'] = validateEventVenue($venue);
            $error['price'] = validateEventPrice($price);
            
            $error = array_filter($error);
            if(empty($error)){
                $target = "assets/img/Event/".basename($_FILES['image']['name']);
                $image = $_FILES['image']['name'];
            if($_SERVER["REQUEST_METHOD"]=="POST"){

                if(!$con){
                    die("connection failed" . mysqli_connect_error());
                } else {

                    
                     $sql = "INSERT INTO event (ETid, ETtitle,ETinfo,ETday,ETtime,ETnum,ETvenue,ETprice,images  )VALUES ('$id','$title','".$info."','$day','$time','$number','$venue','$price','$image')";
                     if(mysqli_query($con, $sql)){
                         echo '<li>record add</li>
                             <li>Please press <input type="button" value="Refresh" onclick="location=\'Admin_addevent.php\'" id="reset"/> button to add new event.</li>      
                         ';
                     move_uploaded_file($_FILES['image']['tmp_name'], $target);
                        $title = $info = $day = $time = $number = $venue = $price = $image = null;
                     } else {
                         echo 'Record fail';
                     }
                }
        }
     }else{
                //with error, display error msg 
                echo '<ul class="error">';
                foreach ($error as $value){
                    echo "<li>$value</li>";
                }
                echo '</ul>';
            }
            $con->close();
        }

        ?>
            <form action="" method="POST" enctype="multipart/form-data">               
                    <div style="margin-bottom: 20px;">
                        <input type="text" name="id" value="<?php echo isset($etid)?$etid:'';?> " hidden=""/><br/>
                        <label for="Admin_Event_Title"><strong>Event Title: </strong></label><br/>
                        <input  type="text" placeholder="New Event Title" name="title" class="Admin_Event_Title" id="Admin_Event_Title"  
                                value="<?php echo isset($title)?$title:'' ?>">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="Admin_Event_Info"><strong>Event Information: </strong></label><br/>
                        <textarea rows="6" cols="50" name="info"  class="Admin_Event_Info" id="Admin_Event_Info"  placeholder="New Event Description"></textarea>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="Admin_Event_Day"><strong>Event Day: </strong></label><br/>
                        
                        <input type="date" name="day" id="Admin_Event_Day" class="Admin_Event_Day"><i class="fas fa-calendar-alt"></i>
                        
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label for="Admin_Event_Time"><strong>Begin Time: </strong></label><br/>                       
                        <input type="time" id="time" name="time" class="Admin_Event_Time" value="<?php echo isset($title)?$title:'' ?>">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="Admin_Event_Quantity"><strong>Quantity of Participate: </strong></label><br/>
                        <input type="number" id="number" name="number"  class="Admin_Event_Quantity" min="0" max="100" step="1" value="<?php echo isset($number)?$number:'' ?>" >
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="Admin_Event_Venue"><strong>Venue of Event: </strong></label><br/>
                        <input type="text" class="Admin_Event_Venue" id="Admin_Event_Venue" name="venue" placeholder="Venue of Event" value="<?php echo isset($venue)?$venue:'' ?>">
                    </div>

                    
                    <div style="margin-bottom: 20px;">
                        <label for="Admin_Event_Price">Price of Ticket: </label><br/>
                        <label for="Admin_Event_Price">RM </label>
                        <input type="number" name="price" id="Admin_Event_Price" class="Admin_Event_Price"  min="1"  style="width:50px;" value="<?php echo isset($price)?$price:'' ?>">
                    </div>
                    
                    <div class="Upload" style="margin: 0px 0px 0px 410px">
                        <div class="wrapper">
                            <div class="image">
                                <img src="" alt="" name=""> 
                            </div>
                            <div class="content">
                                <div class="icon"><i class="material-icons">collections</i></div>
                                <div class="text">No image chosen,yet!</div>
                            </div>
                            <div id="cancel-btn"><i class="fa fa-close"></i></div> 
                            <div class="file-name">Image name here</div> 
                        </div>
                        <input id="default-btn" type="file" name="image" hidden="">
                        <input type="hidden" name="size" value="1048576"/>
                        <input onclick="defaultBtnActive()" id="custom-btn" value="Choose Event Pic" style="font-size:13px;text-align: center" name="image" >                        
                    </div>
                    
                    <div class="cancel" style="margin-top: 80px;">
                        <input type="button" value="Cancel" name="cancel"
                       onclick="location='event.php'" class="cancelButton">
                        <div class="ContinuForm">
                            <input type="button" value="Reset" onclick="location='Admin_addevent.php'" id="reset"/>
                            <input type="submit" value="Post Event" id="submit" name="submit"/>
                        </div>
                    </div>
                </form>
            </div>
        <script>
            const wrapper = document.querySelector(".wrapper");
            const fileName = document.querySelector(".file-name");
            const cancelBtn = document.querySelector("#cancel-btn");
            const defaultBtn = document.querySelector("#default-btn");
            const custombtn = document.querySelector("#custom-btn");
            const img = document.querySelector("img");
            let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\～\_]+$/;
            function defaultBtnActive(){
                defaultBtn.click();
            }
            defaultBtn.addEventListener("change", function(){
                const file = this.files[0];
                if(file){
                    const reader = new FileReader()
                    reader.onload = function(){
                    const result = reader.result;
                    img.src = result;
                    wrapper.classList.add("active");
                }
                cancelBtn.addEventListener("click", function(){
                    img.src = "";
                    wrapper.classList.remove("active");
                });
                reader.readAsDataURL(file);
                }
                if(this.value){
                    let valueStore = this.value.match(regExp);
                    fileName.textContent = valueStore;
                }
                
            });
            
        </script>
        
          <?php
            include('assets/includes/footer.php');
          ?>

    </body>
</html>