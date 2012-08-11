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
use MZJ\YabBundle\Entity\Tag;
use MZJ\YabBundle\Form\PostType;

/**
 * MZJ\YabBundle\Controller\PostController
 *
 * Post controller
 *
 * @author Marko Jovanovic <markozjovanovic@gmail.com>
 */
class PostController extends Controller
{
    /**
     * Lists all Post entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MZJYabBundle:Post')->findAll();

        return $this->render('MZJYabBundle:Post:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Post entity.
     *
     */
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $tagManager = $this->get('fpn_tag.tag_manager');
        
        $entity = $em->getRepository('MZJYabBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $tagManager->loadTagging($entity);
        
        return $this->render('MZJYabBundle:Post:view.html.twig', array(
            'post'      => $entity
         ));
    }

    /**
     * Displays a form to create a new Post entity.
     *
     */
    public function newAction()
    {
        $entity = new Post();
        $form   = $this->createForm(new PostType(), $entity);
        
        return $this->render('MZJYabBundle:Post:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Post entity.
     *
     */
    public function createAction(Request $request)
    {
        $data = $request->request->get('mzj_yabbundle_posttype');
        $tagsStr = $data['tags'];
        
        $entity  = new Post();
        
        $tagManager = $this->get('fpn_tag.tag_manager');
        
        $tags = $tagManager->loadOrCreateTags($tagManager->splitTagNames($tagsStr));

        // assign the foo tag to the post
        $tagManager->addTags($tags, $entity);
        
        $form = $this->createForm(new PostType(), $entity);
        $form->bind($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            // after flushing the post, tell the tag manager to actually save the tags
            $tagManager->saveTagging($entity);
            
            return $this->redirect($this->generateUrl('post_show', 
                    array(
                        'created' => $entity->getCreatedAt()->format('m-d-Y'),
                        'id' => $entity->getId(), 
                        'slug' => $entity->getSlug()
                    )
                    ));
        }

        return $this->render('MZJYabBundle:Post:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MZJYabBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }
        
        $tagManager = $this->get('fpn_tag.tag_manager');
        $tagManager->loadTagging($entity);

        $editForm = $this->createForm(new PostType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MZJYabBundle:Post:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Post entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $data = $request->request->get('mzj_yabbundle_posttype');
        $tagsStr = $data['tags'];
        
        $entity = $em->getRepository('MZJYabBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }
        
        $tagManager = $this->get('fpn_tag.tag_manager');
        
        $tags = $tagManager->loadOrCreateTags($tagManager->splitTagNames($tagsStr));
        
        $tagManager->replaceTags($tags, $entity);
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PostType(), $entity);
        $editForm->bind($request);

        
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            // after flushing the post, tell the tag manager to actually save the tags
            $tagManager->saveTagging($entity);
            
            return $this->redirect($this->generateUrl('post_edit', array('id' => $id)));
        }

        return $this->render('MZJYabBundle:Post:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Post entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MZJYabBundle:Post')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Post entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('post'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
