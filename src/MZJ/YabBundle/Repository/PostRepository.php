<?php

/*
 * This file is part of the Yabb package.
 *
 * (c) Marko Jovanovic <markozjovanovic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MZJ\YabBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * MZJ\YabBundle\Repository\PostRepository
 *
 * Post repository
 *
 * @author Marko Jovanovic <markozjovanovic@gmail.com>
 */
class PostRepository extends EntityRepository
{
    /**
     * 
     * @return type
     */
    public function getPosts()
    {
        $query = $this->_em
                      ->createQuery("SELECT p, c
                                     FROM MZJ\YabBundle\Entity\Post p
                                     JOIN p.categories c
                                     ORDER BY p.created_at DESC, p.id DESC
                                   ");
        return $query->getResult();
    }
    
    /**
     * 
     * @return type
     */
    public function getPost($id)
    {
        $query = $this->_em
                      ->createQuery("SELECT p
                                     FROM MZJ\YabBundle\Entity\Post p
                                     WHERE p.id = :id
                                   ");
        $query->setParameter('id', $id);
        return $query->getSingleResult();
    }
    
    /**
     * 
     * @param type $category
     */
    public function getPostsInCategory($category) 
    {
        $left  = $category->getLft();
        $right = $category->getRgt();
        
        $query = $this->_em->createQuery("SELECT p, c 
                                          FROM MZJ\YabBundle\Entity\Post p
                                          JOIN p.categories c
                                          WHERE c.lft BETWEEN ?1 AND ?2");
        $query->setParameters(array(
                1 => $left,
                2 => $right
            ));
        
        return $query->getResult();
    }
    
    /**
     * 
     * @return type
     */
    public function getPostsWithIds(array $ids)
    {
        $query = $this->_em
                      ->createQuery("SELECT p
                                     FROM MZJ\YabBundle\Entity\Post p
                                     WHERE p.id IN (:ids)
                                   ");
        $query->setParameter('ids', $ids);
        
        return $query->getResult();
    }
}
