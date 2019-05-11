<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Avion Airways - The easiest way to fly</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.8.1/bootstrap-table.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.8.1/bootstrap-table.min.js"></script>
  <link rel = "stylesheet" href="css/home.css">
  <script src = "js/home.js"></script>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60" style="background-image: url('images/airline2.jpg'); background-size: cover; background-repeat:no-repeat;">
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       <a class="navbar-brand" href="home.html"><img src="images/logo.png" alt="JustFly"/></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
       <ul class="nav navbar-nav navbar-right">
        <li><a href="home.html">HOME</a></li>
        <li><a href="viewflights.php">FLIGHTS</a></li>
		<?php
		if(isset($_SESSION['username']))
		{
			echo("<li><a href='viewreservations.php'>RESERVATIONS</a></li>");
			echo("<li><a href='logout.php'>LOG OUT</a></li>");			
		}
		else
		{
			echo('<li><a href="login.html">LOG IN</a></li>');
			echo('<li><a href="signUp.html">SIGN UP</a></li>');
		}
		?>
      </ul>
    </div>
  </div>
</nav>

<!--Select Flights-->
<div class="jumbotron text-center" style="background-color:transparent">
<form action="viewflights.php">
<div class="container">
   

  <h1  margin-top=100px style="color:#ffffff">Avion Airways</h1>
  <p style="color:#ffffff">Where would you like to fly?</p>
     <label class="radio-inline" style="color:#ffffff">
      <input type="radio" name="optradio" value="economy">Economy Class
    </label>
    <label class="radio-inline" style="color:#ffffff">
      <input type="radio" name="optradio" value="business">Business Class
    </label>

</div>
  <br>
<div class="form-inline" >
 </select>

   <select name="From" class="form-control" placeholder="From" required>
    <option value="Mumbai">Mumbai</option>
 	<option value="Delhi">Delhi</option>
  </select>
   <select name="To" class="form-control"  placeholder="To" required>
    <option value="Delhi">Delhi</option>
    <option value="Mumbai">Mumbai</option>
  </select>
  <br>
  <button type="submit" class="btn btn-danger">Search Flights</button>
</div>
</form>
<?php
    if(isset($_GET['optradio']))
   {
	$fromAirport = $_GET['From'];
	$toAirport = $_GET['To'];
	$_SESSION['classtype'] = $_GET['optradio'];
	echo("<h3>Showing flights from ".$fromAirport." to ".$toAirport."</h3>");
   }
  ?>
</div>
<!-- Display filghts -->
<!--List reservations-->
<div id="services" class="container-fluid text-center">
 <?php
   if(isset($_GET['optradio']))
   {
	$fromAirport = $_GET['From'];
	$toAirport = $_GET['To'];
	$link = mysqli_connect('localhost', 'root', '', 'avionairways');
	
	//retrieve flights
	$sql = "SELECT * from flight f, flies fl, airplane ap WHERE f.FlightNo = fl.FlightNo AND ap.PCode = fl.PCode AND ap.capacity > 0 AND f.Source = '".$fromAirport."' AND f.Destination = '".$toAirport."';";
	$result = mysqli_query($link,$sql);
	if (mysqli_num_rows($result)>0)
	{
		echo("<table id='onwardFlight' class='table table-hover' name='onwardflight' data-toggle='table' data-pagination='true' data-search='true'  data-fixed-columns='true'
       data-fixed-number='2'>");
		echo("<thead><th>Flight Number</th><th>Source</th><th>Destination</th><th data-sortable='true'>Departure Date</th><th data-sortable='true'>Arrival Date</th><th data-sortable='true'>Departure Time</th><th data-sortable='true'>Arrival Time</th><th>Fare</th></thead><tbody>");
	while(($row = mysqli_fetch_row($result))!=null)
	{
		$onwardFlightStatus = $row[7];
		if($onwardFlightStatus != 0)
		{
			if(strcmp($_GET['optradio'],"business")==0)
		  {
		 	echo("<tr><td id='FlightNo' style=\"display: none;\">".$row[0]."</td><td>"
		. $row[1]. "</td><td>" .$row[2]. "</td><td>" .$row[3]. "</td><td>" .$row[4]. "</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".($row[7]*15)."</td></tr>");
		  }
		  else if(strcmp($_GET['optradio'],"economy")==0)
		  {	
		  	echo("<tr><td id='FlightNo' style=\"display: none;\">".$row[0]."</td><td>"
		. $row[1]. "</td><td>" .$row[2]. "</td><td>" .$row[3]. "</td><td>" .$row[4]. "</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".($row[7]*10)."</td></tr>");
		  }
			
		}
	}
		echo("</tbody></table>");
	}
	else
	{
		echo("We are sorry! We do not have any onward flights for this route.");
	}
   }
  ?>
  <button id="bookFlights">Book Flight</button>
</div>
<script>
$(document).ready(function(){
var onwardInstanceId = null;
// var classtype = null;
$('#bookFlights').hide();
$('#onwardFlight').on('click-row.bs.table', function(e, row, $element){$('#onwardFlight').find('tbody tr.active').removeClass('active'); $element.addClass('active'); onwardInstanceId = $element.find('#FlightNo').html(); $('#bookFlights').show();});
// classtype = document.getElementById("optradio").value;
// Post to the provided URL with the specified parameters.
$('#bookFlights').click(function post(path, parameters) {
    var form = $('<form></form>');

    form.attr("method", "post");
    form.attr("action", "bookFlight.php");
        var field1 = $('<input></input>');
        // var field2 = $('<input></input>');

        field1.attr("type", "text");
        field1.attr("name", "OnwardInstanceID");
        field1.attr("value", onwardInstanceId);

        // field2.attr("type", "text");
        // field2.attr("name", "ClassType");
        // field2.attr("value", classtype);

        form.append(field1);
        // form.append(field2);
    

    // The form needs to be a part of the document in
    // order for us to be able to submit it.
    $(document.body).append(form);
    form.submit();
});
});
</script>

</body>
</html>

