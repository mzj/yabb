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

use MZJ\YabBundle\Entity\Tag;
use MZJ\YabBundle\Entity\Post;

/**
 * MZJ\YabBundle\Controller\BlogController
 *
 * Blog controller
 *
 * @author Marko Jovanovic <markozjovanovic@gmail.com>
 */
class TagController extends Controller
{
    /**
     * Lists all Post entities.
     *
     */
    public function cloudAction()
    {
        $post = new Post();
        
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MZJYabBundle:Tag')->getTagsWithCountArray($post->getTaggableType());
        
        ksort($entities);
        
        return $this->render('MZJYabBundle:Tag:cloud.html.twig', array(
            'tags' => $entities,
        ));
    }
}
