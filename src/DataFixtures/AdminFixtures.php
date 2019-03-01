<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{
    private $passwordEncoder;

    private $adminPassword;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, string $adminPassword)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->adminPassword = $adminPassword;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new Admin();

        $admin->setUsername('admin');
        $admin->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            $this->adminPassword
        ));

        $manager->persist($admin);
        $manager->flush();
    }
}
