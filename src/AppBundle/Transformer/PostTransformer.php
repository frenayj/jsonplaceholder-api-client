<?php

/**
 * Created by PhpStorm.
 * User: jeremy
 * Date: 26/09/2016
 * Time: 10:00
 */
namespace AppBundle\Transformer;

use AppBundle\Interfaces\PostInterface;
use AppBundle\Interfaces\TransformerInterface;
use League\Fractal\TransformerAbstract;

/**
 * Class PostTransformer
 * @package AppBundle\Transformer
 */
class PostTransformer extends TransformerAbstract implements TransformerInterface
{
    /**
     * @param PostInterface $post
     * @return array
     */
    public function transform(PostInterface $post)
    {
        return [
            "post_id" => $post->getId(),
            "title" => $post->getTitle(),
            "body" => $post->getBody(),
            "user" => array(
                "id" => $post->getUserId(),
                "name" => $post->getUserName(),
                "email" => $post->getUserEmail(),
            ),
        ];
    }


}