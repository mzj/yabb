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
    public function getAsArray() 
    {
        $comments = $this->childrenQuery(null, false, array('root', 'id'))->getArrayResult();
        //unset($comments[0]);
        return $comments;        
    }
}
