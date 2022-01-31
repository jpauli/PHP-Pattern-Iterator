<?php

use Iterator\StepIterator;
use PHPUnit\Framework\TestCase;

class StepIteratorTest extends TestCase
{
    private StepIterator $it;

    public function setup() : void
    {
        $this->it = new StepIterator(3, ['foo', 'bar', 42, 67, 'baz', 99]);
    }

    public function testIteration()
    {
        $this->assertIsIterable($this->it);
        $this->assertContains('foo', $this->it);
        $this->assertContains(67, $this->it);

        $i = 0;
        foreach($this->it as $v) {
            $i++;
        }

        $this->assertEquals(2, $i);
    }

    public function testGenerator()
    {
        $gen = $this->it->toGenerator();
        $this->assertIsIterable($gen);
        $this->assertInstanceOf(Generator::class, $gen);
        $this->assertContains('foo', $gen);
        $this->assertContains(67, $gen);
    }
}