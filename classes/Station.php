<?php

namespace jeyemwey\T2C;

/**
* Location class for Train Stations.
*/
class Location {
	
	/** @var $type string Can be ["station", "poi", "address"] */
	public $type = "station";

	/** @var $name string Name of the station according SBB database. */
	public $name;

	/** @var $coords Location\Coordinate Coordinates of the station. */
	public $coords;

}