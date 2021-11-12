<?php


namespace app\fileStore;


use Iterator;
use SplFileObject;


class FileStore implements Iterator
{

    protected int $index = 0;

    private string $filename;

    private $file;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->file = new SplFileObject("data.txt");
    }

    /**
     * Return the current element
     * @link https://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        $this->generator();
        return null;
    }

    function generator(){
        while (!$this->file->eof()) {
            yield $this->file->fgets();
        }
    }

    /**
     * Move forward to next element
     * @link https://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        $this->index++;
    }

    /**
     * Return the key of the current element
     * @link https://php.net/manual/en/iterator.key.php
     * @return int|null scalar on success, or null on failure.
     */
    public function key(): int
    {
        return $this->index;
    }

    /**
     * Checks if current position is valid
     * @link https://php.net/manual/en/iterator.valid.php
     * @return bool The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid(): bool
    {
        return isset($this->lines[$this->index]);
    }

    /**
     * Rewind the Iterator to the first element
     * @link https://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->index = 0;
    }
}