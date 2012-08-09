<?php
// src/MZJ/YabBundle/DataFixtures/ORM/CategoryFixtures.php

namespace MZJ\YabBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager,
    Symfony\Component\DependencyInjection\ContainerAwareInterface,
    Symfony\Component\DependencyInjection\ContainerInterface,
    MZJ\YabBundle\Entity\Post;

class PostFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{    
    /**
     * @var ContainerInterface
     */
    private $container;
    
    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    /**
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tagManager = $this->container->get('fpn_tag.tag_manager');
        $tags = $tagManager->loadOrCreateTags(
                        array(
                            'ajwar', 
                            'scala', 
                            'functional programming', 
                            'ruby', 
                            'PHP', 
                            'netbeans', 
                            'symfony2'
                       )
                );
        
        
        $post1 = new Post();
        $post1->setTitle('My First Post');
        $post1->setAbstract('Like I said in the title - this is my first post. Keep reading...');
        $post1->setContent('Like I said in the title - this is my first post. Keep reading...');
        $post1->addCategorie($manager->merge($this->getReference('tshirts')));
        
        $post2 = new Post();
        $post2->setTitle('Hello Readers');
        $post2->setAbstract('Well what is new with you?');
        $post2->setContent('Like I said in the title - this is my first post. Keep reading...');
        $post2->addCategorie($manager->merge($this->getReference('shoes')));
        
        $post3 = new Post();
        $post3->setTitle('Learning Scala');
        $post3->setAbstract('Few days in and still fun.');
        $post3->setContent('Like I said in the title - this is my first post. Keep reading...');
        $post3->addCategorie($manager->merge($this->getReference('pants')));
        
        $tagManager->addTags($tags, $post1);
        $tagManager->addTags(array_slice($tags, 2), $post2);
        $tagManager->addTags(array_slice($tags, 1, -2), $post3);
        
        $manager->persist($post1);
        $manager->persist($post2);
        $manager->persist($post3);
        
        $manager->flush();
        
        $tagManager->saveTagging($post1);
        $tagManager->saveTagging($post2);
        $tagManager->saveTagging($post3);
        
    }
    
    /**
     * OrderedFixtureInterface method
     * Specifies in what order fixtures should be loaded
     * 
     * @return int 
     */
    public function getOrder()
    {
        return 2;
    }
}