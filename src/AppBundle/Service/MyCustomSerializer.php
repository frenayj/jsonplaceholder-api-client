<?php
/**
 * Created by PhpStorm.
 * User: jeremy
 * Date: 26/09/2016
 * Time: 10:00
 */

namespace AppBundle\Service;

use League\Fractal\Serializer\ArraySerializer;

/**
 * Class MyCustomSerializer
 * @package AppBundle\Service
 */
class MyCustomSerializer extends ArraySerializer
{
    /**
     * Serialize a collection.
     *
     * @param string $resourceKey
     * @param array  $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data)
    {
        return $data;
    }

    /**
     * Serialize an item.
     *
     * @param string $resourceKey
     * @param array  $data
     *
     * @return array
     */
    public function item($resourceKey, array $data)
    {
        return $data;
    }

    /**
     * Serialize null resource.
     *
     * @return array
     */
    public function null()
    {
        return [];
    }

}