<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FrontController extends AbstractController
{
    #[Route('/', name: 'app_front')]
    public function index(Request $request, ProductRepository $productRepository): Response
    {
        $date = new \DateTime();
       
        $products = $productRepository->findAll();

        return $this->render('front/index.html.twig', [
            'date' => $date,
            'products' => $products
        ]);
    }

    #[Route('pages/{page}', name:'app_static_page', requirements: ['page' => '[a-z]+'])]
    public function staticPage(string $page, Environment $twig): Response
    {
        $template = 'front/pages/' . $page . '.html.twig';
        $loader = $twig->getLoader();
        if (!$loader->exists($template))
            throw new NotFoundHttpException();

        return $this->render($template, []);
    }

}
