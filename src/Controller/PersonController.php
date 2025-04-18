<?php

namespace App\Controller;

use App\Entity\Person;
use App\Repository\PersonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/person')]
final class PersonController extends AbstractController{

    protected EntityManagerInterface $manager;
    protected PersonRepository $repository;

    public function __construct(
        private readonly ManagerRegistry $doctrine,
    )
    {
        $this->manager = $this->doctrine->getManager();
        $this->repository = $this->doctrine->getRepository(Person::class);
    }

    #[Route('/all', name: 'list_person')]
    public function list(): Response
    {
        $persons = $this->repository->findAll();

        return $this->render('person/list.html.twig', [
            'persons' => $persons,
        ]);
    }
    #[Route('/add/{name}/{age}', name: 'add_person')]
    public function index($name, $age): Response
    {
        $person = new Person();
        $person->setName($name);
        $person->setAge($age);
        $this->manager->persist($person);
        $this->manager->flush();
        return $this->render('person/index.html.twig', [
            'person' => $person,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete_person')]
    public function delete($id): Response
    {
        $person = $this->repository->find($id);
        if(!$person){
            throw $this->createNotFoundException("person not found");
        }
        $this->manager->remove($person);
        $this->manager->flush();
        return $this->redirectToRoute('list_person');
    }

    #[Route('/details/{id}', name: 'app_person_details')]
    public function details(Person $person = null): Response
    {
        if(!$person){
            throw $this->createNotFoundException("person not found");
        }
        return $this->render('person/index.html.twig', [
            'person' => $person,
        ]);
    }
}
