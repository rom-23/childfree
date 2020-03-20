<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct( UserPasswordEncoderInterface $encoder )
    {
        $this -> encoder = $encoder;
    }

    public function load( ObjectManager $manager )
    {
        $faker = Factory ::create();
        $user = new User();
        $user -> setUsername( 'admin' );
        $user -> setUserEmail( 'admin@admin.com' );
        $user -> setUserPassword( $this -> encoder -> encodePassword( $user, 'admin' ) );
        $user -> setCreatedAt( $faker -> dateTimeBetween( '-6 months' ) );
        $manager -> persist( $user );
        $manager -> flush();

        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setUsername($faker -> name);
            $user->setUserEmail($faker->email);
            $user->setUserPassword($this->encoder->encodePassword($user, $faker->password));
            $user->setCreatedAt($faker->dateTimeBetween('-6 months'));
            $manager->persist($user);
        }
        $manager -> flush();
    }
}
