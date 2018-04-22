<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\Products;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Products $products)
    {


        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'topProducts' => $products->getTopProducts(),
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
