<?php

namespace App\Controller;

use App\Entity\Works;
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
        return $this->render('work/index.html.twig', [
            'controller_name' => 'WorkController',
        ]);
    }


    /**
     * @Route("/work/{id}", name="work_by_id")
     */
    public function workById(Request $request, $id)
    {
        $work = $this->getDoctrine()
            ->getRepository(Works::class)
            ->find($id);
        if(!$work){
            return $this->redirectToRoute('home');
        }
        return $this->render('work/work.html.twig', ['work' => $work]);
    }
}
