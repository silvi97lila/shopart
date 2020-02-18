<?php

namespace App\Controller;

use App\Entity\Works;
use App\Services\Basket;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WorkController extends AbstractController
{

    /**
     * @Route("/work", name="work")
     */
    public function index()
    {
        $products=$this->getDoctrine()
            ->getRepository(Works::class)
            ->findAll();
        return $this->render('work/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/work/{id}", name="work_by_id")
     */
    public function workById(Request $request, $id, Basket $basket)
    {
        $work = $this->getDoctrine()
            ->getRepository(Works::class)
            ->find($id);

        if(!$work){
            return $this->redirectToRoute('home');
        }
        $similarWorks=$this->getDoctrine()
            ->getRepository(Works::class)
            ->GetWorksByCategory($work->getCategory());

        if($request->getMethod() == "POST"){
            $identifier=$request->request->get('add_cart');
            if ($this->getUser()){
                $this->addFlash('success', "Please check your shopping cart");
                $basket->addCart($identifier, $work);
            }else{
                $this->addFlash("error", "Please Log in to add to cart");
                return $this->redirect("http://127.0.0.1:8000/login", 301);
            }
        }

        return $this->render('work/work.html.twig', [
            'work' => $work,
            'similarWorks'=>$similarWorks
        ]);
    }
}
