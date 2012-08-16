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

use FPN\TagBundle\Entity\TagManager as BaseTagManager,
    FPN\TagBundle\Util\SlugifierInterface,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Query\Expr;

/**
 * MZJ\YabBundle\Entity\TagManager
 *
 * This TagManager extends FPN\TagBundle\Entity\TagManager
 * and overrides getTagging method. Now mentined method uses fetch join 
 * for Tag entities, and result cache is added
 *
 * @author Marko Jovanovic <markozjovanovic@gmail.com>
 */
class TagManager extends BaseTagManager
{    
    protected function getTagging(\DoctrineExtensions\Taggable\Taggable $resource)
    {
        return $this->em
                    ->createQueryBuilder()

                    ->select('t, t2')
                    ->from($this->tagClass, 't')

                    ->innerJoin('t.tagging', 't2', Expr\Join::WITH, 't2.resourceId = :id AND t2.resourceType = :type')
            
                    ->setParameter('id', $resource->getTaggableId())
                    ->setParameter('type', $resource->getTaggableType())
            
                    ->getQuery()
             
                    ->useResultCache(true, 30)
                    
                    ->getResult();
        ;
    }
}
