<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Cart;
use App\Entity\Purchase;
use App\Services\Basket;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(Basket $basket)
    {
        $products=$basket->getAll();
        $subtotal=$basket->calculateSubtotal();
        $shipping=20;
        $total=$basket->calculateTotalCost($shipping);
        return $this->render('cart/index.html.twig', [
            'products'=>$products,
            'subtotal'=>$subtotal,
            'shipping'=>$shipping,
            'total'=>$total
        ]);
    }

    /**
     * @Route("/checkout", name="checkout")
     */
    public function checkout(){
        return  $this->render('cart/checkout.html.twig');
    }

    /**
     * @Route("/purchase", name="purchase")
     */
    public function purchase(Request $request, Basket $basket){
        $entityManager = $this->getDoctrine()->getManager();
        $cart=new Cart();
        $address=new Address();
        $purchase=new Purchase();

        foreach ($basket->getAll() as $item){
           $cart->setProductName($item->getTitle());
           $cart->setPrice($item->getPrice());
           $cart->setQuantity(1);
           $cart->setUser($this->getUser());
        }

        if ($request->getMethod()=="POST"){
            $address->setFirstName($request->get("name"));
            $address->setLastName($request->get("lastName"));
            $address->setEmail($request->get("email"));
            $address->setStrAddress($request->get("strAddress"));
            $cart->setCardNr($request->get('credit_card'));
            $cart->setCvv($request->get('cvv'));
            $cart->setExpDate($request->get('exp_date'));
            $address->setUser($this->getUser());
        }

        $purchase->setFullName($this->getUser()->getUsername());
        $purchase->setApproved(false);
        $purchase->setCart($cart);
        $purchase->setAddress($address);


        $entityManager->persist($cart);
        $entityManager->persist($address);
        $entityManager->persist($purchase);


        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        $basket->clear();
        $this->addFlash("purchase", "Thank your for shopping with us! Please check your email, we have send the item deliver information");

        return $this->redirectToRoute('home');

    }

}
