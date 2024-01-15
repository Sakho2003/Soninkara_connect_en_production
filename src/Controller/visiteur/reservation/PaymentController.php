<?php

namespace App\Controller\visiteur\reservation;

use App\Service\PayPalService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    private $payPalService;

    public function __construct(PayPalService $payPalService)
    {
        $this->payPalService = $payPalService;
    }

    #[Route('/payer', name: 'payer')]
    public function payer(): Response
    {
        // Logique pour initier un paiement via PayPal
        // ...

        return $this->render('pages/visiteur/payment/paypal/paiement.html.twig', [
            'controller_name' => 'PaymentController',
        ]);
    }
}

