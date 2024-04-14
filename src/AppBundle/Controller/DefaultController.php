<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        $query = $queryBuilder
            ->select('p')
            ->from('AppBundle:Post', 'p')
            ->setMaxResults(5)
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery();

        $posts = $query->getResult();
        return $this->render('default/index.html.twig', array(
'posts' =>$posts
        ));
    }
}
