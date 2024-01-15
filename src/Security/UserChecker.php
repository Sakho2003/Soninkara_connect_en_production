<?php

namespace App\Security;

use App\Entity\Client as AppClient;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof AppClient) {
            return;
        }

        // Comme c'est une vérification "pre-authentication", vous pouvez ajouter des vérifications supplémentaires ici si nécessaire.
    }

    public function checkPostAuth(UserInterface $user): void
    {
        if (!$user instanceof AppClient) {
            return;
        }

        // Vérifie si le compte de l'utilisateur est vérifié
        if (false === $user->isVerified()) {
            throw new CustomUserMessageAccountStatusException('Veuillez vérifier votre compte avant de vous connecter.');
        }

        // Vous pouvez également ajouter d'autres vérifications post-authentification ici si nécessaire.
    }
}
