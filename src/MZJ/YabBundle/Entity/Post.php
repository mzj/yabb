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

use DoctrineExtensions\Taggable\Taggable;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * MZJ\YabBundle\Entity\Post
 *
 * Post entity
 *
 * @author Marko Jovanovic <markozjovanovic@gmail.com>
 */
class Post implements Taggable
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $content
     */
    private $content;

    /**
     * @var \DateTime $created_at
     */
    private $created_at;

    /**
     * @var \DateTime $updated_at
     */
    private $updated_at;

    /**
     * @var string $slug
     */    
    private $slug;
    
    /**
     * @var ArrayCollection $comments
     */    
    private $comments;
    
    /**
     * @var ArrayCollection $categories
     */    
    private $categories;    
    
    
    /**
     * @var boolean $enabled
     */    
    private $enabled = true;     
    
    /**
     * @var boolean $commentsEnabled
     */    
    private $commentsEnabled = false; 
    
    /**
     * 
     */
    private $tags;
    
    /**
     *
     * @var string 
     */
    private $abstract;
    
    /**
     * 
     */
    public function __construct() 
    {
        $this->created_at = new \DateTime('now');
    }
    
    /**
     * 
     * @return type
     */
    public function getTags()
    {
        $this->tags = $this->tags ?: new ArrayCollection();

        return $this->tags;
    }

    /**
     * 
     * @return string
     */
    public function getTaggableType()
    {
        return 'post_tag';
    }

    /**
     * 
     * @return type
     */
    public function getTaggableId()
    {
        return $this->getId();
    }
    
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
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }
    
    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Post
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }



    /**
     * Set slug
     *
     * @param string $slug
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add comments
     *
     * @param MZJ\YabBundle\Entity\Comment $comments
     * @return Post
     */
    public function addComment(\MZJ\YabBundle\Entity\Comment $comments)
    {
        //$comment->setPost($this);
        
        $this->comments[] = $comments;
        
        return $this;
    }

    /**
     * Remove comments
     *
     * @param MZJ\YabBundle\Entity\Comment $comments
     */
    public function removeComment(\MZJ\YabBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add categories
     *
     * @param MZJ\YabBundle\Entity\Category $categories
     * @return Post
     */
    public function addCategorie(\MZJ\YabBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;
    
        return $this;
    }

    /**
     * Remove categories
     *
     * @param MZJ\YabBundle\Entity\Category $categories
     */
    public function removeCategorie(\MZJ\YabBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }
    
    /**
     * Add categories
     *
     * @param MZJ\YabBundle\Entity\Category $categories
     * @return Post
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    
        return $this;
    }
    
 
    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
    
    /**
     * Set enabled
     *
     * @return boolean
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }
    
    /**
     * Get commentsEnabled
     *
     * @return boolean
     */
    public function getCommentsEnabled()
    {
        return $this->commentsEnabled;
    }
    
    /**
     * Set commentsEnabled
     *
     * @return boolean
     */
    public function setCommentsEnabled($commentsEnabled)
    {
        $this->commentsEnabled = $commentsEnabled;
    }
    
    /**
     * 
     * @return type
     */
    public function getAbstract()
    {
        return $this->abstract;
    }
    
    /**
     * 
     * @param type $abstract
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;
    }
}