<?php

namespace App\EventListener\User;

use App\Entity\User;
use App\Service\User\Manager;
use DateTime;
use Exception;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

class LoginListener implements EventSubscriberInterface
{
    protected $userManager;

    public function __construct(Manager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @param InteractiveLoginEvent $event
     *
     * @throws Exception
     */
    public function onLogin(InteractiveLoginEvent $event): void
    {
        $token = $event->getAuthenticationToken();
        /** @var User $user */
        $user = $token->getUser();

        $user
            ->setLastLogin(new DateTime())
            ->setLoginCount($user->getLoginCount() + 1);

        $this->userManager->saveUser($user);
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            SecurityEvents::INTERACTIVE_LOGIN => 'onLogin'
        ];
    }
}
