<?php
include_once 'Date.php';

class DateTest extends PHPUnit_Framework_TestCase {
    
    public function testDateParse() {
	$date = new Dansnet\Date("2016-05-01");
	$this->assertNotEquals(FALSE, $date);
	return $date;
    }
    
    public function testDateTimeParse() {
	$date = new Dansnet\Date("2016-05-01 23:49:13");
	$this->assertNotEquals(FALSE, $date);
	return $date;
    }
    
    /**
     * @depends testDateParse
     */
    public function testDateFormat( Dansnet\Date $date ) {
	$this->assertEquals("01.05.2016", $date->getDateGerman());
	$this->assertEquals("2016-05-01", $date->getDateInternational());
    }
    
    /**
     * @depends testDateTimeParse
     */
    public function testDateTimeFormat( Dansnet\Date $date ) {
	$this->assertEquals("23:49:13", $date->getTime());
	$this->assertEquals("23:49", $date->getShortTime());
    }

}