<?php

namespace jeyemwey\T2C;

/**
 * One part of the journey. Basicly from getting into a train til getting of the train.
 */
class Section {

	/** @var $trainnumber string Number of the train. Unique for one day. */
	public $trainnumber;

	/** @var $company string Company ordered for that railway. */
	public $company;

	/**
	 * @var $from_time DateTime Dates of travel.
	 * @var $to_time DateTime Dates of travel.
	 */
	public $from_time;
	public $to_time;

	/**
	 * @var $from_platform string Which platform is the train going to DEPARTURE?
	 */
	public $from_platform;
}