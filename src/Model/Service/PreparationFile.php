<?php


namespace Model\Service;

use Model\Repository\FormatRepository;

class PreparationFile
{
    private $name;
    private $year;
    private $format;
    private $actors=[];
    private $filmInMas=[];
    private $allFormats;


    public function __construct($filmMas, $all_formats = [] )
    {
        $this->filmInMas = $filmMas;
        $this->allFormats = $all_formats;

        $this->name = (preg_match('/^(Title: )[A-Za-z -:,]+$/',$this->filmInMas[0])) ? substr($this->filmInMas[0],7 ) : null;

        $this->year = (preg_match('/^(Release Year: )[1-2][0-9]{3}[ ]*$/',$this->filmInMas[1])) ? trim(substr($this->filmInMas[1],14 )) : null;

        $this->format = $this->getFormatId();

        $this->actors = $this->getActorsMas();

    }

    public function readyToLoad()
    {
        return
            !empty ($this->name) &&
            !empty ($this->year) &&
            !empty ($this->format)
            ;
    }
    public function getActorsMas()
    {
        $actorsStr = (preg_match('/^(Stars: )[A-Za-z- ,]+$/',$this->filmInMas[3])) ? substr($this->filmInMas[3],7 ) : false;

        $actors_mas = ($actorsStr) ?  explode(', ', $actorsStr) : null;

        return $actors_mas;
    }

    private function getFormatId()
    {
        $format_name = (preg_match('/^(Format: )[A-Za-z -]+$/',$this->filmInMas[2])) ? trim(substr($this->filmInMas[2],8 )) : false;

        $format_id = null;
        if($format_name){
            foreach ($this->allFormats as $format){
                if ($format->getName() == $format_name ){
                    $format_id = $format->getId();
                    break;
                }
            }
        }
        return $format_id;
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
     * @return array
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * @param array $actors
     */
    public function setActors($actors)
    {
        $this->actors = $actors;

        return $this;
    }


}