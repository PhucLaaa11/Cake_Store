<?php

namespace App\Controller;

use App\Entity\CartDetail;
use App\Entity\Customer;
use App\Entity\Product;
use App\Form\CartDetailType;
use App\Form\CustomerType;
use App\Form\ProductType;
use App\Repository\CartDetailRepository;
use App\Repository\CustomerRepository;
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
    public function get_cartDetail(CartDetailRepository $cartDetailRepository): Response
    {
        $cartDetails = $cartDetailRepository->findAll();
        //dd($cartDetail);
        return $this->render('cart_detail/index.html.twig',
            ['cartDetails' => $cartDetails]);
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
            $this->addFlash('success', 'cartDetail\'s inserted successfully');
            return $this->redirectToRoute('app_cartDetail_create');
        }

        return $this->render('cartDetail/create.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/cart_detail/{id}', name: 'app_cart_detail_details')]
    public function detailsAction(CartDetail $cartDetail): Response
    {
        return $this->render('cart_detail/details.html.twig', [
            'cartDetail' => $cartDetail
        ]);
    }
    #[Route('/cart_detail/edit/{id}', name: 'app_cart_detail_edit')]
    public function editAction(Request $request, CartDetailRepository $cartDetailRepository, CartDetail $cartDetail): Response
    {
        $form = $this->createForm(CartDetailType::class, $cartDetail);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cartDetail = $form->getData();
            $cartDetailRepository->save($cartDetail, true);

            $this->addFlash('success', 'cart_detail\'s updated successfully');
            return $this->redirectToRoute('app_cart_detail_all');
        }

        return $this->render('cart_detail/edit.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/cart_detail/delete/{id}', name: 'app_cart_detail_delete')]
    public function deleteAction(CartDetail $cartDetail, CartDetailRepository $cartDetailRepository): Response
    {
        $cartDetailRepository->remove($cartDetail, true);
        $this->addFlash('success', 'Cart Detail has been deleted!');
        return $this->redirectToRoute('app_cart_detail_all');
    }
}
