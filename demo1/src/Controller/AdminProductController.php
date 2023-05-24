<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin', name: 'app_admin_')]
class AdminProductController extends AbstractController
{
    #[Route('/product', name: 'product')]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('admin/product/index.html.twig', [
           'products'=> $productRepository->findBy([],['createdAt'=>'DESC'])
        ]);
    }


    #[Route('/product/add', name: 'product_add')]
    #[Route('/product/edit/{id<\d+>}', name: 'product_edit')]
    public function add(Product $product = null, Request $request, SluggerInterface $sluggerInterface, ProductRepository $productRepository): Response
    {
        if($product == null)
            $product = new Product();
       
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            if($product->getId()==null)
                $product->setCreatedAt(new \DateTimeImmutable());
            else
                $product->setModifiedAt(new \DateTimeImmutable()); 

            $product->setSlug($sluggerInterface->slug($product->getName()));

            $productRepository->save($product, true);

            return $this->redirectToRoute('app_admin_product');
        }

        return $this->render('admin/product/add.html.twig', [
            'form'=> $form,
            'product'=>$product,
            'edit'=> empty($product->getId())?false:true
        ]);
    }

}