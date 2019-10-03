<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/hello", name="hello")
     * @Route("/hello/{prenom}", name="hello_prenom")
     *
     * @return void
     */
    public function hello($prenom = null)
    {
        return $this->render(
            'hello.html.twig',
            [
                'prenom' => $prenom
            ]
        );
    }
    /**
     * @Route("/", name="homepage")
     *
     * @return void
     */
    public function home()
    {
        $prenoms = ["Lior" => 31, "Joseph" => 12, "Anne" => 55];

        return $this->render('home.html.twig', [
            'title' => 'Bonjour à tous !',
            'age' => 31,
            'prenom' => $prenoms
        ]);
    }
}