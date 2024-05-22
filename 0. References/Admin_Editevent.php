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
        <title>TARUC Badminton Competitior Admin Edit Page</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" href="assets/css/UploadPic.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/edit-event.css" type="text/css">
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
        <?php include('assets/Includes/header.php');?>
        
        <div class="AdminEditEvent">
           
            <h2 ><strong style="text-decoration: underline overline;">Edit Event</strong></h2>
            <?php
            require_once './Event_Include/Event_helper.php';
            //retrieve student record from database based on the 
            //Primary key (StudentID) that passing at URL
        
            //how to differentiate which method are using
            if($_SERVER['REQUEST_METHOD']=='GET'){
                //using GET method
                //retrive StudentID from URL
                //trim unwanted spaces
                //strtoupper to convert all become uppercase to 
            $id = trim($_GET['Eventid']);     

            $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            
            $sql = "SELECT * FROM event WHERE ETid= '$id'";
              
            //execute sql statement
            //$result is keep the return record from database
            $result = $con->query($sql);
            if($row = $result->fetch_object()){
                //from $row take value from each of the field
                $id = $row->ETid;
                $title = $row->ETtitle;
                $info = $row->ETinfo;
                $day = $row->ETday;
                $time = $row->ETtime;
                $venue = $row->ETvenue;
                $number = $row->ETnum;
                $price = $row->ETprice;
                $image = $row->images;
                
            }else{
                //no record return
                echo '
                    <div class="error">
                    Database error. Record Not Found...
                    <a href="event.php">Back to List</a>
                    </div>
                        ';
            }
            
            //close connection
            $result->free();
            $con->close();
            
            }else{
                //using POST method 
                //when user clicked UPDATDE button
                //retricve user input
            
            $title = trim($_POST['title']);
            $info = trim($_POST['info']);
            $day = trim($_POST['day']);
            $time = trim($_POST['time']);
            $number = trim($_POST['number']);
            $venue = trim($_POST['venue']);
            $price = trim($_POST['price']);
            $id = trim($_GET['Eventid']);

            
            $error['title'] = validateEventTitle($title);
            $error['info'] = validateEventInfo($info);
            $error['day'] = validateEventDay($day);
            $error['time'] = validateEventTime($time);
            $error['number'] = validateNumberofParticipate($number);
            $error['venue'] = validateEventVenue($venue);
            $error['price'] = validateEventPrice($price);
            
            $error = array_filter($error);
              
              //check whether got error not?
              if(empty($error)){
                  //no error
                  //update record into database
                  //step1. establish connection
                  $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                 $target = "assets/img/Event/".basename($_FILES['image']['name']);
                 $image = $_FILES['image']['name'];
                  //step2.
                  $sql="UPDATE event SET ETtitle=?, ETinfo=?, ETday=?, ETtime=?, ETnum=?,ETvenue=?, ETprice=?,images=? WHERE ETid=?";
                  
                  //step3. prepare sql statement
                  $stmt = $con->prepare($sql);
                  //pass in value into ??? in sql statement
                  //parameterized query
                  //s is String type
                  //becareful on the sequence!
                  $stmt->bind_param('ssssisdss',$title,$info,$day,$time,$num,$venue,$price,$image,$id);
                  
                  //execute sql and update record
                  if($stmt->execute()){
                      //update successfully in database
                      printf("
                      <div class='info'>
                      Student <b>%s</b> has been update.
                      [<a href='event.php'>Back to list</a>]
                      </div>   
                        ",$title);
                      move_uploaded_file($_FILES['image']['tmp_name'], $target);
                  }else{
                      //update failed
                      echo '
                      <div class="error">
                      Error unable to update record.
                      Please try again!!!!
                      </div>
                        ';
                  }
                  
                  //close connection
                  $stmt->close();
                  $con->close();
              } else {
                  //error!!!
                  echo '<ul class="error">';
                  foreach ($error as $value){
                      echo "<li>$value</li>";
                  }
                  echo '</ul>';
              }
            }
        ?>
                    <div class="Back_span_button">
                        <span>                    
                            <a onclick="goBack()"" class="Back_viewEvent">  
                                <i class="fa fa-arrow-left" style="font-size:24px;"></i>
                            </a>
                        </span>
                        <div class="Back_span_button_content">
                            <p>Return to Event Detail Page</p>
                        </div>
                    </div>

            <form action="" method="POST" enctype="multipart/form-data">
                    <div class="Event_information">
                         <input type="text" name="id" value="<?php echo isset($etid)?$etid:'';?> " hidden=""/>
                        <h2 style="text-decoration: underline;">Event Title</h2>
                        <input type="text" placeholder="New Event Title" value="<?php echo $title; ?>" name="title" style="width:580px;height: 30px;">
                        
                        <br/><hr/>

                        <h2 style="text-decoration: underline;">Event Information</h2>
                        <textarea rows="6" cols="70" name="info"  class="Admin_Event_Info" id="Admin_Event_Info" placeholder="Description of Event Information" required><?php echo $info; ?></textarea>
                        
                        <br/><hr/>

                        <h2 style="text-decoration: underline;">Time & Date</h2>
                        <table style="width:53%; margin-left: 5px; ">
                            <tr>
                                <th>Event Day:</th>
                                <td><input type="date" name="day" id="New_Event_Day" class="New_Event_Day" value="<?php echo $day; ?>"><i class="fas fa-calendar-alt"></i></td>
                            </tr>
                            <tr>
                                <th> Event Time:</th>
                                <td><input type="time" id="New_Event_StartTime" name="time" class="New_Event_StartTime" value="<?php echo $time; ?>"></td>
                            </tr>
                        </table>      
                        <br/><hr/>
                        
                        <h2 style="text-decoration: underline;">Number of participants</h2>
                        <p><strong>The current number of participants is 50</strong></p>
                        <p style="margin-left:20px;"><label for="Updatenumber">Update Seat: </label><br/> 
                        <input type="number" name="number" value="<?php echo $number; ?>" style="width:50px;"></p>
                        
                        <hr/>
                         
                         <h2 style="text-decoration: underline;">Event Venue</h2>
                         <table style="width:53%;">
                             <tr>
                                <th><label for="NewVanue"><strong>Venue: </strong></label></th>                          
                                <td><input type="text" class="New_Event_Venue" id="New_Event_Venue" name="venue" placeholder="Venue of Event" required value="<?php echo $venue; ?>"></td>
                             </tr>
                         </table>
                         
                        <hr/>

                        <h2 style="text-decoration: underline;">Ticket Price of Event</h2>
                        <label for="Admin_Event_Price">RM </label>
                        <input type="number" name="price" id="Admin_Event_Price" class="Admin_Event_Price" value="<?php echo $price; ?>" style="width:70px; " >
                        
                        <hr/>
                        
                        <h2 style="text-decoration: underline;">Number of participants</h2>
                       <div class="Upload" style="margin: 0px 0px 80px 0px;">
                        <div class="wrapper">
                            <div class="image">
                             
                                <img src="assets/img/Event/<?php echo $image; ?>" alt="" style="width: 100px; height:auto;"> 
                            </div>
                            <div class="content">
                                <div class="icon"><i class="material-icons">collections</i></div>
                                <div class="text">No image chosen,yet!</div>
                            </div>
                            <div id="cancel-btn"><i class="fa fa-close"></i></div> 
                            <div class="file-name">Image name here</div> 
                        </div>
                        <input id="default-btn" type="file" name="image" hidden="">
                        <input  name="size" value="1048576" hidden=""/>
                        <input onclick="defaultBtnActive()" id="custom-btn" value="Choose Event Pic" style="font-size:13px;text-align: center" name="image">
                       
                    </div>
                        
                    </div>
                 </div>
                    <div style="margin:20px 0px 0px 920px;">
                        <input type="submit" value="Save" name="update" />
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
