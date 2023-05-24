<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityRepository;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
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

    //#[Route('/product/{id<\d+>?}', name: 'app_product_detail')]
    #[Route('/product/{slug}', name: 'app_product_detail')]
    public function productDetail(Product $product = null):Response {
        if ($product == null)
            throw new NotFoundHttpException();

        return $this->render('front/productDetail.html.twig', [
            'product' => $product
        ]);
    }

    #[Route('/categories', name: 'app_categories')]
    public function categories( CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('front/categories.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/category/{slug}', name: 'app_category_detail')]
    public function categoryDetail(Category $category = null): Response
    {
        if ($category == null)
            throw new NotFoundHttpException();

        return $this->render('front/categoryDetail.html.twig', [
            'category' => $category
        ]);
    }

    #[Route('pages/{page}', name:'app_static_page', requirements: ['page' => '[a-z]+'])]
    public function staticPage(string $page, Environment $twig): Response
    {
        $template = 'front/pages/' . $page . '.html.twig';
        $loader = $twig->getLoader();
        if (!$loader->exists($template))
            throw new NotFoundHttpException();

        return $this->render($template, ['page'=>$page]);
    }

    #[Route('/email')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to('you@example.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);

        return $this->render('front/pages/contact.html.twig',);
    }

}
