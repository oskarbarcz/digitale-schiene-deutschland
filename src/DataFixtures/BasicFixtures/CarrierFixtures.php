<?php declare(strict_types=1);

namespace App\DataFixtures\BasicFixtures;


use App\Entity\Explicit\Carrier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;

/**
 * CarrierFixtures
 *
 * @package App\DataFixtures\BasicFixtures
 */
class CarrierFixtures extends Fixture implements FixtureGroupInterface
{
    /** @var int */
    private $amounts = 10;

    /** @inheritDoc */
    public static function getGroups(): array
    {
        return ['all', 'carrier', 'basic-func'];
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < $this->amounts; $i++) {
            $carrier = new Carrier();
            $carrier->setShortName('Carrier ' . $i)
                    ->setFullName('Carrier full name ' . $i)
                    ->setWebsite('https:/www.test.com')
                    ->setCountryIbanCode('DE')
                    ->setLogoFilePath('test/carrier' . $i . '.jpg')
                    ->setShortcode('TST' . $i);
            $manager->persist($carrier);
        }
        $manager->flush();
    }
}
