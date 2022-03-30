<?php
namespace CodeIgniter\Helpers;

final class DateHelperTest extends \CIUnitTestCase
{

	private $name;
	private $value;
	private $expire;
	private $response;

	public function testNowDefault()
	{
		$time = new \DateTime();
		$this->assertCloseEnough(now(), time());  // close enough
	}

	//--------------------------------------------------------------------

	public function testNowSpecific()
	{
		// Chicago should be two hours ahead of Vancouver
		$this->assertCloseEnough(7200, now('America/Chicago') - now('America/Vancouver'));
	}

	//--------------------------------------------------------------------

	protected function setUp(): void
	{
		parent::setUp();
		helper('date');
	}

}
