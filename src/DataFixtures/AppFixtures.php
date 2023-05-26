<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Places;
use App\Entity\Picture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        // Création de 10 utilisateurs
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setFirstName($faker->firstName);
            $user->setName($faker->lastName);
            $user->setEmail($faker->email);
            $user->setPassword(password_hash($faker->password, PASSWORD_DEFAULT));
            $user->setUsername(strtolower($user->getFirstName() . '.' . $user->getName()));
            $user->setRoles(['ROLE_USER']);

            $manager->persist($user);
        }

        // Création de 10 lieux insolites
        for ($i = 0; $i < 10; $i++) {
            $place = new Places();
            $place->setName($faker->streetName);
            $place->setDescription($faker->paragraph);
            $place->setLatitude($faker->latitude);
            $place->setLongitude($faker->longitude);
            $place->setPhotos($faker->imageUrl);
            $place->setDatePublication(new \DateTimeImmutable());

            $randomUser = $faker->randomElement($manager->getRepository(User::class)->findAll());
            if ($randomUser) {
                $place->setUser($randomUser->getId());
            }

            $manager->persist($place);
        }

        $manager->flush();
    }
}
