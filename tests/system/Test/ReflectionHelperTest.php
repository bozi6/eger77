<?php namespace CodeIgniter\Test;

class ReflectionHelperTest extends \CIUnitTestCase
{
	public function testGetPrivatePropertyWithObject()
	{
		$obj    = new __TestForReflectionHelper();
		$actual = $this->getPrivateProperty($obj, 'private');
		$this->assertEquals('secret', $actual);
	}

	public function testGetPrivatePropertyWithObjectStaticCall()
	{
		$obj    = new __TestForReflectionHelper();
		$actual = \CIUnitTestCase::getPrivateProperty($obj, 'private');
		$this->assertEquals('secret', $actual);
	}

	public function testGetPrivatePropertyWithStatic()
	{
		$actual = $this->getPrivateProperty(
			__TestForReflectionHelper::class, 'static_private'
		);
		$this->assertEquals('xyz', $actual);
	}

	public function testSetPrivatePropertyWithObject()
	{
		$obj = new __TestForReflectionHelper();
		$this->setPrivateProperty(
			$obj, 'private', 'open'
		);
		$this->assertEquals('open', $obj->getPrivate());
	}

	public function testSetPrivatePropertyWithStatic()
	{
		$this->setPrivateProperty(
			__TestForReflectionHelper::class, 'static_private', 'abc'
		);
		$this->assertEquals(
			'abc', __TestForReflectionHelper::getStaticPrivate()
		);
	}

	public function testGetPrivateMethodInvokerWithObject()
	{
		$obj    = new __TestForReflectionHelper();
		$method = $this->getPrivateMethodInvoker(
			$obj, 'privateMethod'
		);
		$this->assertEquals(
			'private param1param2', $method('param1', 'param2')
		);
	}

	public function testGetPrivateMethodInvokerWithStatic()
	{
		$method = $this->getPrivateMethodInvoker(
			__TestForReflectionHelper::class, 'privateStaticMethod'
		);
		$this->assertEquals(
			'private_static param1param2', $method('param1', 'param2')
		);
	}
}

class __TestForReflectionHelper
{
	private static $static_private = 'xyz';
	private $private               = 'secret';

	public static function getStaticPrivate()
	{
		return self::$static_private;
	}

	private static function privateStaticMethod($param1, $param2)
	{
		return 'private_static ' . $param1 . $param2;
	}

	public function getPrivate()
	{
		return $this->private;
	}

	private function privateMethod($param1, $param2)
	{
		return 'private ' . $param1 . $param2;
	}
}
