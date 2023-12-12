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
use App\Entity\Participate;
use App\Repository\UserRepository;
use App\Repository\AddRepository;
use App\Repository\ParticipateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ParticipateController extends AbstractController
{
    
    private $em;
    private $repo;
    private $serializer;
    private $hash;
    private $user;
    private $add;
    public function __construct(EntityManagerInterface $em,
    AddRepository $addRepository, SerializerInterface $serializerInterface,
    UserPasswordHasherInterface $hash, UserRepository $userRepository,
    ParticipateRepository $participateRepository){
        $this->em = $em;
        $this->repo = $participateRepository;
        $this->serializer = $serializerInterface;
        $this->hash = $hash;
        $this->user = $userRepository;
        $this->add = $addRepository;
    }
    #[Route('/participate', name: 'app_participate')]
    public function index(): Response
    {
        return $this->render('participate/index.html.twig', [
            'controller_name' => 'ParticipateController',
        ]);
    }
    #[Route('/participate/add', name: 'app_participate_add')]
    public function AddParticipate(Request $request): Response
    {
        $message = "";
        $code = 200;
        $groupe = [];
        $json = $request->getContent();
        if($json){
            $data = $this->serializer->decode($json,'json');
            $user = $this->user->findOneBy(["token"=>UtilsService::cleanInput($data["token"])]);
            if($user){
                $add = $this->add->findOneBy(["id"=>UtilsService::cleanInput($data["add_id"])]);
                if($add){
                    $participate = new Participate();
                    $participate->setRdvDate(new \DateTimeImmutable(UtilsService::cleanInput($data["rdv_date"])));
                    $participate->setMessage(UtilsService::cleanInput($data["message"]));
                    $participate->setAddId($add);
                    $participate->setUserId($user);
                    $participate->setConfirm($data["confirm"]);
                    $this->em->persist($participate);
                    $this->em->flush();
                    $message = $participate;
                    $groupe = ['groups' => 'part'];
                    /* $nbr = $this->repo->findCountParticipate($add->getId());
                    dd($nbr);
                    if($nbr["nbr"]==null OR $nbr["nbr"]<=$add->getPlaceNumber()){
                        $participate->setConfirm(true);
                    }
                    else{
                        $participate->setConfirm(false);
                    } */
                }
                else{
                    $message = ["error"=>"l'annonce' n'existe pas"];
                    $code = 400;
                }
            }
            else{
                $message = ["error"=>"le compte n'existe pas"];
                $code = 400;
            }
        }
        else{

        }
        return $this->json($message, $code, [
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => '*'
        ],$groupe);
    }
}
