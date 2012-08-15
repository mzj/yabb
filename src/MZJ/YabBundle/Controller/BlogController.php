<?php

/*
 * This file is part of the Yabb package.
 *
 * (c) Marko Jovanovic <markozjovanovic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MZJ\YabBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * MZJ\YabBundle\Controller\BlogController
 *
 * Blog controller
 *
 * @author Marko Jovanovic <markozjovanovic@gmail.com>
 */
class BlogController extends Controller
{
    /**
     * Lists all Post entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $entities = $em->getRepository('MZJYabBundle:Post')->getPosts();
        
        return $this->render('MZJYabBundle:Blog:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Sidebar action
     * Note: Sidebar is cached 
     */
    public function sidebarAction()
    {
        $response = $this->render('MZJYabBundle:Blog:sidebar.html.twig');
        
        $response->setSharedMaxAge(60);
        
        return $response;
    }
}
