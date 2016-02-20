<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Train Data to ICS</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css" />
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/style.css" />

    </head>
    <body>

		<div class="container" id="app">
			<div class="row"><div class="col-md-12">
				<h1>Train 2 ICS</h1>
				<em>Please mind that this is NOT meant to give you the best train results but to get your booking into your calendar fluently.<br />Also, your calendar <strong>will not</strong> update when delays or cancels occur.</em>
				<hr />
			</div></div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group"><label for="from">Departure:</label>&nbsp;<input type="text" id="from" name="from" value="Kempen (Niederrhein)" /></div>
    				<div class="form-group"><label for="to">Arrival:</label>&nbsp;<input type="text" id="to" name="to" value="Berlin Gesundbrunnen" /></div>
    				<div class="form-group"><label for="departureDate">Estimated Time Of Departure:</label>&nbsp;<input type="date" id="departureDate" name="departureDate" /><input type="time" id="departureTime" name="departureTime" /></div>
    				<div class="form-group"><input type="button" class="btn btn-success" id="updateTable" value="Get Trains" /></div>
				</div>
				<div class="col-md-9">
					<table>
						<thead>
							<tr>
								<th>Departure</th>
								<th class="larger">Used Trains</th>
								<th>Arrival</th>
								<th class="larger">Get Calendar for this connection</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="connection in connections">
								<td>{{ connection.departureTime }}</td>
								<td>{{ connection.usedTrains }}</td>
								<td>{{ connection.arrivalTime }}</td>
								<td><button
									data-from="{{ connection.from }}"
									data-to="{{ connection.to }}"
									data-DepartureTime="{{ connection.DepartureTime }}"
									data-ucid="{{connection.ucid}}">Get this connection to my calendar!</button></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	
    	
		<!-- TODO: SHRINK THIS DOWN AND DOWNLOAD ALL THE STUFF -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="http://vuejs.org/js/vue.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="assets/app.js"></script>
    </body>
</html>