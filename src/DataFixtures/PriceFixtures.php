<?php

namespace App\DataFixtures;

use App\Entity\Price;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PriceFixtures extends Fixture
{
    const PRICES = [
        'Enfant' => [
            'price' => 10,
        ],
        'Adulte' => [
            'price' => 20,
        ],
        'Senior' => [
            'price' => 16,
        ],
    ];
    public function load(ObjectManager $manager)
    {

        foreach (self::PRICES as $name => $data) {
            $price = new Price();
            $price->setName($name);
            $price->setPrice($data['price']);
            $manager->persist($price);
        }
        $manager->flush();
    }
}
