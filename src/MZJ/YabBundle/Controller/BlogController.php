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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MZJ\YabBundle\Entity\Post;
use MZJ\YabBundle\Form\PostType;

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

        $entities = $em->getRepository('MZJYabBundle:Post')->findAll();

        return $this->render('MZJYabBundle:Blog:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Sidebar
     *
     */
    public function sidebarAction()
    {
        return $this->render('MZJYabBundle:Blog:sidebar.html.twig');
    }
}
