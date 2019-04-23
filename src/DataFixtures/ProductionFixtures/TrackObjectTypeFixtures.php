<?php

namespace App\DataFixtures\ProductionFixtures;

use App\Entity\Explicit\TrackObjectType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TrackObjectTypeFixtures extends Fixture implements FixtureGroupInterface
{
    private const DATA = [
        [
            'name'       => 'Station with A category',
            'styleClass' => '--station-big',
        ],
        [
            'name'       => 'S-Bahn only station',
            'styleClass' => '--station-sbahn',
        ],
        [
            'name'       => 'All other stations',
            'styleClass' => '--station',
        ],
        [
            'name'       => 'Former station',
            'styleClass' => '--station-former',
        ],
        [
            'name'       => 'Highway under or above the track',
            'styleClass' => '--highway',
        ],
        [
            'name'       => 'National road',
            'styleClass' => '--national-road',
        ],
        [
            'name'       => 'Railway infrastructure',
            'styleClass' => '--railway',
        ],
        [
            'name'       => 'River or other bridge over water',
            'styleClass' => '--river',
        ],
    ];

    /**
     * This method must return an array of groups
     * on which the implementing class belongs to
     *
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['dev', 'prod'];
    }

    /** @inheritDoc */
    public function load(ObjectManager $manager): void
    {
        foreach (self::DATA as $source) {
            $trackObjectType = new TrackObjectType();
            $trackObjectType->setName($source['name'])
                            ->setStyleClass($source['styleClass']);
            $manager->persist($trackObjectType);
        }

        $manager->flush();
    }
}
