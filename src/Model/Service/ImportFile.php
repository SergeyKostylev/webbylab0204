<?php


namespace Model\Service;

class ImportFile
{
    private $name;
    private $type;
    private $tmp_name;
    private $size;

    public function __construct($name, $type, $tmp_name, $size)
    {
        $this->name = $name;
        $this->type = $type;
        $this->tmp_name = $tmp_name;
        $this->size = $size;
    }
    public function isValid()
    {
        return      !empty($this->name) &&
                    !empty($this->type) &&
                    !empty($this->tmp_name) &&
                    !empty($this->size )
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
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getTmpName()
    {
        return $this->tmp_name;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

}