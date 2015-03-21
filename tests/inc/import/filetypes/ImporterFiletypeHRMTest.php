<?php

class ImporterFiletypeHRMTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var ImporterFiletypeHRM
	 */
	protected $object;

	protected function setUp() {
		$this->object = new ImporterFiletypeHRM;
	}

	/**
	 * Test: 12011801.hrm
	 */
	public function testSimpleExampleFile() {
		$this->object->parseFile('../tests/testfiles/hrm/12011801.hrm');

		$this->assertFalse( $this->object->failed() );
		$this->assertFalse( $this->object->hasMultipleTrainings() );

		$this->assertEquals( mktime(11, 31, 40, 1, 18, 2012), $this->object->object()->getTimestamp() );
		$this->assertEquals( 0, $this->object->object()->getDistance() );
		$this->assertEquals( 59*60 + 39.1, $this->object->object()->getTimeInSeconds() );
		$this->assertEquals( 133, $this->object->object()->getPulseAvg() );
		$this->assertEquals( 144, $this->object->object()->getPulseMax() );
		$this->assertEquals( 83, $this->object->object()->getCadence() );

		$this->assertTrue( $this->object->object()->hasArrayPace() );
		$this->assertTrue( $this->object->object()->hasArrayHeartrate() );

		$this->assertFalse( $this->object->object()->Splits()->areEmpty() );
	}

	public function testFileWithoutPaceData() {
		$this->object->parseFile('../tests/testfiles/hrm/15031101.spinning.hrm');

		$this->assertFalse( $this->object->failed() );

		$this->assertEquals( "11.03.2015 20:18:33", date("d.m.Y H:i:s", $this->object->object()->getTimestamp()) );
		$this->assertEquals( 0.0, $this->object->object()->getDistance() );
		$this->assertEquals( 61*60 + 29.1, $this->object->object()->getTimeInSeconds() );

		$this->assertTrue( $this->object->object()->hasArrayHeartrate() );
	}

	public function testFileWithoutPaceDataAgain() {
		$this->object->parseFile('../tests/testfiles/hrm/15031801.spinning.hrm');

		$this->assertFalse( $this->object->failed() );

		$this->assertEquals( "18.03.2015 20:15:48", date("d.m.Y H:i:s", $this->object->object()->getTimestamp()) );
		$this->assertEquals( 0.0, $this->object->object()->getDistance() );
		$this->assertEquals( 63*60 + 34.8, $this->object->object()->getTimeInSeconds() );

		$this->assertTrue( $this->object->object()->hasArrayHeartrate() );
	}
}