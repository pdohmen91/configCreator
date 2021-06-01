<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

/**
 * generatorTest
 * 
 * @package ConfigCreator
 * @author Peter Dohmen peterdohmen.de
 */
final class generatorTest extends TestCase
{
    
    public $configInExample = <<<EOD
    {
        "server": {
            "database": {
                "db.host": {
                    "name": "Database Host",
                    "breaking": true
                }
            }
        }
    }
    EOD;
    
    /**
     * TestCanRun
     *
     * @return void
     */
    public function testCanRun(): void
    {
        $lMain = new ConfigGenerator\ConfigGenerator();
        $this->assertIsString($lMain->run());
        $this->assertEquals(mb_detect_encoding($lMain->getConfigIn(), 'UTF-8', TRUE), 'UTF-8');
    }
    
    /**
     * testJsonParser
     *
     * @return void
     */
    public function testJsonParser(): void
    {
        $lInValidJson = <<<EOD
        {
            "server": {
                "database": {
                    "db.host": {
                        "name": "Database Host"
                        "breaking": true
                    }
                }
            }
        }
        EOD;

        $lMain = new ConfigGenerator\ConfigGenerator();
        $this->assertIsArray($lMain->parseConfigurationInput($this->configInExample));
        $this->assertEmpty($lMain->parseConfigurationInput($lInValidJson));
    }
    
    /**
     * testGetSetConfigIn
     *
     * @return void
     */
    public function testGetSetConfigIn(): void
    {
        $lMain = new ConfigGenerator\ConfigGenerator();
        $lMain->setConfigIn($this->configInExample);

        $this->assertEquals($lMain->getConfigIn(), $this->configInExample);
    }
}
