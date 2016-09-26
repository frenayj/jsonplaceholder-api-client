<?php
/**
 * Created by PhpStorm.
 * User: jeremy
 * Date: 26/09/2016
 * Time: 10:00
 */

namespace AppBundle\Controller;

use AppBundle\Model\Post;
use Circle\RestClientBundle\Exceptions\CurlException;
use Circle\RestClientBundle\Exceptions\OperationTimedOutException;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PostController
 * @package AppBundle\Controller
 */
class PostController extends BaseController
{
    use LoggerAwareTrait;

    /**
     * @param Request $request
     *
     * @Route("/favourite_posts")
     */
    public function getFavouritePosts(Request $request)
    {
        try {
            // Using the 3rd Party APIClient to retrieve Data
            if ($ids = $request->get('id')) {
                $posts = $this->client->getPosts($ids);
            } else {
                $posts = $this->client->getPosts();
            }

            // Build the View with a Transformer
            $view = $this->generateCollectionData($posts, $this->transformer, Post::ENTITY_TYPE);

            return new JsonResponse($view, 200);

        } catch (OperationTimedOutException $exception) {
            return new JsonResponse(sprintf('3rd Party Service Time out.'), 500);
        } catch (CurlException $exception) {
            return new JsonResponse(sprintf('An error occurred: %s', $exception->getMessage()), 500);
        }
    }
}