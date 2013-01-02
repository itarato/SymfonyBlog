<?php

namespace Itarato\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Itarato\BlogBundle\Entity\BlogPost;
use Itarato\BlogBundle\Form\Type\BlogPostType;
use Doctrine\DBAL\Connection;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $blog_post = new BlogPost();
        $form = $this->createForm(new BlogPostType(), $blog_post);
        $view = $this->render('ItaratoBlogBundle:Default:list.html.twig', array(
            'form' => $form->createView(),
        ));

        return $view;
    }

    public function blogPostListAction() {
        $dbConn = $this->getDoctrine()->getConnection();
        $result = $dbConn->query("
            SELECT *
            FROM blog_post
            ORDER BY bid
        ");
        $records = $result->fetchAll();

        $view = $this->render('ItaratoBlogBundle:Default:posts.html.twig', array(
            'posts' => $records,
        ));

        return $view;
    }

    public function onSubmitPostAction(Request $request) {
        $blogPost = new BlogPost();
        $blogPost->setCreated(time());

        $form = $this->createForm(new BlogPostType(), $blogPost);
        $form->bind($request);

        if ($form->isValid()) {
            $db = $this->getDoctrine()->getManager();
            $db->persist($blogPost);
            $db->flush();
        }

        $this->get('session')->getFlashBag()->add('notice', 'New post has been arrived: ' . $blogPost->getBid());
        return $this->forward('ItaratoBlogBundle:Default:index');
    }
}
