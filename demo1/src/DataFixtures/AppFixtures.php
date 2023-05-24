<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{

    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');
        for ($j = 1; $j < 10; $j++) {
            $category = new Category();
            $name = $faker->sentence(3);
            $slug = $this->slugger->slug($name);
            $category->setName($name)
            ->setDescription($faker->paragraph(3))
            ->setCreatedAt(new \DateTimeImmutable($faker->date()))
            ->setSlug($slug)
            ->setPicture('https://picsum.photos/seed/cat'.$j.'/1600');

            $manager->persist($category);

            for($i=1;$i < 20;$i++) {
                $product = new Product();
                $name = $faker->sentence(3);
                $slug = $this->slugger->slug($name);
                $product->setName($name)
                ->setDescription($faker->paragraph(3))
                ->setPrice($faker->randomFloat(2, 0, 5000))
                ->setPicture('https://picsum.photos/seed/prod'.$i.'/1600')
                ->setSlug($slug)
                ->setCreatedAt(new \DateTimeImmutable($faker->date()))
                ->setCategory($category);

                // $product = new Product();
                $manager->persist($product);
            }
        }
        $manager->flush();
    }
}
