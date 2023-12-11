<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Service\UtilsService;
use App\Entity\Add;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\AddRepository;
use App\Entity\Localisation;
use App\Repository\LocalisationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AddController extends AbstractController
{
    private $em;
    private $repo;
    private $serializer;
    private $hash;
    private $user;
    private $localisation;
    public function __construct(EntityManagerInterface $em,
    AddRepository $addRepository, SerializerInterface $serializerInterface,
    UserPasswordHasherInterface $hash, UserRepository $userRepository,
    LocalisationRepository $localisationRepository){
        $this->em = $em;
        $this->repo = $addRepository;
        $this->serializer = $serializerInterface;
        $this->hash = $hash;
        $this->user = $userRepository;
        $this->localisation = $localisationRepository;
    }
    
    #[Route('/add', name: 'app_add')]
    public function index(): Response
    {
        return $this->render('add/index.html.twig', [
            'controller_name' => 'AddController',
        ]);
    }
    #[Route('/add/add', name: 'app_add_add')]
    public function createAdd(Request $request): Response
    {
        $message = "";
        $code = 200;
        $groupe = [];
        $json = $request->getContent();
        if($json){
            $data = $this->serializer->decode($json, 'json');
            $user = $this->user->findOneBy(["token"=>$data["token"]]);
            if($user){
                $add = new Add();
                $add->setTitle(UtilsService::cleanInput($data["title"]));
                $add->setCreationDate(new \DateTimeImmutable(UtilsService::cleanInput($data["creation_date"])));
                $add->setDescription(UtilsService::cleanInput($data["description"]));
                $add->setPlaceNumber(UtilsService::cleanInput($data["place_number"]));
                $add->setUserId($user);
                $add->setLocalisationId($this->localisation->find(UtilsService::cleanInput($data["localisation_id"])));
                $add->setActivate(true);
                $this->em->persist($add);
                $this->em->flush();
                $message = $add;
                $groupe = ['groups' => 'add'];
            }
            else{
                $message = ["error"=>"le compte n'existe pas"];
                $code = 400;
            }
        }
        else{
            $message = ["error"=>"Json Invalide"];
            $code = 400;
        }
        return $this->json($message, $code, [
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => '*'
        ],$groupe);
    }
    #[Route('/add/all', name: 'app_add_all',methods:'GET')]
    public function getAddAll(): Response
    {
        $message = "";
        $code = 200;
        $groupe = "";
        $adds = $this->repo->findAll();
        if ($adds) {
            $message = $adds;
            $groupe = ['groups' => 'add'];
        } else {
            $message = ["error" => "Il n'y a pas d'annonce en BDD"];
            $code = 400;
            $groupe = [];
        }
        return $this->json($message, $code, [
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => '*'
        ], $groupe);
    }
    #[Route('/add/id/{id}', name: 'app_add_id',methods:'GET')]
    public function getAddById($id): Response
    {
        $message = "";
        $code = 200;
        $groupe = "";
        $add = $this->repo->find($id);
        if ($add) {
            $message = $add;
            $groupe = ['groups' => 'add'];
        } else {
            $message = ["error" => "L'annonce n'existe pas en BDD"];
            $code = 400;
            $groupe = [];
        }
        return $this->json($message, $code, [
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => '*'
        ], $groupe);
    }
}
