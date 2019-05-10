<?php declare(strict_types=1);

namespace App\DataFixtures\BasicFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use function sprintf;

/**
 * AccountFixtures
 *
 * @package App\DataFixtures\TestFixtures
 */
class AccountFixtures extends Fixture
{
    /** @var UserManagerInterface */
    protected $userManager;

    /** @var PasswordEncoderInterface */
    protected $encoder;

    /** @var int */
    private $amount = 10;

    /**
     * Assigns data from arguments as class fields
     *
     * @param UserManagerInterface         $userManager
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserManagerInterface $userManager, UserPasswordEncoderInterface $encoder)
    {
        $this->userManager = $userManager;
        $this->encoder = $encoder;
    }

    /** @inheritDoc */
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < $this->amount; $i++) {
            $account = $this->userManager->createUser();
            $account->setUsername(sprintf('test%d', $i))
                    ->setEmail(sprintf('test%d@domain.net', $i))
                    ->setPlainPassword(sprintf('test%d', $i))
                    ->setEnabled(true)
                    ->setRoles(['ROLE_WORKER']);
            $manager->persist($account);
        }
        $manager->flush();
    }
}
