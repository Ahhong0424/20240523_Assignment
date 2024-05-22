<?php session_start(); $this_page='Event'; ?>
<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
      
      
        <title>Event|Tarc Badminton Club</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
      <!--====link====-->
      <?php include('assets/Includes/link.php');?>
      <!--====End link====-->
      
        <style>

          #header {
         background-color: #040919;
         }   
         div.alert{
          margin: auto;
          width: 50%;
          border: 3px ;
          padding: 10px;
         }
      </style>
      
      </head>
      
      <body>
      
<!--====Header====-->

<?php include('assets/Includes/header.php');?>
<?php require_once './Event_Include/Event_helper.php'; ?>
<!--====End Header====-->
  
<section id="event">
<!--====Side nav====-->

<?php include('assets/Includes/side-nav.php');

if(isset($_POST['search'])){   
  $search = @$_POST['search'];
}
?>

<!--====End side nav====-->



    <section id="schedule" class="section-with-bg">
      <div class="container" data-aos="">
        <div class="section-header">
          <h2>Event Calendar</h2>
          <p>Here is our event in coming months</p>
        </div>
        <div class="search-container">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="POST">
            <input type="text" placeholder="Search.." name="search" id='search' style="width:500px;" value="<?php echo empty(@$_POST['search'])?"":$search; ?>">
            <input type="submit" name="submit" value="search">
          </form>
        </div>
        <br>
        <div class="tab-content row justify-content-center" id="result" data-aos="" data-aos-delay="">
        <?php 
    if(isset($_POST['search'])){               
        // search 
       //establish connection
       $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        
      $search = @$_POST['search'];
        
        //sql query
        $sql = "SELECT * FROM event
                WHERE ETtitle LIKE '%$search%';";
       
       //if user didnt enter any keyword in the search bar
       if(@$_POST['search']==null)
       {
        
           echo '<div class="alert alert-danger" role="alert">
           No keyword entered !
         </div>';
       }     
       //if user got enter keyword in search bar
       else
       {
          if($result = $con->query($sql))
          {   
            if($result->num_rows > 0 ){
              while($row = $result->fetch_object()){

                //display record 1 by 1
                echo '';
                printf('
                 <!-- Schdule-->
                 <div role="tabpanel" class="col-lg-9 tab-pane fade show active" >
                    <div class="row schedule-item">
                         <div class="col-md-3"><time>Day : %s</time><br><time>Time: %s</time></div>
                            <div class="col-md-9">
                                <div class="event">
                                    <img src="assets/img/Event/%s" alt="">
                                </div>
                                    <a href="event-detail.php?Eventid=%s"><h4>%s</h4></a>
                                    <p>%s</p>
                            </div>
                </div>
                </div>
                            
                       ',
                        $row->ETday,
                        $row->ETtime,
                        $row->images,
                        $row->ETid,                    
                        $row->ETtitle, 
                        $row->ETinfo);

               }  
               $result->free();
               $con->close();
            }else {
              echo '<div class="alert alert-danger" role="alert"> No records found for your search !</div>';
            }
          }
         
        }
      }
      //End serch 
      else{
  //connect PHP app with MYSQL
            //need establish connection - need const variable from helper.php
            
            
            //use Object-oriented method
            $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            
            //sql statement
            $sql = "SELECT * FROM event";
            
            
            //cell connection obj to run sql statement
            if($result = $con->query($sql)){
                //record found
                //$result obj contains 8 records
                while($row = $result->fetch_object()){
                    //display record 1 by 1
                    echo '';
                    printf('
                     <!-- Schdule-->
                     <div role="tabpanel" class="col-lg-9 tab-pane fade show active" >
                        <div class="row schedule-item">
                             <div class="col-md-3"><time>Day : %s</time><br><time>Time: %s</time></div>
                                <div class="col-md-9">
                                    <div class="event">
                                        <img src="assets/img/Event/%s" alt="">
                                    </div>
                                        <a href="event-detail.php?Eventid=%s"><h4>%s</h4></a>
                                        <p>%s</p>
                                </div>
                    </div>
                    </div>
                                
                           ',
                            $row->ETday,
                            $row->ETtime,
                            $row->images,
                            $row->ETid,                    
                            $row->ETtitle, 
                            $row->ETinfo);
                }
            }   
                //show number of result returned from DB
                echo '';
            //close connection, free result
            $result->free();
            $con->close();
      }
  ?> 
  

          <!-- End Schdule-->

        </div>

      </div>

    </section><!-- End Event Calendar Section -->

    </div>
</section>
<?php
include('assets/includes/footer.php');
?>
   
</body>
</html>