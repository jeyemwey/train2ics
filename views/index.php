<?php include "views/header.php" ?>
			<div class="row"><div class="col-md-12">
				<h1>Train 2 ICS</h1>
				<em class="serif">Please mind that this is NOT meant to give you the best train results but to get your booking into your calendar fluently.<br />Also, your calendar <strong>will not</strong> update when delays or cancels occur.</em>
				<hr />
			</div></div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="from">Departure:</label>&nbsp;<input class="form-control" type="text" id="from" name="from" value="Kempen (Niederrhein)" />
					</div>

    				<div class="form-group">
    					<label for="to">Arrival:</label>&nbsp;<input class="form-control" type="text" id="to" name="to" value="Berlin Gesundbrunnen" />
    				</div>

    				<div class="form-group row">
    					<div class="col-sm-7">
    						<label for="departureDate">Departure Date:</label>&nbsp;<input class="form-control" type="date" id="departureDate" name="departureDate" />
    					</div>
    					<div class="col-sm-5">
    						<label for="departureTime">Time</label>&nbsp;<input class="form-control" type="time" id="departureTime" name="departureTime" />
    					</div>
    				</div>
    				<div class="form-group row">
    					<div class="col-sm-5">
	    					<label for="transportations">Transportation Methods:</label>
							<input type="button" class="btn btn-grey" id="regOnly" value="Regio Only" />
						</div>
						<div class="col-sm-7">
							<div class="row">
		    					<div class="col-xs-6 col-md-12">
			    					<input type="checkbox" name="transportations[]" id="ice_tgv_rj" value="ice_tgv_rj"  data-localTrain="false" checked /><label for="ice_tgv_rj">ICE/TGV/RJ</label><br />
									<input type="checkbox" name="transportations[]" id="ec_ic" value="ec_ic"  data-localTrain="false" checked /><label for="ec_ic">IC/EC</label><br />
									<input type="checkbox" name="transportations[]" id="ir" value="ir"  data-localTrain="false" checked /><label for="ir">InterRegio</label><br />
									<input type="checkbox" name="transportations[]" id="re_d" value="re_d"  data-localTrain="true" checked /><label for="re_d">Regio</label><br />
									<input type="checkbox" name="transportations[]" id="ship" value="ship"  data-localTrain="true" /><label for="ship">Ferry</label><br />
								</div>
		    					<div class="col-xs-6 col-md-12">
									<input type="checkbox" name="transportations[]" id="s_sn_r" value="s_sn_r"  data-localTrain="true" checked /><label for="s_sn_r">S/SN/R</label><br />
									<input type="checkbox" name="transportations[]" id="bus" value="bus"  data-localTrain="true" /><label for="bus">Bus</label><br />
									<input type="checkbox" name="transportations[]" id="cableway" value="cableway"  data-localTrain="true" checked /><label for="cableway">Cableway</label><br />
									<input type="checkbox" name="transportations[]" id="arz_ext" value="arz_ext"  data-localTrain="true" checked /><label for="arz_ext">ARZ/EXT</label><br />
									<input type="checkbox" name="transportations[]" id="tramway_underground" value="tramway_underground"  data-localTrain="true" /><label for="tramway_underground">Tram/U</label><br />
								</div>
							</div>
						</div>
    				</div>
    				<div class="form-group">
    					<input type="button" class="btn btn-success" id="updateTable" value="Get Trains" />
    				</div>

				</div>
				<div class="col-md-9">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Departure</th>
								<th class="larger">Used Trains</th>
								<th>Arrival</th>
								<th class="">Get Calendar for this connection</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="connection in connections">
								<td>{{ connection.departureTime }}</td>
								<td>{{ connection.usedTrains }}</td>
								<td>{{ connection.arrivalTime }}</td>
								<td><a href="?fn=getCalendar&from={{ connection.from_location }}&to={{ connection.to_location }}&departureTime={{ connection.departureTime }}&UCID={{ connection.UCID }}"
									class="btn btn-primary"
									data-from="{{ connection.from_location }}"
									data-to="{{ connection.to_location }}"
									data-DepartureTime="{{ connection.DepartureTime }}"
									data-ucid="{{connection.UCID}}">Get this connection to my calendar!</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
<?php include "views/footer.php" ?>