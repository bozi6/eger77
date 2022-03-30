<?php namespace CodeIgniter\Database\Builder;

use Tests\Support\Database\MockConnection;

class PrefixTest extends \CIUnitTestCase
{
	protected $db;

	//--------------------------------------------------------------------

	public function testPrefixesSetOnTableNames()
	{
		$expected = 'ci_users';

		$this->assertEquals($expected, $this->db->prefixTable('users'));
	}

	//--------------------------------------------------------------------

	protected function setUp(): void
	{
		parent::setUp();

		$this->db = new MockConnection(['DBPrefix' => 'ci_']);
	}

	//--------------------------------------------------------------------

}
