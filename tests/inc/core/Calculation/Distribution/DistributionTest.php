<?php

namespace Runalyze\Calculation\Distribution;

class Distribution_MockTester extends Distribution {
	public function histogram() {
		return array(
			10 => 1,
			15 => 2,
			20 => 1
		);
	}
}

/**
 * Generated by hand
 */
class DistributionTest extends \PHPUnit_Framework_TestCase {

	public function testMock() {
		$Dist = new Distribution_MockTester();

		$this->assertEquals( array(
			10 => 1,
			15 => 2,
			20 => 1
		), $Dist->histogram() );

		$Dist->calculateStatistic();

		$this->assertEquals( 10, $Dist->min() );
		$this->assertEquals( 15, $Dist->mean() );
		$this->assertEquals( 20, $Dist->max() );
		$this->assertEquals( 12.5, $Dist->variance() );
	}

}