<?php

namespace App\Controller;

use App\Utils\Basket;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(Basket $basket)
    {
        dump($basket);
        return $this->render('cart/index.html.twig');
    }

    /**
     * @Route("/cart/add/{quantity}", name="add_cart")
     */
    public function add(){

    }
}
