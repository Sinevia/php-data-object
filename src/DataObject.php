<?php

namespace Sinevia;

use \OutOfRangeException;

class DataObject {

    /**
     * The data of the object
     * @var array
     */
    public $data = array();

    /**
     * The changed data of the object
     * @var array
     */
    public $data_changed = array();

    /**
     * Gets a property field value. If the property is not defined
     * in the data OutOfRangeException will be thrown.
     * @param $name String the name of the property
     * @throws InvalidArgumentException if the given parameter is not string 
     * @throws OutOfRangeException if the parameter is not in the data
     */
    function get($name) {
        if (is_string($name) == false) {
            throw new InvalidArgumentException("The first parameter in the get method in " . get_class($this) . " MUST be of type String: <b>" . gettype($name) . "</b> given");
        }

        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        } else {
            throw new OutOfRangeException("There is no $name field in " . get_class($this) . "!");
        }
    }

    /**
     * @param String $name
     * @param String $value
     * @throws InvalidArgumentException
     * @throws OutOfRangeException
     */
    public function set($name, $value) {
        if (is_string($name) == false) {
            throw new InvalidArgumentException("The first parameter in the set method class " . get_class($this) . " MUST be of type String: <b>" . gettype($name) . "</b> given");
        }

        if (array_key_exists($name, $this->data)) {
            if ($this->data[$name] != $value) {
                $this->data[$name] = $value;
                $this->data_changed[$name] = $value;
            }
        } else {
            $this->data[$name] = $value;
            $this->data_changed[$name] = $value;
        }
    }

}
