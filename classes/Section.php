<?php

namespace jeyemwey\T2C;

/**
 * One part of a Connection. Basicly from getting into a train til getting of the train.
 */
class Section {

	/** @var $trainnumber string Number of the train. Unique for one day. */
	public $trainnumber;

	/** @var $endOfTrain string What's the name of the station thats on the train? */
	public $endOfTrain;

	/** @var $operator string Railway Company ordered for that railway. */
	public $operator;

	/**
	 * @var $from_time DateTime Dates of travel.
	 * @var $to_time DateTime Dates of travel.
	 */
	public $from_time;
	public $to_time;

	/**
	 * @var $from string Station name of departure
	 * @var $to string Station name of arrival
	 */
	public $from_location;
	public $to_location;

	/**
	 * @var $from_platform string Which platform is the train going to departure from?
	 */
	public $from_platform;

	/**
	 * @var $to_platform string Which platform is the train going to arrive on?
	 */
	public $to_platform;

	/**
	 * Constructor
	 * Maps all the API data to this object.
	 * @ signs are required due to PHP's DateTime Compound notation. @see http://php.net/manual/de/datetime.formats.compound.php
	 * @param $json_section StdClass API data.
	 * @return void
	 */
	public function __construct($json_section) {
		$this->trainnumber = (string) H::v($json_section->journey->name);
		$this->endOfTrain = (string) H::v($json_section->journey->to);
		$this->operator =(string) H::v($json_section->journey->operator);

		$this->from_time = new \DateTime("@" . H::v($json_section->departure->departureTimestamp));
		$this->from_location = H::v($json_section->departure->station->name);
		$this->from_platform = H::v($json_section->departure->platform);

		$this->to_tome = new \DateTime("@" . H::v($json_section->arrival->arrivalTimestamp));
		$this->to_location = H::v($json_section->arrival->station->name);
		$this->to_platform = H::v($json_section->arrival->platform);
	}
}