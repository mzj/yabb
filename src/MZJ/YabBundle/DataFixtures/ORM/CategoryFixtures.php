<?php
// src/MZJ/YabBundle/DataFixtures/ORM/CategoryFixtures.php

namespace MZJ\YabBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager,
    MZJ\YabBundle\Entity\Category;

class CategoryFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $cat1 = new Category();
        $cat1->setName('root');
        $cat1->setDescription('"Fake root category parent."');
            
        $cat2 = new Category();
        $cat2->setName('Web Development');
        $cat2->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. ');
        $cat2->setParent($cat1);
        
        $cat3 = new Category();
        $cat3->setName('Backend');
        $cat3->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. ');
        $cat3->setParent($cat2);
        
        $cat4 = new Category();
        $cat4->setName('Frontend');
        $cat4->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. ');
        $cat4->setParent($cat2);
        
        $cat5 = new Category();
        $cat5->setName('PHP');
        $cat5->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. ');
        $cat5->setParent($cat3);
        
        $cat7 = new Category();
        $cat7->setName('CSS');
        $cat7->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. ');
        $cat7->setParent($cat4);
        
        $cat8 = new Category();
        $cat8->setName('Programming');
        $cat8->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. ');
        $cat8->setParent($cat1);
               
        $cat6 = new Category();
        $cat6->setName('Scala');
        $cat6->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. ');
        $cat6->setParent($cat8);
        
        $cat9 = new Category();
        $cat9->setName('Javascript');
        $cat9->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. ');
        $cat9->setParent($cat4);
        
        $cat10 = new Category();
        $cat10->setName('Tutorials');
        $cat10->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. ');
        $cat10->setParent($cat1);
        
        $cat11 = new Category();
        $cat11->setName('Other');
        $cat11->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. ');
        $cat11->setParent($cat1);
        
        $cat12 = new Category();
        $cat12->setName('Symfony2');
        $cat12->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. ');
        $cat12->setParent($cat5);
        
        
        $manager->persist($cat1);
        $manager->persist($cat2);
        $manager->persist($cat3);
        $manager->persist($cat4);
        $manager->persist($cat5);
        $manager->persist($cat6);
        $manager->persist($cat7);
        $manager->persist($cat8);
        $manager->persist($cat9);
        $manager->persist($cat10);
        $manager->persist($cat11);
        $manager->persist($cat12);
        
        $manager->flush();
        
        $this->addReference('webdevelopment',   $cat2);
        $this->addReference('backend', $cat3);
        $this->addReference('frontend', $cat4);
        $this->addReference('php', $cat5);
        $this->addReference('css', $cat6);
        $this->addReference('programming', $cat8);
        $this->addReference('scala', $cat6);
        $this->addReference('javascript', $cat9);
        $this->addReference('tutorials', $cat10);
        $this->addReference('other', $cat11);
        $this->addReference('symfony2', $cat12);
    }
    
    /**
     * OrderedFixtureInterface method
     * Specifies in what order fixtures should be loaded
     * 
     * @return int 
     */
    public function getOrder()
    {
        return 1;
    }
}