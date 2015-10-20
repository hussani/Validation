<?php
namespace Respect\Validation\Rules;


class ImeiTest extends \PHPUnit_Framework_TestCase
{
    protected $imeiValidator;
    public function setUp()
    {
        $this->imeiValidator = new Imei();
    }

    /**
     * @param string $validImei
     * @dataProvider validImeisProvider
     */
    public function testImeisWithValidLenghtShouldReturnTrue($validImei)
    {
        $this->assertTrue($this->imeiValidator->validate($validImei));
    }

    /**
     * @param string $invalidImei
     * @dataProvider invalidImeisProvider
     */
    public function testImeisWithInvalidLenghtShouldReturnFalse($invalidImei)
    {
        $this->assertFalse($this->imeiValidator->validate($invalidImei));
    }

    public function validImeisProvider()
    {
        return [
            ['355873847928122'],
            ['490154203237518'],
        ];
    }

    public function invalidImeisProvider()
    {
        return [
            ['3558738122'],
            ['3558738479281221231232']
        ];
    }
}
 