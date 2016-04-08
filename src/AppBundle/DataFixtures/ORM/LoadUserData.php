<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Picture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\User;
use AppBundle\Entity\Episode;
use AppBundle\Entity\Serie;
use AppBundle\Entity\Language;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
        /**
         * @var ContainerInterface
         */
        private $container;

        public function setContainer(ContainerInterface $container = null)
        {
                $this->container = $container;
        }


        public function load(ObjectManager $manager)
        {
                $userAdmin = new User();
                $userAdmin->setFirstName('John');
                $userAdmin->setLastName('Kevin');
                $userAdmin->setUsername('admin');
                $userAdmin->setBirth(new \DateTime());
                $userAdmin->setPlainPassword('test');
                $userAdmin->setEmail('admin@domain.net');
                $userAdmin->setEnabled(true);
                $userAdmin->setRoles(array('ROLE_ADMIN', 'ROLE_MODERATOR'));
                $manager->persist($userAdmin);

                $userModerator = new User();
                $userModerator->setFirstName('Samanta');
                $userModerator->setLastName('Durand');
                $userModerator->setBirth(new \DateTime());
                $userModerator->setUsername('moderator');
                $userModerator->setPlainPassword('test');
                $userModerator->setRoles(array('ROLE_MODERATOR'));
                $userModerator->setEnabled(true);
                $userModerator->setEmail('moderator@domain.net');
                $manager->persist($userModerator);

                $user = new User();
                $user->setUsername('user');
                $user->setFirstName('Gabriel');
                $user->setLastName('Block');
                $user->setBirth(new \DateTime());
                $user->setPlainPassword('test');
                $user->setEmail('user@domain.net');
                $user->setEnabled(true);
                $manager->persist($user);

                $french = new Language();
                $french->setName('français');
                $french->setsName('fr');
                $manager->persist($french);

                $english = new Language();
                $english->setName('english');
                $english->setsName('en');
                $manager->persist($english);

                // Get Api Service

                $api = $this->container->get('thetvdb');

                $serieImport=['289590','277165','75897','73255','262980','77092','81189','80379','268156','269689','153021','260449','290853','121361','78857','83348','74582','264586','220411','79168','76156','281630'];

                foreach($serieImport as $serieId){
                        $serie = new Serie();
                        $serie->setThTvdbID($serieId);
                        $tvdbData = $api->getTvShowAndEpisodes($serieId,'fr'); // On récupère les infos de TheTvDb
                        $tvdbSerie = $tvdbData['tvshow'];
                        $tvdbEpisodes = $tvdbData['episodes'];

                        $serie->setName($tvdbSerie->getName());
                        $serie->setDescription($tvdbSerie->getOverview());
                        $serie->setEpisode('null');
                        $serie->setLanguage($french);
                        $serie->setThTvdbID($tvdbSerie->getId());
                        $serie->setAuthor($userModerator);
                        $serie->setValidated(true);
                        $seriePicture = new Picture();
                        $seriePicture->setUrl($tvdbSerie->getPosterUrl());
                        $seriePicture->setAlt('Affiche');
                        $seriePicture->setValidated(true);
                        $seriePicture->setSerie($serie);
                        $serie->addPicture($seriePicture);
                        $manager->persist($serie);
                        $manager->persist($seriePicture);

                        foreach($tvdbEpisodes as $episodeData){
                                $episode = new Episode();
                                $episode->setSerie($serie);
                                $episode->setName($episodeData->getName());
                                $episode->setDescription($episodeData->getOverview());
                                $episode->setSaison($episodeData->getSeasonNumber());
                                $episode->setEpisodeNumber($episodeData->getEpisodeNumber());
                                $episode->setLanguage($french);
                                $episode->setAuthor($userModerator);
                                $episode->setValidated(1);
                                $manager->persist($episode);

                        }
                }

                $manager->flush();
        }
}

