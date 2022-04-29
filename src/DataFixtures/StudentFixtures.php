<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Student;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class StudentFixtures extends Fixture
{
    
    private UserPasswordHasherInterface $hasher;
    
    // public function load(ObjectManager $manager): void
    // {
    //     // $product = new Product();
    //     // $manager->persist($product);

    //     // $manager->flush();
    // }

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    // ...
    public function load(ObjectManager $manager)
    {
        $student = new Student();
        $student->setEmail('student@app.com');
        $student->setRoles(["ROLE_STUDENT"]);

        $password = $this->hasher->hashPassword($student, 'pass_1234');
        $student->setPassword($password);

        $manager->persist($student);
        $manager->flush();
    }
}
