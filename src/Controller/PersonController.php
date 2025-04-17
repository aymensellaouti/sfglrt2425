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

    private EntityManager $entityManager;
    private PersonRepository $repository;
    public function __construct(private ManagerRegistry $doctrine)
    {
        $this->entityManager = $doctrine->getManager();
        $this->repository = $this->entityManager->getRepository(Person::class);
    }

    #[Route('/list', name: 'list_person')]
    public function listPerson(): Response
    {
        $persons = $this->repository->findAll();

        return $this->render('person/list.html.twig', [
            'persons' => $persons,
        ]);
    }

    #[Route('/add/{name}/{age}', name: 'add_person')]
    public function addPerson($name, $age): Response
    {
        $person = new Person();
        $person->setName($name);
        $person->setAge($age);

        // tzid fel transaction
        $this->entityManager->persist($person);
        // texecuti transaction
        $this->entityManager->flush();

        return $this->render('person/index.html.twig', [
            'person' => $person,
        ]);
    }
    #[Route('/delete/{id}', name: 'delete_person')]
    public function deletePerson(Person $person = null): Response
    {

        if(!$person){
            throw $this->createNotFoundException('Person not found');
        }
        // tzid fel transaction
        $this->entityManager->remove($person);
        // texecuti transaction
        $this->entityManager->flush();

        return $this->redirectToRoute('list_person');
    }
}
