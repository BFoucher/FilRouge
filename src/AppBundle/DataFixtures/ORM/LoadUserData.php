<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPlainPassword('test');
        $userAdmin->setEmail('admin@domain.net');
        $userAdmin->setEnabled(true);
        $userAdmin->setRoles(array('ROLE_ADMIN','ROLE_MODERATOR'));
        $manager->persist($userAdmin);

        $userModerator = new User();
        $userModerator->setUsername('moderator');
        $userModerator->setPlainPassword('test');
        $userModerator->setRoles(array('ROLE_MODERATOR'));
        $userModerator->setEnabled(true);
        $userModerator->setEmail('moderator@domain.net');
        $manager->persist($userModerator);

        $user = new User();
        $user->setUsername('user');
        $user->setPlainPassword('test');
        $user->setEmail('user@domain.net');
        $user->setEnabled(true);
        $manager->persist($user);

        $manager->flush();
    }
}