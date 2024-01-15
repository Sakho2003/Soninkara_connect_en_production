<?php

namespace App\Service;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment; // Utilisez LiveEnvironment pour la production

class PayPalService
{
    private $client;

    public function __construct(string $clientId, string $clientSecret)
    {
        $environment = new SandboxEnvironment($clientId, $clientSecret);
        $this->client = new PayPalHttpClient($environment);
    }

    public function getClient(): PayPalHttpClient
    {
        return $this->client;
    }

    // Autres méthodes pour gérer les transactions PayPal
}
