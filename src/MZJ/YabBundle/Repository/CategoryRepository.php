<?php

namespace MZJ\YabBundle\Repository;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends NestedTreeRepository
{    
    /**
     * Strips root category
     * 
     * @return array 
     */
    public function getArrWithoutRoot() 
    {
        $categories = $this->childrenQuery()->getArrayResult();
        unset($categories[0]);
        
        return $categories;        
    }
    
}
