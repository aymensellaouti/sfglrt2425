<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/second')]
final class SecondController extends AbstractController{

    #[Route('/{name?aymen}/{age<\d{1,3}>?42}', name: 'app_second')]
    public function index($name,$age): Response
    {
        //return new JsonResponse("{username: 'aymen'}");
        return $this->render('second/index.html.twig', [
            'esmElParam' => $name,
            'age' => $age,
        ]);
    }
}