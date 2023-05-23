<?php

namespace App\DataFixtures;

use App\Entity\Product;
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
        for($i=1;$i < 10;$i++) {
            $product = new Product();
            $name = 'Ztotk v' . $i;
            $slug = $this->slugger->slug($name);
            $product->setName($name)->setDescription('GOTY !')->setPrice(131.99)->setPicture(null)->setSlug($slug)->setCreatedAt(new \DateTimeImmutable());

            // $product = new Product();
            $manager->persist($product);
        }
        $manager->flush();
    }
}
