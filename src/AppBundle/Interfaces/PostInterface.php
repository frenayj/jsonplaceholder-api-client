<?php

/**
 * Created by PhpStorm.
 * User: jeremy
 * Date: 26/09/2016
 * Time: 10:00
 */
namespace AppBundle\Interfaces;

interface PostInterface
{
    public function setId($id);

    public function getId();

    public function getTitle();

    public function getBody();

    public function getUserId();

    public function getUserName();

    public function getUserEmail();
}