<?php

namespace App\DataFixtures\ProductionFixtures;

use App\Entity\Explicit\TrackObjectType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TrackObjectTypeFixtures extends Fixture implements FixtureGroupInterface
{
    private const DATA = [
        ['Station with A category', '--station-big',],
        ['S-Bahn only station', '--station-sbahn',],
        ['All other stations', '--station',],
        ['Former station', '--station-former',],
        ['Highway under or above the track', '--highway',],
        ['National road', '--national-road',],
        ['Railway infrastructure', '--railway',],
        ['River or other bridge over water', '--river',],
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
            $trackObjectType->setName($source[0])
                            ->setStyleClass($source[1]);
            $manager->persist($trackObjectType);
        }

        $manager->flush();
    }
}
