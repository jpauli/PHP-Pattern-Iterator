<?php

namespace Iterator;

class StepIterator implements \Iterator
{
    private array $keys;
    private array $values;
    private int $pos = 0;
    private readonly int $total;

    public function __construct(private readonly int $step, array $data)
    {
        $this->keys   = array_keys($data);
        $this->values = array_values($data);
        $this->total  = count($data);
    }

    public function current() : mixed
    {
        return $this->values[$this->pos];
    }

    public function next(): void
    {
        $this->pos += $this->step;
    }

    public function key() : mixed
    {
        return $this->keys[$this->pos];
    }

    public function valid(): bool
    {
        return $this->pos < $this->total;
    }

    public function rewind(): void
    {
        $this->pos = 0;
    }

    public function toGenerator() : \Generator
    {
        return self::asGenerator($this->step, array_combine($this->keys, $this->values));
    }

    public static function asGenerator(int $step, array $data) : \Generator
    {
        $keys   = array_keys($data);
        $values = array_values($data);
        $total  = count($data);

        for ($i=0; $i < $total; $i += $step) {
            yield $keys[$i] => $values[$i];
        }
    }
}