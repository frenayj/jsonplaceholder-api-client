<?php

/**
 * Created by PhpStorm.
 * User: jeremy
 * Date: 26/09/2016
 * Time: 10:00
 */
namespace AppBundle\Model;

use AppBundle\Interfaces\ItemInterface;
use AppBundle\Interfaces\PostInterface;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;

/**
 * @Serializer\AccessType("public_method")
 */
class Post implements PostInterface, ItemInterface
{
    const ENTITY_TYPE = "post";

    /**
     * @Type("integer")
     */
    protected $id;

    /**
     * @Serializer\SerializedName("userId")
     * @Type("integer")
     */
    protected $userId;

    /**
     * @Type("string")
     */
    protected $title;

    /**
     * @Type("string")
     */
    protected $body;

    /**
     * @var string
     */
    protected $userName;

    /**
     * @var string
     */
    protected $userEmail;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @param string $userEmail
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    }
}
