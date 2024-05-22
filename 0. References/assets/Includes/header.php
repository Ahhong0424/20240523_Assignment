
<script>
      // clear form resubmission error 
      if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
      }
</script>
  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center ">
    <div class="container-fluid container-xxl d-flex align-items-center">

      <div id="logo" class="me-auto">
        <h1><a href="home.php"><span>BADMINTON Club</span></a></h1>
      </div>

    
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link <?php echo ($this_page=='Home')?'active':'';?>" href="home.php">Home</a></li>
          <li><a class="nav-link <?php echo ($this_page=='Event')?'active':'';?>" href="event.php">Event</a></li>
          <li><a class="nav-link <?php echo ($this_page=='Member')?'active':'';?>" href="member-association.php">Member Assiciations</a></li>
          <li><a class="nav-link <?php echo ($this_page=='ContactUs')?'active':'';?>" href="contactUs.php">Contact Us</a></li>
        <?php  
        
           
                  // if member login 
                  if(isset($_SESSION['studentid']))
                  {
                  $name = $_SESSION['name'];
                   printf('
                  <li class="dropdown"><a href="#"><span>Welcome %s</span> <i class="bi bi-chevron-down"></i></a>
                  <ul>
                  <li><a href="logout.php" >Log out</a></li>
                  </ul>', $name);   
                  }
                  // if admin login 
                  if(isset($_SESSION['adminid']))
                  {
                  $adminid = $_SESSION['adminid'];
                  printf('
                  <li class="dropdown"><a href="#"><span>Welcome %s </span> <i class="bi bi-chevron-down"></i></a>
                  <ul>
                  <li><a href="logout.php" >Log out</a></li>
                  </ul>',$adminid);  
                  }
                 // if no user login 
                if((isset($_SESSION['studentid']) || isset($_SESSION['adminid'])) == null)
                {
                printf('
                <li class="dropdown"><a href="#"><span>Log in</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                <li><a href="adminlogin.php" >Admin</a></li>
                <li><a href="memberlogin.php">Member</a></li>
                </ul> ');    
                }
                 
          ?>

       
         
 
        </li> 
       
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar   
      <a class="buy-tickets scrollto" href="#buy-tickets">Buy Tickets</a>
-->
    </div>

  </header><!-- End Header -->