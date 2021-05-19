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
}