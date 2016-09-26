<?php
/**
 * Created by PhpStorm.
 * User: jeremy
 * Date: 26/09/2016
 * Time: 10:00
 */

namespace AppBundle\Controller;

use AppBundle\Interfaces\ItemInterface;
use AppBundle\Interfaces\TransformerInterface;
use AppBundle\Service\ApiClient;
use AppBundle\Service\MyCustomSerializer;
use AppBundle\Service\ViewManager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

/**
 * Class BaseController
 * @package AppBundle\Controller
 */
abstract class BaseController
{
    /**
     * @var ApiClient
     */
    protected $client;

    /**
     * @var \League\Fractal\Manager
     */
    protected $fractal;

    /**
     * @var TransformerInterface
     */
    protected $transformer;

    /**
     * BaseController constructor.
     * @param ApiClient $client
     * @param ViewManager $viewManager
     * @param string $apiBaseUrl
     * @param TransformerInterface $transformer
     */
    public function __construct(ApiClient $client, ViewManager $viewManager, TransformerInterface $transformer)
    {
        $this->client =$client;
        $this->fractal = $viewManager;
        $this->transformer = $transformer;
    }

    protected function setFractal()
    {
        //set up Fractal
        $this->fractal->setSerializer(new MyCustomSerializer());
    }

    protected function setIncludes()
    {
        //set up includes
        if (isset($_GET['include'])) {
            $this->fractal->parseIncludes($_GET['include']);
        }
    }

    /**
     * @param $item
     * @param TransformerInterface $entityTransformer
     * @param $entityClass
     * @return array
     */
    protected final function generateItemData(ItemInterface $item, TransformerInterface $entityTransformer, $entityType)
    {
        $this->setFractal();
        $this->setIncludes();

        // Build fractal Item from object.
        $item = new Item($item, $entityTransformer, $entityType);
        // Generate view from Item.
        $data = $this->fractal->createData($item)->toArray();

        return $data;
    }

    /**
     * @param $items
     * @param $entityTransformer
     * @param $entityClass
     * @return array
     */
    protected final function generateCollectionData($items, $entityTransformer, $entityClass)
    {
        $this->setFractal();
        $this->setIncludes();

        // Build fractal Collection from objects.
        $collection = new Collection($items, $entityTransformer, $entityClass);
        // Generate view from Collection.
        $data = $this->fractal->createData($collection)->toArray();

        return $data;
    }
}
