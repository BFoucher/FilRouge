<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Picture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use AppBundle\Entity\Episode;
use AppBundle\Entity\Serie;
use AppBundle\Entity\Language;

class LoadUserData implements FixtureInterface
{
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
                $serie->setAuthor($userModerator);
                $serie->setValidated(true);
                $seriePicture = new Picture();
                $seriePicture->setUrl('http://www.cinemablend.com/images/sections/40691/_1332368316.jpg');
                $seriePicture->setAlt('Affiche');
                $seriePicture->setValidated(true);
                $seriePicture->setSerie($serie);
                $serie->addPicture($seriePicture);
                $manager->persist($serie);
                $manager->persist($seriePicture);

                $episode = new Episode();
                $episode->setName('Les aventures de José');
                $episode->setDescription('José est poursuivit par Claudette nue avec son fusil afin de récupérer son bien à savoir : son dentier ');
                $episode->setSerie($serie);
                $episode->setSaison(1);
                $episode->setEpisodeNumber(1);
                $episode->setValidated(true);
                $episode->setLanguage($french);
                $episode->setAuthor($user);

                $manager->persist($episode);

                $serie = new Serie();
                $serie->setName('Silicon Valley');
                $serie->setDescription('Dans la Silicon Valley d\'aujourd\'hui, les personnes les plus qualifiées pour réussir ne sont pas forcément celles les plus qualifiées pour savoir comment le gérer...');
                $serie->setLanguage($french);
                $serie->setThTvdbID(0);
                $serie->setAuthor($userAdmin);
                $serie->setValidated(false);
                $seriePicture = new Picture();
                $seriePicture->setUrl('http://fr.web.img6.acsta.net/pictures/14/03/05/18/02/574226.jpg');
                $seriePicture->setAlt('Affiche');
                $seriePicture->setValidated(true);
                $seriePicture->setSerie($serie);
                $serie->addPicture($seriePicture);
                $manager->persist($serie);
                $manager->persist($seriePicture);

                $episode = new Episode();
                $episode->setName('Sand Hill Shuffle');
                $episode->setDescription('Monica confronte son nouveau patron, tandis que Richard doit prendre une décision importante impliquant le futur de l\'entreprise.');
                $episode->setSerie($serie);
                $episode->setSaison(2);
                $episode->setEpisodeNumber(1);
                $episode->setValidated(false);
                $episode->setLanguage($french);
                $episode->setAuthor($user);

                $manager->persist($episode);

                $episode = new Episode();
                $episode->setName('Runaway Devaluation');
                $episode->setDescription('Au lendemain de l\'annonce de Hooli, Richard et ses amis cherchent un soutien financier. Dinesh cherche à mettre un terme à la campagne Kickstarter de son cousin.');
                $episode->setSerie($serie);
                $episode->setSaison(2);
                $episode->setEpisodeNumber(2);
                $episode->setValidated(false);
                $episode->setLanguage($french);
                $episode->setAuthor($user);

                $manager->persist($episode);

                $episode = new Episode();
                $episode->setName('Produit Minimum Viable');
                $episode->setDescription('Dans la Silicon Valley, où naissent les entreprises les plus prospères de l\'ère informatique, six programmeurs partagent la même maison et la même ambition : se faire une place dans cet univers. Ils découvrent qu\'être hautement qualifié dans un domaine ne donne pas l\'assurance de la réussite...');
                $episode->setSerie($serie);
                $episode->setSaison(1);
                $episode->setEpisodeNumber(1);
                $episode->setValidated(false);
                $episode->setLanguage($french);
                $episode->setAuthor($user);

                $manager->persist($episode);

                $episode = new Episode();
                $episode->setName('La table de capitalisation');
                $episode->setDescription('Après une fête au Hacker Hostel, Richard et Erlich apprennent que Peter Gregory ne les paiera que lorsqu\'ils auront produit un plan de développement faisant état d\'une équipe reduite. Désespéré, Richard engage Jared, un ancien sous-fifre de Belson...');
                $episode->setSerie($serie);
                $episode->setSaison(1);
                $episode->setEpisodeNumber(2);
                $episode->setValidated(false);
                $episode->setLanguage($french);
                $episode->setAuthor($user);

                $manager->persist($episode);

                $episode = new Episode();
                $episode->setName('Statuts légaux');
                $episode->setDescription('Richard découvre que le nom «Pied Piper» a déjà été déposé. Erlich se triture donc les méninges à la recherche d\'un nouveau nom pour la société. L\'attitude de Peter Gregory devient difficile à comprendre...');
                $episode->setSerie($serie);
                $episode->setSaison(1);
                $episode->setEpisodeNumber(3);
                $episode->setValidated(false);
                $episode->setLanguage($french);
                $episode->setAuthor($user);

                $manager->persist($episode);



                $manager->flush();
        }
}

