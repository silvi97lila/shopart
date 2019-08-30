<?php


namespace App\Utils;


use App\Entity\Works;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Basket
{
    protected $storage;

    protected $product;

    public function __construct(SessionInterface $session)
    {
        $this->storage=$session;
    }

    public function add(Works $product){
        $this->storage->set($product->getTitle(), [
           'product_id'=> (int) $product->getId(),
            'product_title'=> $product->getTitle()
        ]);
    }

    public function get(Works $product){
        return $this->storage->get($product->getTitle());
    }

    public function clear(){
        $this->storage->clear();
    }

    public function all(){
        return $this->storage->all();
    }
}