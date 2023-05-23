<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1;$i < 10;$i++) {
            $product = new Product();
            $product->setName('Ztotk v'. $i)->setDescription('GOTY !')->setPrice(131.99)->setPicture(null);

            // $product = new Product();
            $manager->persist($product);
        }
        $manager->flush();
    }
}
