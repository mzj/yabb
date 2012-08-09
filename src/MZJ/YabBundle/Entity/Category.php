<?php

namespace MZJ\YabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MZJ\YabBundle\Entity\Category
 */
class Category
{
    const NO_PARENT = '-- Without parent --';
    
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var integer $lft
     */
    private $lft;

    /**
     * @var integer $rgt
     */
    private $rgt;

    /**
     * @var integer $lvl
     */
    private $lvl;

    /**
     * @var integer $root
     */
    private $root;

    /**
     * @var Category $parent
     */
    private $parent;

    /**
     * @var ArrayCollection $children
     */
    private $children;

    /**
     * @var string $slug
     */
    private $slug;

    /**
     * @var ArrayCollection $posts
     */
    private $posts;

    /**
     *
     * @var type 
     */
    private $indentedName;
    
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
     * Indents the name of a category depending on level
     */
    public function getIndentedName()
    {
        $indent = ($this->lvl >= 1) ? $this->lvl - 1 : $this->lvl;
        $name   = $this->parent ? $this->getName() : self::NO_PARENT;       
        
        return str_repeat(' |— ', $indent) . ' ' . $name;
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return Category
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
     * Set description
     *
     * @param string $description
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set lft
     *
     * @param integer $lft
     * @return Category
     */
    public function setLft($lft)
    {
        $this->lft = $lft;
    
        return $this;
    }

    /**
     * Get lft
     *
     * @return integer 
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     * @return Category
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;
    
        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer 
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return Category
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;
    
        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer 
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set root
     *
     * @param integer $root
     * @return Category
     */
    public function setRoot($root)
    {
        $this->root = $root;
    
        return $this;
    }

    /**
     * Get root
     *
     * @return integer 
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set parent
     *
     * @param \stdClass $parent
     * @return Category
     */
    public function setParent(\MZJ\YabBundle\Entity\Category $parent)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \stdClass 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set children
     *
     * @param \stdClass $children
     * @return Category
     */
    public function setChildren($children)
    {
        $this->children = $children;
    
        return $this;
    }

    /**
     * Get children
     *
     * @return \stdClass 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Category
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
     * Set posts
     *
     * @param \stdClass $posts
     * @return Category
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;
    
        return $this;
    }

    /**
     * Get posts
     *
     * @return \stdClass 
     */
    public function getPosts()
    {
        return $this->posts;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add children
     *
     * @param Entity\Category $children
     * @return Category
     */
    public function addCategory(\MZJ\YabBundle\Entity\Category $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param Entity\Category $children
     */
    public function removeChildren(Category $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Add posts
     *
     * @param MZJ\YabBundle\Entity\Post $posts
     * @return Category
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
     * Add children
     *
     * @param MZJ\YabBundle\Entity\Category $children
     * @return Category
     */
    public function addChildren(\MZJ\YabBundle\Entity\Category $children)
    {
        $this->children[] = $children;
    
        return $this;
    }
    
    /**
     * @return string
     */
    public function __toString() 
    {
        return $this->name;
    }
}