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
}
