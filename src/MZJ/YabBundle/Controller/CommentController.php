<?php

namespace MZJ\YabBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MZJ\YabBundle\Entity\Comment;
use MZJ\YabBundle\Form\CommentType;

/**
 * Comment controller.
 *
 */
class CommentController extends Controller
{
    /**
     * Lists all Comment entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MZJYabBundle:Comment')->findAll();

        return $this->render('MZJYabBundle:Comment:index.html.twig', array(
            'entities' => $entities,
        ));
    }   
    
    /**
     * Finds and displays a Post entity.
     *
     */
    public function commentsAction($postId)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('MZJYabBundle:Comment');
        
        $comments = $repo->getAsArray($postId);
        
        $entity = new Comment();
        $form   = $this->createForm(new CommentType(), $entity);
        
        return $this->render('MZJYabBundle:Comment:comments.html.twig', array(
            'comments'  => $comments,
            'form'      => $form->createView(),
            'postId'    => $postId
         ));
    }

    /**
     * Finds and displays a Comment entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MZJYabBundle:Comment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MZJYabBundle:Comment:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Comment entity.
     *
     */
    public function newAction()
    {
        $entity = new Comment();
        $form   = $this->createForm(new CommentType(), $entity);

        return $this->render('MZJYabBundle:Comment:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Comment entity.
     *
     */
    public function createAction(Request $request, $postId, $commentId)
    {
        $entity  = new Comment();
        $form = $this->createForm(new CommentType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $post = $em->getRepository('MZJYabBundle:Post')->find($postId);
            $entity->setPost($post);
            
            if(null != $commentId) {
                $comment = $em->getRepository('MZJYabBundle:Comment')->find($commentId);
                $entity->setParent($comment);
            }
                        
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('MZJYabBundle_post_view', 
                    array('id' => $post->getId(), 'slug' => $post->getSlug())
                 ));
        }

        return $this->render('MZJYabBundle:Comment:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Comment entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MZJYabBundle:Comment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
        }

        $editForm = $this->createForm(new CommentType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MZJYabBundle:Comment:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Comment entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MZJYabBundle:Comment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CommentType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('comment_edit', array('id' => $id)));
        }

        return $this->render('MZJYabBundle:Comment:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Comment entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MZJYabBundle:Comment')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Comment entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('comment'));
    }
    
    /**
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param type $id
     * @throws type
     */
    public function likeAction(Request $request, $id) 
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('MZJYabBundle:Comment')->find($id);
        $post = $entity->getPost();
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
        }
        $likes = $entity->getLikes() + 1;
        $entity->setLikes($likes);
        $em->persist($entity);
        $em->flush();
        
        return $this->redirect($this->generateUrl('MZJYabBundle_post_view', 
                array('id' => $post->getId(), 'slug' => $post->getSlug())
             ));
    }
    
    /**
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param type $id
     * @throws type
     */
    public function dislikeAction(Request $request, $id) 
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('MZJYabBundle:Comment')->find($id);
        $post = $entity->getPost();
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comment entity.');
        }
        $likes = $entity->getDislikes() + 1;
        $entity->setDislikes($likes);
        $em->persist($entity);
        $em->flush();
        
        return $this->redirect($this->generateUrl('MZJYabBundle_post_view', 
                array('id' => $post->getId(), 'slug' => $post->getSlug())
             ));
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
