<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    protected $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setNom('Morel')->setPrenom('Celine');
        $user->setEmail('celine@gmail.com');
        $encoded = $this->encoder->hashPassword($user, '123');
        $user->setPassword($encoded);
        $user->setRoles(['ROLE_USER']);

        $admin = new User();
        $admin->setNom('Morel')->setPrenom('Celine');
        $admin->setEmail('admin@gmail.com');
        $encodedAdmin = $this->encoder->hashPassword($admin, '345');
        $admin->setPassword($encodedAdmin);
        $admin->setRoles(['ROLE_ADMIN']);

        $employee = new User();

        $encodedEmployee = $this->encoder->hashPassword($employee, '123');
        $employee->setNom('Morel')->setPrenom('Celine')->setEmail('employee@gmail.com')->setPassword($encodedEmployee)->setRoles(['ROLE_EMPLOYEE']);

        $manager->persist($user);
        $manager->persist($admin);
        $manager->persist($employee);

        $manager->flush();
    }
}
