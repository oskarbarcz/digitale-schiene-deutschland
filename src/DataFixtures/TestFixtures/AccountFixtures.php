<?php declare(strict_types=1);

namespace App\DataFixtures\TestFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
    public function load(ObjectManager $manager)
    {
        $account = $this->userManager->createUser();
        $account->setUsername('test0')
                ->setEmail('test0@domain.net')
                ->setPlainPassword('test0')
                ->setEnabled(true)
                ->setRoles(['ROLE_ADMIN']);

        $manager->persist($account);
        $manager->flush();
    }
}
