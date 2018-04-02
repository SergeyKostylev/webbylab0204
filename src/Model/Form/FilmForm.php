<?php
namespace Model\Form;

class FilmForm
{
    public $name;
    public $year;
    public $format;
    public $actors;

    public function __construct($name, $year, $format, $actors)
    {
        $this->name = $name;
        $this->year = $year;
        $this->format = $format;
        $this->actors = $actors;
    }


    public function isValidYear()
    {
        return preg_match("/^[1-2]{1}[0-9]{3}$/" , $this->year);
    }

    public function isValid()
    {
        return  !empty($this->name) &&
                !empty($this->format) &&
                !empty($this->actors) &&
                $this->isValidYear()
            ;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param mixed $format
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * @param mixed $actors
     */
    public function setActors($actors)
    {
        $this->actors = $actors;

        return $this;
    }



}