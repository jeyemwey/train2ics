<?php

namespace jeyemwey\Train2ICS;

/**
 * One part of a Connection. Basicly from getting into a train til getting of the train.
 */
class Section {

	/** @var        string  $trainnumber  Number of the train. Unique for one day. */
	public $trainnumber;

	/** @var        string  $endOfTrain  What's the name of the station thats on the train? */
	public $endOfTrain;

	/** @var        string  $operator  Railway Company ordered for that railway. */
	public $operator;

	/**
	 * @var        DateTime  $from_time  Dates of travel.
	 * @var        DateTime  $to_time    Dates of travel.
	 */
	public $from_time;
	public $to_time;

	/**
	 * @var        string  $from   Station name of departure
	 * @var        string  $to     Station name of arrival
	 */
	public $from_location;
	public $to_location;

	/**
	 * @var        string  $from_location_coords  Coords of the departure station according transport API
	 */
	public $from_location_coords;

	/**
	 * @var        string  $from_platform  Which platform is the train going to departure from?
	 */
	public $from_platform;

	/**
	 * @var        string  $to_platform  Which platform is the train going to arrive on?
	 */
	public $to_platform;

	/**
	 * Constructor Maps all the API data to this object. @ signs are required
	 * due to PHP's DateTime Compound notation.
	 * @see        http://php.net/manual/de/datetime.formats.compound.php
	 *
	 * @param      \StdClass  $json_section  API data.
	 * @return     void
	 */
	public function __construct($json_section) {
		$this->trainnumber = (string) H::v($json_section->journey->name);
		$this->endOfTrain = (string) H::v($json_section->journey->to);
		$this->operator = (string) H::v($json_section->journey->operator);

		$this->from_time = new \DateTime("@" . H::v($json_section->departure->departureTimestamp));
		$this->from_location = H::v($json_section->departure->station->name);
		$this->from_location_coords = H::v($json_section->departure->station->coordinate->x) . ", " . H::v($json_section->departure->station->coordinate->y);
		$this->from_platform = H::v($json_section->departure->platform, "");

		$this->to_time = new \DateTime("@" . H::v($json_section->arrival->arrivalTimestamp));
		$this->to_location = H::v($json_section->arrival->station->name);
		$this->to_platform = H::v($json_section->arrival->platform, "");
	}
}
