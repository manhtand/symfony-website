<?php

namespace App\Controller;

use App\Form\RedeemCodeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CheckoutController extends AbstractController
{
    #[Route('/checkout', name: 'checkout')]
    public function index(): Response
    {
        $form = $this->createForm(RedeemCodeFormType::class);
        return $this->render('checkout/index.html.twig', [
            'controller_name' => 'CheckoutController',
            'redeemCodeForm' => $form,
        ]);
    }
}
