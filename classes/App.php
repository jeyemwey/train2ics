<?php

namespace jeyemwey\Train2ICS;

/**
 * Container for the whole application.
 * It turned out this might be our Controller class as /index.php
 * checks if $_GET["fn"] exists in here as a public method and runs it then.
 * If it is not present, it will just run App::frontpage().
 */
class App {
	
	/**
	 * Just render out the front page of the application. Default.
	 */
	public function frontpage() {
		include "views/index.php";
	}

	/** @var $connection Array<Connection> Return value of self::getConnectionsFromApiAndParseThem() */
	public $connections = [];

	/**
	 * Get data from api and parse it into the objects.
	 *
	 * @param      string     $from              The Origin
	 * @param      string     $to                The Destination
	 * @param      \DateTime  $dt                DateTime Object of start
	 * @param      array      $transportMethods  The transport methods of your choice
	 *
	 * @return     bool       if it got results. Also $this->connections will be changed.
	 */
	private function getConnectionsFromAPIAndParseThem($from, $to, $dt, $transportMethods): bool {

		$transportMethods = H::CreateParamList($transportMethods, "transportations");
		$url = "http://transport.opendata.ch/v1/connections?from=" . urlencode($from) . "&to=" . urlencode($to) . "&limit=6&date=" . $dt->format("Y-m-d") . "&time=" . $dt->format("H:i") . $transportMethods;

		// create curl resource 
		$ch = \curl_init(); 
		// set url
		\curl_setopt($ch, CURLOPT_URL, $url);
		//return the transfer as a string
		\curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// $output contains the output string 
		$output = curl_exec($ch);

		if(!\curl_errno($ch)) {

			$connections = json_decode($output);

			if (count($connections->connections)) {

				$connections = array_map(function($json_connection) {
					return new Connection($json_connection);
				}, $connections->connections);

				$this->connections = H::MapByKey($connections, "UCID");
				return 1;
			
			} else {
				return 0;
			}
		} else return 0;
	}

	private static $transportMethods = "";

	/**
	 * Get the connections. Content-Type: json
	 */
	public function getConnections() {
		$from = H::In("from");
		$to = H::In("to");
		$dt = new \DateTime(H::In("departureDate") . " " . H::In("departureTime"));
		App::$transportMethods = H::In("transportations", array());

		$this->getConnectionsFromAPIAndParseThem($from, $to, $dt, App::$transportMethods);

		array_map(function($conn) {
			$conn->departureTime = $conn->sections[0]->from_time->format("d.m.Y H:i");
			$conn->arrivalTime = end($conn->sections)->to_time->format("d.m.Y H:i");
			$conn->usedTrains = "";
			

			for ($i=0; $i < count($conn->sections); $i++) { 
				if ($i) $conn->usedTrains .= " ➡️ ";
				$conn->usedTrains .= $conn->sections[$i]->trainnumber;
			}

			$conn->transportMethods = H::CreateParamList(App::$transportMethods, "transportations");
			return $conn;

		}, $this->connections);

		header("Content-Type: application/json");
		echo json_encode($this->connections);
	}

	/**
	 * Get the calendar. Content-Type: ics
	 */
	public function getCalendar() {
		$from = H::In("from");
		$to = H::In("to");
		$dt = new \DateTime(H::In("departureDate") . " " . H::In("departureTime"));
		$transportMethods = H::In("transportations", array());

		$this->getConnectionsFromAPIAndParseThem($from, $to, $dt, $transportMethods);

		$conn = H::v($this->connections[H::In("UCID")], 0);

		if ($conn) {
			header('Content-Type: text/calendar; charset=utf-8');
			header('Content-Disposition: attachment; filename="' . $conn->usedTrains . '.ics"');

			echo $conn->buildCalendar();
		} else {
			include "views/error.php";
		}
	}
}