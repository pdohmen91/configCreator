<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

/**
 * generatorTest
 */
final class generatorTest extends TestCase
{    
    /**
     * TestCanRun
     *
     * @return void
     */
    public function testCanRun(): void
    {
        $lMain = new ConfigGenerator\ConfigGenerator();
        $this->assertIsString($lMain->run());
    }

    public function testJsonParser(): void 
    {
        $lValidJson = <<<EOD
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
        $this->assertIsArray($lMain->parseConfigurationInput($lValidJson));
        $this->assertEmpty($lMain->parseConfigurationInput($lInValidJson));

    }
}