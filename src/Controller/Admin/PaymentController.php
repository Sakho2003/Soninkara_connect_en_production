<?php

namespace App\Controller\Admin;

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

    #[Route('/admin/paiements', name: 'admin_paiements')]
    public function gestionPaiements(): Response
    {
        // Logique pour la gestion administrative des paiements gerer plus tard
        // ...

        return $this->render('pages/administrateur/payment/index.html.twig', [
            'controller_name' => 'PaymentController',
        ]);
    }
}
