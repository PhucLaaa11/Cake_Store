<?php

namespace App\Controller;

use App\Entity\CartDetail;
use App\Entity\Product;
use App\Form\CartDetailType;
use App\Form\ProductType;
use App\Repository\CartDetailRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartDetailController extends AbstractController
{
    #[Route('/cart_detail', name: 'app_cart_detail')]
    public function index(): Response
    {
        return $this->render('cart_detail/index.html.twig', [
            'controller_name' => 'CartDetailController',
        ]);
    }
    #[Route('/cart_detail/all', name: 'app_cart_detail_all')]
    public function getcart_detail(CartDetailRepository $cartDetailRepository): Response
    {
        $cartDetail = $cartDetailRepository->findAll();
        //dd($customers);
        return $this->render('cart_detail/index.html.twig',
            ['cartDetail' => $cartDetail]);
    }
    #[Route('/cart_detail/create', name: 'app_cart_detail_create', priority: 1)]
    public function createAction(CartDetailRepository $cartDetailRepository, Request $request): Response
    {

        $form = $this->createForm(CartDetailType::class, new  CartDetail());

//        dd($request);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cartDetail = $form->getData();
            $cartDetailRepository->save($cartDetail, true);
            $this->addFlash('success', 'cart_detail\'s inserted successfully');
            return $this->redirectToRoute('app_cart_detail_create');
        }

        return $this->render('cart_detail/create.html.twig', [
            'form' => $form
        ]);
    }

}
