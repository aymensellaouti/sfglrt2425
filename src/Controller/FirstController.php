<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/first')]
final class FirstController extends AbstractController{
    #[Route('/{name?samar}/{age<\d{1,3}>?42}', name: 'app_first'
//        , defaults: [
//        'name' => 'aymen'
//    ]
    )]
    public function index(
        $name,
        $age,
        SessionInterface $session
    ): Response
    {
        //$session->has('name');
        return $this->render('first/index.html.twig', [
            'name' => $name,
            'age' => $age,
        ]);
    }

    #[Route('/randomTab/{nb?5}')]
    public function showRandomTab($nb = 5) {
        $tab = [];
        for($i = 0; $i < $nb; $i++) {
            $tab[$i] = random_int(0, 20);
        }
        return $this->render('first/show.html.twig', [
            'tabs' => $tab,
        ]);
    }
}
