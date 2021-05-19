<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class generatorTest extends TestCase
{
    public function testCanRun(): void
    {
        $lMain = new ConfigGenerator\ConfigGenerator();
        $this->assertIsString($lMain->run());
    }
}