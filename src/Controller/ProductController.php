<?php

namespace App\Controller;

use App\Repository\AvisRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     * @param ProductRepository $productRepository
     * @param AvisRepository $avisRepository
     * @return Response
     */
    public function index(ProductRepository $productRepository, AvisRepository $avisRepository)
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
            'avis' => $avisRepository->findAll(),
        ]);
    }

    /*/**
     * @Route("/product/{id}", name="read", requirements={"id": "\d+"})

    public function read(Product $product)
    {
        return $this->render('product/main.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }*/
}
