<?php

namespace MZJ\YabBundle\Service;


use JMS\AopBundle\Aop\PointcutInterface,
    Doctrine\Common\Annotations\Reader;

class LoggingPointcut implements PointcutInterface
{
    private $reader;
    
    public function __construct(Reader $reader) 
    {
        $this->reader = $reader;
    }
    
    
    public function matchesClass(\ReflectionClass $class)
    {
        return true;
    }

    public function matchesMethod(\ReflectionMethod $method)
    {
         return null !== $this->reader->getMethodAnnotation($method, 'MZJ\YabBundle\Annotation\Transactional');
    }
}