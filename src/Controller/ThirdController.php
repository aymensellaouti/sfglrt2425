<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/third')]
final class ThirdController extends AbstractController{
    #[Route('/{name}/{age<\d{1,2}>}', name: 'app_third')]
    public function index($name, $age): Response
    {
        return $this->render('third/index.html.twig', [
            'name' => $name,
            'age' => $age,
        ]);
    }
    #[Route('/test', name: 'app_test_third')]
    public function test(): Response
    {
        return $this->render('third/index.html.twig');
    }
}
