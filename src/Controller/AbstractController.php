<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;

class AbstractController extends SymfonyAbstractController
{
    /**
     * Get a user from the Security Token Storage.
     *
     * @throws \LogicException If SecurityBundle is not available
     *
     * @see TokenInterface::getUser()
     */
    protected function getUser(): ?User
    {
        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The SecurityBundle is not registered in your application. Try running "composer require symfony/security-bundle".');
        }

        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            return null;
        }

        return $token->getUser();
    }
}
