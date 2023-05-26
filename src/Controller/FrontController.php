<?php

namespace App\Controller;

use App\Entity\Places;
use App\Entity\User;
use App\Form\PlaceType;
use App\Repository\PlacesRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class FrontController extends AbstractController
{
    #[Route('/', name: 'app_front')]
    public function index(Request $request, PlacesRepository $placesRepository, UserRepository $userRepository): Response
    {

        $places = $placesRepository->findAll();
        $users = $userRepository->findAll();

        return $this->render('front/index.html.twig', [
            'places' => $places,
            'users' => $users,
        ]);
    }

    #[Route('/details/{id}', name: 'app_places_detail')]
    public function placeDetail(Request $request, Places $places): Response
    {

        if ($places == null)
            throw new NotFoundHttpException();

        return $this->render('front/places_detail.html.twig', [
                'places' => $places,
            ]);
    }

    // #[Route('/place/add', name: 'app_place_add')]
    // public function addPlace(Request $request, UserInterface $user, EntityManagerInterface $entityManagerInterface): Response
    // {
    //     $place = new Places();
    //     $place->setUser($user);

    //     $form = $this->createForm(PlaceType::class, $place);

    //     $form->handleRequest($request);
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManagerInterface->persist($place);
    //         $entityManagerInterface->flush();

    //         return $this->redirectToRoute('app_front');
    //     }


    //     return $this->render('front/add_place.html.twig', [
    //         'form' => $form->createView(),
    //     ]);
    // }
}
