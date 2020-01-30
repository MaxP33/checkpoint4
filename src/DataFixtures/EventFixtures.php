<?php

namespace App\DataFixtures;

use App\Entity\Event;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EventFixtures extends Fixture
{
    const EVENTS = [
        'Bordeaux' => [
            'description' => 'Du 06 Février au 09 Février',
            'start_date'  => '2020-02-06',
            'end_date' => '2020-02-09',
            'duration'    => '2H'
        ],
        'Niort' => [
            'description' => 'Du 13 Février au 16 Février',
            'start_date' => '2020-02-13',
            'end_date' => '2020-02-16',
            'duration'    => '2H'
        ],
        'Le Mans' => [
            'description' => 'Du 20 Février au 23 Février',
            'start_date' => '2020-02-20',
            'end_date' => '2020-02-23',
            'duration'    => '2H'
        ],
        'Evreux' => [
            'description' => 'Du 27 Février au 01 Mars',
            'start_date' => '2020-02-27',
            'end_date' => '2020-03-01',
            'duration'    => '2H'
        ],
        'Rouen' => [
            'description' => 'Du 05 Mars au 08 Mars',
            'start_date' => '2020-03-05',
            'end_date' => '2020-03-08',
            'duration'    => '2H'
        ],
        'Arras' => [
            'description' => 'Du 12 Mars au 15 Mars',
            'start_date' => '2020-03-12',
            'end_date' => '2020-03-15',
            'duration'    => '2H'
        ],
    ];
    public function load(ObjectManager $manager)
    {

        foreach (self::EVENTS as $location => $data) {
            $event = new Event();
            $event->setLocation($location);
            $event->setDescription(($data['description']));
            $event->setStartDate(DateTime::createFromFormat('Y-m-d', $data['start_date']));
            $event->setEndDate(DateTime::createFromFormat('Y-m-d', $data['end_date']));
            $event->setDuration($data['duration']);
            $manager->persist($event);
        }
        $manager->flush();
    }
}
