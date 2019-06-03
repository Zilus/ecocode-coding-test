<?php
/**
 * IGNORE FIXTURE FILES
 */
namespace App\DataFixtures;

use App\Entity\User;
use App\Service\User\Manager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    /**
     * @var Manager
     */
    private $userManager;

    public function __construct(Manager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();

        $user
            ->setTitle(User::TITLE_MR)
            ->setName('test')
            ->setEmail('test@ecocode.de')
            ->setLocale('en')
            ->setPlainPassword('test');

        $this->userManager->updatePassword($user);

        $manager->persist($user);
        $manager->flush();
    }
}
