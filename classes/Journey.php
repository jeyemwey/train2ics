<?php

namespace jeyemwey\T2C;

/**
 * A journey contains any information for riding a train.
 * @see http://transport.opendata.ch/docs.html
 */
class Journey {

	/**
	 * @var $from Station
	 * @var $to Station
	 */
	public $from_station;
	public $to_station;

	/** @var $sections Array<Section> Any part of a journey. */
	public $sections = [];

}