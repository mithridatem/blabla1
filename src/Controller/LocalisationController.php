<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Service\UtilsService;
use App\Entity\Localisation;
use App\Repository\LocalisationRepository;
use Doctrine\ORM\EntityManagerInterface;

class LocalisationController extends AbstractController
{
    private $em;
    private $repo;
    private $serializer;
    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer, LocalisationRepository $repo)
    {
        $this->em = $em;
        $this->serializer = $serializer;
        $this->repo = $repo;
    }
    
    #[Route('/localisation', name: 'app_localisation')]
    public function index(): Response
    {
        return $this->render('localisation/index.html.twig', [
            'controller_name' => 'LocalisationController',
        ]);
    }
    #[Route('/localisation/add', name:'app_localisation_add')]
    public function addLocalisation(Request $request):Response{
        $message = "";
        $code = 200;
        $json = $request->getContent();
        if($json){
            $data = $this->serializer->decode($json,'json');
            $localisation = new Localisation();
            $localisation->setNameLocalisation(UtilsService::cleanInput($data["name_localisation"]));
            $localisation->setNameStreet(UtilsService::cleanInput($data["name_street"]));
            $localisation->setNumStreet(UtilsService::cleanInput($data["num_street"]));
            $localisation->setTown(UtilsService::cleanInput($data["town"]));
            $localisation->setPostalCode(UtilsService::cleanInput($data["postal_code"]));
            $localisation->setLatitude(UtilsService::cleanInput($data["lat"]));
            $localisation->setLongitude(UtilsService::cleanInput($data["long"]));
            //dd($localisation);
            $this->em->persist($localisation);
            
            $this->em->flush();
            
            $message = ["localisation"=>$localisation];
            $code = 200;
        }
        else{
            $message = ["error"=>"Json Invalide"];
            $code = 400;
        }
        return $this->json($message,$code,[
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => '*'
        ]);
    }
    #[Route('/localisation/all', name:'app_localisation_all')]
    public function getAllLocalisation():Response{
        $message = "";
        $code = 200;
        $localitions = $this->repo->findAll();
        if($localitions){
            $message = $localitions;
        }
        else{
            $message = ["error"=>"il n'y à pas de localisation"];
            $code = 400;
        }
        return $this->json($message,$code,[
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => '*'
        ]);
    }
    #[Route('/localisation/id/{id}', name:'app_localisation_id')]
    public function getAllById($id):Response{
        $message = "";
        $code = 200;
        $localition = $this->repo->find($id);
        if($localition){
            $message = $localition;
        }
        else{
            $message = ["error"=>"il n'y à pas de localisation"];
            $code = 400;
        }
        return $this->json($message,$code,[
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => '*'
        ]);
    }
}
