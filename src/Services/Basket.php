<?php


namespace App\Services;


use App\Entity\Works;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Basket
{
    private $basket;

    public function __construct(SessionInterface $session){
        $this->basket=$session;
    }

    public function addCart($identifier, $data){
        $this->basket->set($identifier, $data);
    }

    public function getAll(){
        $data=$this->basket->all();
        $products=[];
        foreach ($data as $key => $items){
            if ($key !== "_csrf" && $key !== "_security_main" && $key !=="authenticate"){
                $products[$key]=$items;
            }
        }
        return $products;
    }

    public function calculateSubtotal(){
        $data=$this->getAll();
        $subtotal=0;
        foreach ($data as $key => $value){
            $subtotal += ($value->getPrice());
        }
        return $subtotal;
    }


    public function calculateTotalCost($shipping){
        return $this->calculateSubtotal() + $shipping;
    }

    public function clear(){
        $this->basket->clear();
    }
}