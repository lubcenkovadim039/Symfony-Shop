<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(SessionInterface $session)
    {
        $counter = $session->get('page_counter',0);
        $counter++;
        $session->set('page_counter',$counter);
        $repo = $this->getDoctrine()->getRepository(Product::class);
        $topproducts = $repo->findBy(['isTop' => 1]);
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'counter' => $counter,
            'isTop' => $topproducts
        ]);
    }

    /**
     * @Route ("/show/{id}",name="show")
     */
    public function show($id = 'default')
    {
        if($id == 'homepage'){
            return $this->redirectToRoute('homepage');
        }
        if($id == 'not-found'){
            throw $this->createNotFoundException('Такого нет');
        }
        return $this->render('default/show.html.twig',['id' => $id]);
    }

}
