<?php

namespace jeyemwey\T2C;

/**
 * Container for the whole application.
 */
class App {
	
	/**
	 * Build any Calendar Data from train data
	 * @return void
	 */
	public function getCalendarData() {

		echo memory_get_usage() . "\n";

		$from = H::In("from");
		$to = H::In("to");
		$dt = new \DateTime(H::In("Date"));

		// create curl resource 
		$ch = curl_init(); 
		// set url
		curl_setopt($ch, CURLOPT_URL, "http://transport.opendata.ch/v1/connections?from=" . urlencode($from) . "&to=" . urlencode($to) . "&limit=6&date=" . $dt->format("Y-m-d") . "&time=" . $dt->format("H:i"));
		//return the transfer as a string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// $output contains the output string 
		$output = curl_exec($ch);

		if(!curl_errno($ch)) {

			$connections = json_decode($output);

			$connections = array_map(function($json_connection) {
				return new Connection($json_connection);
			}, $connections->connections);

			$connections = H::MapByKey($connections, "UCID");

			\Kint::dump($connections);
			echo memory_get_usage() . "\n";


		} else {
			//Handle Errors here
		}
	}

	public function frontpage() {
		include "views/index.php";
	}
}