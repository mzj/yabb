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
    public $code = <<<'EOT'
        <pre><code>
        class CartController extends Controller
        {
            public function getCart() 
            {
            
                $session = $this->container->get( 'session' );

                if($session->has('cart')) {
                    $cart = unserialize($session->get('cart' ));
                } else {
                    $cart = new Cart();
                }

                return $cart;
            }
            /**
             *
             * @param type $cart 
             */
            public function saveCart($cart) 
            {
                $session = $this->get( 'session' );
                $session->set( 'cart', serialize($cart) );
            }
        }
        </code></pre>

EOT;
    
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
        $post1->setAbstract('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $post1->setContent('Like I said in the title - this is my first post. Keep reading...');
        $post1->addCategorie($manager->merge($this->getReference('other')));
        $post1->addCategorie($manager->merge($this->getReference('tutorials')));
        $post1->setCreatedAt(new \DateTime('-10 day'));
        
        $post2 = new Post();
        $post2->setTitle('Hello Readers');
        $post2->setAbstract('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, 
            eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. 
            Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. 
            Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, 
            sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. ');
        $post2->setContent('Like I said in the title - this is my first post. Keep reading...');
        $post2->addCategorie($manager->merge($this->getReference('other')));
        $post2->setCreatedAt(new \DateTime('-6 day'));
        
        $post3 = new Post();
        $post3->setTitle('Learning Scala');
        $post3->setAbstract('At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos 
            dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, 
            id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi 
            optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.');
        $post3->setContent('Like I said in the title - this is my first post. Keep reading...');
        $post3->addCategorie($manager->merge($this->getReference('scala')));
        $post3->addCategorie($manager->merge($this->getReference('programming')));
        $post3->setCreatedAt(new \DateTime('-3 day'));
        
        $post4 = new Post();
        $post4->setTitle('Symfony2 Blog Bundle Tutorial - Part 1');
        $post4->setAbstract('At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos 
            dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, 
            id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi 
            optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.');
        $post4->setContent('Like I said in the title - this is my first post. Keep reading...<br>' . $this->code);
        $post4->addCategorie($manager->merge($this->getReference('symfony2')));
        $post4->addCategorie($manager->merge($this->getReference('tutorials')));
        
        $tagManager->addTags($tags, $post1);
        $tagManager->addTags(array_slice($tags, 2), $post2);
        $tagManager->addTags(array_slice($tags, 1, -2), $post3);
        $tagManager->addTags(array_slice($tags, 2, -1), $post4);
        
        $manager->persist($post1);
        $manager->persist($post2);
        $manager->persist($post3);
        $manager->persist($post4);
        
        $manager->flush();
        
        $tagManager->saveTagging($post1);
        $tagManager->saveTagging($post2);
        $tagManager->saveTagging($post3);
        $tagManager->saveTagging($post4);
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