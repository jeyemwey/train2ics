<?php

namespace jeyemwey\Train2ICS;

/**
 * Universal Helper Class
 * Small functions that won't fit anywhere else.
 */
class H {

	/**
	 * Value function.
	 * @param mixed $v The value
	 * @param mixed $else An alternative. Default: Empty string.
	 * @return the value or the $else value, depending of $v being set and !=0 in larger context.
	 */
	public static function v(&$v, $else = "") {
		return (isset($v) AND $v) ? $v : $else;
	}

	/**
	 * Set TimezoneRules for Calendars to CEST/CET.
	 * @param $calendar \Eluceo\iCal\Component\calendar Calendar to be timezoned. Ref Param.
	 * @see Eluceo\iCal
	 * @return void But $calendar is a reference parameter, so it will be changed.
	 */
	public static function CalendarSetTimeZones(&$calendar) {
		$tz  = 'Europe/Berlin';
		$dtz = new \DateTimeZone($tz);

		// 2. Create timezone rule object for Daylight Saving Time
		$vTimezoneRuleDst = new \Eluceo\iCal\Component\TimezoneRule(\Eluceo\iCal\Component\TimezoneRule::TYPE_DAYLIGHT);
		$vTimezoneRuleDst->setTzName('CEST');
		$vTimezoneRuleDst->setDtStart(new \DateTime('1981-03-29 02:00:00', $dtz));
		$vTimezoneRuleDst->setTzOffsetFrom('+0100');
		$vTimezoneRuleDst->setTzOffsetTo('+0200');
		$dstRecurrenceRule = new \Eluceo\iCal\Property\Event\RecurrenceRule();
		$dstRecurrenceRule->setFreq(\Eluceo\iCal\Property\Event\RecurrenceRule::FREQ_YEARLY);
		$dstRecurrenceRule->setByMonth(3);
		$dstRecurrenceRule->setByDay('-1SU');
		$vTimezoneRuleDst->setRecurrenceRule($dstRecurrenceRule);
		// 3. Create timezone rule object for Standard Time
		$vTimezoneRuleStd = new \Eluceo\iCal\Component\TimezoneRule(\Eluceo\iCal\Component\TimezoneRule::TYPE_STANDARD);
		$vTimezoneRuleStd->setTzName('CET');
		$vTimezoneRuleStd->setDtStart(new \DateTime('1996-10-27 03:00:00', $dtz));
		$vTimezoneRuleStd->setTzOffsetFrom('+0200');
		$vTimezoneRuleStd->setTzOffsetTo('+0100');
		$stdRecurrenceRule = new \Eluceo\iCal\Property\Event\RecurrenceRule();
		$stdRecurrenceRule->setFreq(\Eluceo\iCal\Property\Event\RecurrenceRule::FREQ_YEARLY);
		$stdRecurrenceRule->setByMonth(10);
		$stdRecurrenceRule->setByDay('-1SU');
		$vTimezoneRuleStd->setRecurrenceRule($stdRecurrenceRule);
		// 4. Create timezone definition and add rules
		$vTimezone = new \Eluceo\iCal\Component\Timezone($tz);
		$vTimezone->addComponent($vTimezoneRuleDst);
		$vTimezone->addComponent($vTimezoneRuleStd);
		$calendar->setTimezone($vTimezone);
	}

	/**
	 * Key List<Obj> by Obj->$field
	 * @param $list Array The list array
	 * @param $field string The Identifier. Default: "id"
	 * @return Array<string => <Obj>>
	 */
	public static function MapByKey($list, $field = "id") {
		$newArray = array();

		foreach ($list as $Instance) {
			$newArray[$Instance->$field] = $Instance;
		}

		return $newArray;
	}

	/**
	 * Get Input from HTTP request.
	 * Order:
	 * 1) _POST
	 * 2) _REQUEST
	 * @param string $key
	 * @param bool $onlyPost Shall I only look for post?
	 * @param mixed $else. Default: Empty string.
	 * @return Returns the value, else or empty string.
	 */
	public static function In($key, $onlyPost = FALSE, $else = "") {
		$v = self::v($_POST[$key], $else);
		if($v == $else AND !$onlyPost) {
			$v = self::v($_REQUEST[$key], $else);
		}

		return $v;
	}
}