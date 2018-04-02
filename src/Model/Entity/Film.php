<?php

namespace Model\Entity;

class Film
{
    private $id;
    private $name;
    private $year;
    private $format;
    private $actors;

    public function __construct($id = null, $name = null, $year = null, $format = null, $actors = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->year = $year;
        $this->format = $format;
        $this->actors = $actors;
    }

    public function masIsValid($film_mas)
    {


        return  true;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param null $year
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return null
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param null $format
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @return null
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * @param null $actors
     */
    public function setActors($actors)
    {
        $this->actors = $actors;

        return $this;
    }



}
