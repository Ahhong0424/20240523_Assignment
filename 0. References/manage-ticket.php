<html>
<head>
<title>Edit ticket</title>
 <!-- Tab bar icons -->
 <link href="assets/img/Badminton-icon.png" rel="icon">
  <link href="assets/img/Badminton-icon.png" rel="apple-touch-icon">

<style>
.Etable {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

.Etitle{
    text-align: center
}
.Etable,td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}

.Delete {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 2px 2px;
  cursor: pointer;
}
</style>
</head>
<body>
    <h2>Edit Ticketing Time</h2>
     <p>
          <label for="StartTime">Begin Time</label>
          <label for="EndTime" style="margin-left:60px;">End Time</label><br/>
          <input type="time" id="StartTime" name="StartTime" class="StartTime"> Until 
          <input type="time" id="EndTime" name="EndTime" class="EndTime">
        </p>
      <label for="Admin_Event_Day"></label>

     <input type="date" name="" id="" class=""><i class="fas fa-calendar-alt"></i>
     
    
      <br>   
    
    
<h2 class="Etitle">Edit Ticketing History</h2>

<table class="Etable">
    <tr class="Ttr">
    <th>Name</th>
    <th>Phone Number</th>
    <th>Event Name</th>
    <th>Seat Quantity</th>
    <th>Seat Available</th>
    <th>Payment Method</th>
    <th>Manage</th>
  </tr>
  <tr>
    <td>Lim </td>
    <td>017-2531345 </td>
    <td>CC Competition</td>
    <td>4</td>
    <td>250</td>
    <td>Paid</td>
    <td><button class="Delete">Delete</button></td>
  </tr>
  <tr>
    <td>Wong </td>
    <td>017-1112222 </td>
    <td>CC Competition</td>
    <td>2</td>
    <td>246</td>
    <td>Paid</td>
    <td><button class="Delete">Delete</button></td>
  </tr>
    <tr>
    <td>Pig </td>
    <td>017-4445555 </td>
    <td>CC Competition</td>
    <td>4</td>
    <td>244</td>
    <td>Paid</td>
    <td> <button class="Delete">Delete</button></td>
  </tr>
</table>


</body>
</html>

