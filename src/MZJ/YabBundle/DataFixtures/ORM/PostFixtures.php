<?php

/*
 * This file is part of the Yabb package.
 *
 * (c) Marko Jovanovic <markozjovanovic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MZJ\YabBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager,
    Symfony\Component\DependencyInjection\ContainerAwareInterface,
    Symfony\Component\DependencyInjection\ContainerInterface,
    MZJ\YabBundle\Entity\Post;

/**
 * MZJ\YabBundle\DataFixtures\ORM\PostFixtures
 *
 * Post Fixture class
 *
 * @author Marko Jovanovic <markozjovanovic@gmail.com>
 */
class PostFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{   
    /**
     * Holds dummy code as part of the text that goes into post
     * 
     * @var string 
     */
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
     * Holds dummy code as part of the text that goes into post
     * 
     * @var string 
     */
    public $code2 = <<<'EOT'
        <pre><code>
        namespace MZJ\YabBundle\DependencyInjection\Compiler;



        use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
            Symfony\Component\DependencyInjection\ContainerBuilder;

        class CompilerPass implements CompilerPassInterface
        {
            public function process(ContainerBuilder $container)
            {
                $definition = $container->getDefinition('fpn_tag.tag_manager');
                $definition->setClass('MZJ\YabBundle\Entity\TagManager');
            }
        }
        </code></pre>
EOT;
    
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;
    
    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    /**
     * Main method that actually does the work
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
        $post4->setCreatedAt(new \DateTime('-1 day'));
        
        $post5 = new Post();
        $post5->setTitle('Symfony2 Blog Bundle Tutorial - Part 2');
        $post5->setAbstract('At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos 
            dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, 
            id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi 
            optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.');
        $post5->setContent('Like I said in the title - this is my first post. Keep reading...<br>' . $this->code);
        $post5->addCategorie($manager->merge($this->getReference('symfony2')));
        $post5->addCategorie($manager->merge($this->getReference('tutorials')));
        $post5->setCommentsEnabled(true);
        
        $post6 = new Post();
        $post6->setTitle('FPN TagBundle - Overriding Service Class');
        $post6->setAbstract("Problem came up. TagManager from Fpn TagBundle used doctrine dql, that didn't do the 'real' join. So I needed a way to override a method from TagManager class.
                    So I found a way how to override 'foreign' service definitions from inside my bundle. Using Compiler pass, I now have my own TagManager class that extends original one, and overrides tha troublesome method.");
        $post6->setContent("The Compiler 'registration' class: " . $this->code2);
        $post6->addCategorie($manager->merge($this->getReference('symfony2')));
        $post6->addCategorie($manager->merge($this->getReference('tutorials')));
        $post6->setCommentsEnabled(true);
        
        $tagManager->addTags($tags, $post1);
        $tagManager->addTags(array_slice($tags, 2, -1), $post2);
        $tagManager->addTags(array_slice($tags, 1, -2), $post3);
        $tagManager->addTags(array_slice($tags, 2), $post4);
        $tagManager->addTags(array_slice($tags, 2), $post5);
        $tagManager->addTags(array_slice($tags, 2), $post6);
        
        $manager->persist($post1);
        $manager->persist($post2);
        $manager->persist($post3);
        $manager->persist($post4);
        $manager->persist($post5);
        $manager->persist($post6);
        
        $manager->flush();
        
        $tagManager->saveTagging($post1);
        $tagManager->saveTagging($post2);
        $tagManager->saveTagging($post3);
        $tagManager->saveTagging($post4);
        $tagManager->saveTagging($post5);
        $tagManager->saveTagging($post6);
        
        $this->addReference('post1',   $post1);
        $this->addReference('post2',   $post2);
        $this->addReference('post3',   $post3);
        $this->addReference('post4',   $post4);
        $this->addReference('post5',   $post5);
        $this->addReference('post6',   $post6);
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