<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
<<<<<<< HEAD
use AppBundle\Entity\Episode;
=======
>>>>>>> 07e5ea18527176765bbab6d7313ce01befc52fc7
use AppBundle\Entity\Serie;
use AppBundle\Entity\Language;

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

        $french = new Language();
        $french->setName('français');
        $french->setsName('fr'); 

        $serie = new Serie();
        $serie->setName('Girls');
        $serie->setDescription('Girls est une série qui suit la vie d\'un groupe 
             d\'amies ayant la vingtaine et qui vivent leur vie à New York. 
             Les principaux aspects du personnage principal ont été inspirés 
             par certaines expériences de Lena Dunham, une des actrices principales 
             de la série.');

        $serie->setEpisode('null');
        $serie->setLanguage($french);
        $serie->setThTvdbID(0);
        $serie->setValidated(true);
         //$serie->setPicture('https://commons.wikimedia.org/w/index.php?title=File:Girls-logo.svg&lang=fr&uselang=fr');
         $manager->persist($serie);

        $episode = new Episode();
        $episode->setName('Les aventures de José');
        $episode->setDescription('José est poursuivit par Claudette nue avec son fusil afin de récupérer son bien à savoir : son dentier ');
        $episode->setSaison('saison 1');
        $episode->setValidated(true);
        $episode->setLanguage($french);
        $episode->setAuthor($user);

        $manager->persist($episode);
        $manager->persist($french);

    
        $manager->flush();
    }
<<<<<<< HEAD

} 
=======
}

class LoadSerieData implements FixtureInterface
{
    public function load (ObjectManager $manager)
    {   $french = new Language();
        $french->setName('français');
        $french->setsName('fr');
        $engilsh = new Language();
        $engilsh->setName('engilsh');
        $engilsh->setsName('en');
        $serie = new Serie();
        $serie->setName('Girls');
        $serie->setDescription('Girls est une série qui suit la vie d\'un groupe 
            d\'amies ayant la vingtaine et qui vivent leur vie à New York. 
            Les principaux aspects du personnage principal ont été inspirés 
            par certaines expériences de Lena Dunham, une des actrices principales de la série.');
        $serie->setEpisode('null');
        $serie->setLanguage($french);
        $serie->setThTvdbID(0);
        $serie->setValidated(true);
        //$serie->setPicture('https://commons.wikimedia.org/w/index.php?title=File:Girls-logo.svg&lang=fr&uselang=fr');
        $manager->persist($serie);
        $manager->persist($french);

        $manager->flush();
        


    }
}
>>>>>>> 07e5ea18527176765bbab6d7313ce01befc52fc7

