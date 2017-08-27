<?php
/**
 * User: Script
 * Date: 27.08.2017
 * Time: 6:13
 */

namespace Geega\Simplex;

/**
 * Class MSO - Memory storage objects
 * @package Geega\Simplex
 */
class MSO
{
    /**
     * @var object
     */
    static private $map;

    /**
     * Get object
     * @param $name
     * @return mixed
     */
    static public function get($name)
    {
        return self::$map->$name;
    }

    /**
     * Set object
     * @param $name
     * @param $dependency
     */
    static public function set($name, $dependency)
    {
        if(self::$map === null) {
            self::$map = (object) array();
        }
        self::$map->$name = $dependency;
    }
}