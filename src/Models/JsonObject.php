<?php

namespace YouTube\Models;

use YouTube\Utils\Utils;

abstract class JsonObject
{
    protected array $_data = [];

    final public function __construct(array $data)
    {
        $this->_data = $data;

        foreach ($data as $key => $val) {
            if (property_exists($this, $key)) {
                $this->{$key} = $val;
            }
        }
    }

    /**
     * Get an item from an array using "dot" notation.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function deepGet(string $key, $default = null)
    {
        return Utils::arrayGet($this->_data, $key, $default);
    }

    public function toArray(): array
    {
        return $this->_data;
    }
}