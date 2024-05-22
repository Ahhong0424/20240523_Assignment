  
  
  <style>
            /* Create two columns/boxes that floats next to each other */
            .side-nav {
          float: left;
          width: 15%;
          height: 100vh;
          padding: 20px;
          position: relative;
        }
              /* Style the list inside the menu */
              .side-nav ul {
          list-style-type: none;
          padding-top: 110px;
          font-size: 16px;
          margin: 0;
          font-family: "Raleway", sans-serif;
          font-weight: 700;
          text-transform: uppercase;

        }
  </style>
  <nav class="side-nav" class="col-lg-9">
    <ul>
      <li><h2>Event</h2></li>
      <li><a href="event.php">View Event</a></li>
      <li><a href="event-cart.php">Ticket Cart</a></li>
      <li><a href="event-records.php">Event records</a></li>
      <br><br>
      <br><br>
      <?php 
      if(isset($_SESSION['adminid'])){
        printf(" <li><h2>Admin</h2></li>
        <li><a href='Admin_addevent.php'>Add new event</a></li>");
      }
    
      ?>
    

    </ul>
  </nav>