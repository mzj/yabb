<?php

/*
 * This file is part of the Yabb package.
 *
 * (c) Marko Jovanovic <markozjovanovic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MZJ\YabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MZJ\YabBundle\Entity\Tag
 *
 * Tag entity
 *
 * @author Marko Jovanovic <markozjovanovic@gmail.com>
 */
class Tag
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $name
     */
    private $posts;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add posts
     *
     * @param MZJ\YabBundle\Entity\Post $posts
     * @return Tag
     */
    public function addPost(\MZJ\YabBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;
    
        return $this;
    }

    /**
     * Remove posts
     *
     * @param MZJ\YabBundle\Entity\Post $posts
     */
    public function removePost(\MZJ\YabBundle\Entity\Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }
    
    /**
     * 
     */
    public function __toString() 
    {
        return $this->name;
    }
}