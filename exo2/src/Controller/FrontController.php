<?php

namespace App\Controller;

use App\Entity\Place;
use App\Repository\PlaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FrontController extends AbstractController
{
    #[Route('/', name: 'app_front')]
    public function index(PlaceRepository $placeRepository): Response
    {
        return $this->render('front/index.html.twig', [
            'places' => $placeRepository->findBy([], ['createdAt' => 'DESC'])
        ]);
    }

    #[Route('/view/{slug}', name: 'app_view')]
    public function placeView(Place $place = null): Response
    {

        if ($place == null)
            throw new NotFoundHttpException();

        return $this->render('front/view.html.twig', [
            'place' => $place,
        ]);
    }

    #[Route('/search/{keywords}', name: 'search', methods: ["GET"])]
    public function searchAction(string $keywords, EntityManagerInterface $entityManager): JsonResponse
    {

        // Création de la requête DQL pour rechercher les lieux correspondants aux mots-clés

        $query = $entityManager->createQuery('
        SELECT p.id, p.name, p.description, pic.file AS photo
        FROM App\Entity\Place p
        LEFT JOIN p.pictures pic
        WHERE p.name LIKE :keywords
        OR p.description LIKE :keywords
        OR pic.title LIKE :keywords
        ');

        $query->setParameter('keywords', '%' . $keywords . '%');
        //Définit la valeur du paramètre 'keywords' dans la requête

        $results = $query->getResult(); // Exécute la requête et récupère les résultats

        $serializedResults = [];
        foreach ($results as $result) {
            // Sérialise les résultats  pour la réponse JSON
            $serializedResults[] = [
                'id' => $result['id'],
                'name' => $result['name'],
                'description' => $result['description'],
                'photo' => $result['photo']
            ];
        }

        return new JsonResponse($serializedResults); // Retourne une réponse JSON contenant les résultats
    }

    // URL de recherche = {/search?keywords=<mots-cléfs>/}
}
