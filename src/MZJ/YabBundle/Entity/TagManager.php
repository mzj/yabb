<?php

namespace MZJ\YabBundle\Entity;

use FPN\TagBundle\Entity\TagManager as BaseTagManager;
use Doctrine\ORM\EntityManager;
use FPN\TagBundle\Util\SlugifierInterface;
use Doctrine\ORM\Query\Expr;

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
            ->getResult()
        ;
    }
}
