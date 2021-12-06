<?php


class Film
{
    public $Id;
    public $Name;
    public $Year;
    public $UserId;

    /**
     * Film constructor.
     * @param $Id
     * @param $Name
     * @param $Year
     * @param $UserId
     */
    public function __construct($Id, $Name, $Year,  $UserId)
    {
        $this->Id = $Id;
        $this->Name = $Name;
        $this->Year = $Year;
        $this->UserId = $UserId;
    }
}