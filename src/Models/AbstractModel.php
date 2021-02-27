<?php

namespace YouTube\Models;

abstract class AbstractModel
{
    public function __construct($array)
    {
        if (is_array($array)) {
            $this->fillFromArray($array);
        }
    }

    public static function fromArray($array)
    {
        return new static($array);
    }

    private function fillFromArray($array)
    {
        foreach ($array as $key => $val) {
            if (property_exists($this, $key)) {
                $this->{$key} = $val;
            }
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
}