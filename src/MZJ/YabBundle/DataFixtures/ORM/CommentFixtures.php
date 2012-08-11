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
        $comm2->setName('Nikola');
        $comm2->setContent('@Marko - Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                            Ut enim ad minim veniam,<script>alert("hello")</script> quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
                );
        $comm2->setPost($manager->merge($this->getReference('post5')));
        $comm2->setLikes(4);
        $comm2->setDislikes(8);
        $comm2->setParent($comm1);
        
                
        $comm3 = new Comment();
        $comm3->setName('Mirko');
        $comm3->setContent(' Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
                );
        $comm3->setPost($manager->merge($this->getReference('post5')));
        $comm3->setLikes(4);
        $comm3->setDislikes(8);
        
        
        $comm4 = new Comment();
        $comm4->setName('Marko');
        $comm4->setContent('@Nikola - Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
                );
        $comm4->setPost($manager->merge($this->getReference('post5')));
        $comm4->setLikes(4);
        $comm4->setDislikes(8);
        $comm4->setParent($comm2);

        
        $comm5 = new Comment();
        $comm5->setName('Amy');
        $comm5->setContent('@Marko - Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
                );
        $comm5->setPost($manager->merge($this->getReference('post5')));
        $comm5->setLikes(22);
        $comm5->setDislikes(1);
        $comm5->setParent($comm1);
        
        $manager->persist($comm1);
        $manager->persist($comm2);
        $manager->persist($comm3);
        $manager->persist($comm4);
        $manager->persist($comm5);
        
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