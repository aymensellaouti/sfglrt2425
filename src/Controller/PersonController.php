<?php

namespace App\Controller;

use App\Entity\Person;
use App\Repository\PersonRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/person')]
final class PersonController extends AbstractController{

    private PersonRepository $repository;

    private EntityManager $entityManager;
    public function __construct(private ManagerRegistry $doctrine)
    {
        $this->entityManager = $doctrine->getManager();
        $this->repository = $this->entityManager->getRepository(Person::class);
    }

    #[Route('/list', name: 'list_person')]
    public function list(): Response
    {
        $persons = $this->repository->findAll();
        return $this->render('person/list.html.twig', [
            'persons' => $persons,
        ]);
    }
    #[Route('/delete/{id}', name: 'delete_person')]
    public function delete(Person $person = null): Response
    {
        if (!$person) {
            throw $this->createNotFoundException('Person not found');
        }
        $this->entityManager->remove($person);
        $this->entityManager->flush();
        return $this->redirectToRoute('list_person');
    }
    #[Route('/add/{name}/{age}', name: 'app_person')]
    public function add($name, $age): Response
    {
        $person = new Person();
        $person->setName($name);
        $person->setAge($age);
        $this->entityManager->persist($person);
        $this->entityManager->flush();
        return $this->render('person/index.html.twig', [
            'person' => $person,
        ]);
    }
}
