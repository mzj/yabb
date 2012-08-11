<?php
// src/MZJ/YabBundle/DataFixtures/ORM/CategoryFixtures.php

namespace MZJ\YabBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager,
    MZJ\YabBundle\Entity\Comment;

class CommentFixtures extends AbstractFixture implements OrderedFixtureInterface
{ 
    /**
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $comm1 = new Comment();
        $comm1->setName('Marko');
        $comm1->setContent('Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
                );
        $comm1->setPost($manager->merge($this->getReference('post5')));
        $comm1->setLikes(10);
        $comm1->setDislikes(2);
        
        $comm2 = new Comment();
        $comm2->setName('Marko');
        $comm2->setContent('@Marko - Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
                );
        $comm2->setPost($manager->merge($this->getReference('post5')));
        $comm2->setLikes(4);
        $comm2->setDislikes(8);
        
        
        $manager->persist($comm1);
        $manager->persist($comm2);
        
        $manager->flush();
    }
    
    /**
     * OrderedFixtureInterface method
     * Specifies in what order fixtures should be loaded
     * 
     * @return int 
     */
    public function getOrder()
    {
        return 3;
    }
}