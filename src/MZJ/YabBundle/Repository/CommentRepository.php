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

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
/**
 * MZJ\YabBundle\Repository\CommentRepository
 *
 * Comment repository
 *
 * @author Marko Jovanovic <markozjovanovic@gmail.com>
 */
class CommentRepository extends NestedTreeRepository
{    
    /**
     * Strips root category
     * 
     * @return array 
     */
    public function getAsArray($postId) 
    {
        $q = $this->_em->createQueryBuilder()
                        ->select('node')
                        ->from('MZJ\YabBundle\Entity\Comment', 'node')
                        ->join('node.post', 'post')
                        ->orderBy('node.root, node.lft', 'ASC')
                        ->where('post.id = :pid')
                        ->getQuery();
        $q->setParameter('pid', $postId);
        $comments = $q->getArrayResult();
        
        return $comments;        
    }
}
