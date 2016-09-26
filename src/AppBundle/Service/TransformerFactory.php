<?php
/**
 * Created by PhpStorm.
 * User: jeremy
 * Date: 26/09/2016
 * Time: 10:00
 */

namespace AppBundle\Service;

/**
 * Class TransformerFactory
 * @package AppBundle\Service
 */
class TransformerFactory
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public static function createTransformer()
    {
        $args = func_get_args();
        $className = $args[0];

        if (class_exists($className)) {
            $service = new $className(...array_slice($args, 1));
            return $service;
        }
        else {
            throw new \Exception("Invalid transformer type given.");
        }
    }
}