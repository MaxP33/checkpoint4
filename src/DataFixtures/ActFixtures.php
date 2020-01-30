<?php

namespace App\DataFixtures;

use App\Entity\Act;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ActFixtures extends Fixture
{
    const ACTS = [
        'Comme dans un rêve' => [
            'description' => 'Spectacle de lumière',
        ],
        'Dans le cercle fermé de l’excellence' => [
            'description' => 'Numéro de cerceau',
        ],
        'Le manège de l’amour' => [
            'description' => 'La cavalerie du Wild Circus',
        ],
        'Abracadabra' => [
            'description' => 'Tours de magie',
        ],
        'Un humour percutant' => [
            'description' => 'Gags',
        ],
        'Un amour féroce' => [
            'description' => 'Lions dans la cage',
        ],
    ];
    public function load(ObjectManager $manager)
    {

        foreach (self::ACTS as $name => $data) {
            $act = new Act();
            $act->setName($name);
            $act->setDescription($data['description']);
            $manager->persist($act);
        }
        $manager->flush();
    }
}
