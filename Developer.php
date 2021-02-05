<?php
require_once 'Position.php';

class Developer implements Position
{

    private $programmingLanguage;
    private $years;

    private $position;


    public function __construct(string $programmingLanguage, int $years)
    {
        $this->programmingLanguage = $programmingLanguage;
        $this->years = $years;
    }

    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    public function getPosition(): string
    {
        return $this->position;
    }
}
