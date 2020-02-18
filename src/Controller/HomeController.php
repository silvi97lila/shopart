<?php

namespace App\Controller;

use App\Entity\Works;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();
        // Get some repository of data, in our case we have an Appointments entity
        $workRepository = $em->getRepository(Works::class);

        $workRepositoryQuery=$workRepository->createQueryBuilder('p')->getQuery();

        $works = $paginator->paginate(
        // Doctrine Query, not results
            $workRepositoryQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            6
        );

        if (!$works)  throw $this->createNotFoundException('No product found in the database.');

        return $this->render('home/index.html.twig', ['works'=> $works]);
    }


    /**
     * @Route("/about", name="about")
     */
    public function about(){
        return  $this->render('home/about.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(){
        return  $this->render('home/contact.html.twig');
    }



}
