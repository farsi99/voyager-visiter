<?php

namespace App\DataFixtures;

use App\Entity\Annoncer;
use App\Entity\Biens;
use App\Entity\Commentaire;
use App\Entity\Commune;
use App\Entity\Image;
use App\Entity\Optionbien;
use App\Entity\Region;
use App\Entity\Reserver;
use Faker\Factory;
use App\Entity\Role;
use App\Entity\User;
use DateTime;
use bheller\ImagesGenerator\ImagesGeneratorProvider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        //Initialisation de facker
        $faker = Factory::create('FR-fr');

        //creéons un role pour les users
        $adminRole = new Role();
        $adminRole->setTitre('ROLE_ADMIN');
        $manager->persist($adminRole);

        //On crée un admin par défaut
        $adminUser = new User();
        $adminUser->setCivilite("Mr");
        $adminUser->setNom('Soulé');
        $adminUser->setPrenom('Farouk');
        $adminUser->setEmail('farsi_99@hotmail.com');
        $adminUser->setDateNaissance($faker->dateTimeAD($max = 'now', $timezone = null));
        $adminUser->setAdresse($faker->streetAddress);
        $adminUser->setCodePostal($faker->postcode);
        $adminUser->setVille($faker->city);
        $adminUser->setPays($faker->country);
        $adminUser->setDateInscription(new DateTime());
        $adminUser->setTelephone($faker->phoneNumber);
        $adminUser->setMotpasse($this->encoder->encodePassword($adminUser, 'password'));
        $adminUser->setPhoto("https://avatars.io/twitter/LiiorC");
        $adminUser->addUserRole($adminRole);

        $manager->persist($adminUser);
        // Nous gerons les autres utilisateurs
        $tabUsers = [];
        $genres = ['male', 'female'];
        $tabBien = [];

        for ($i = 1; $i <= 10; $i++) {
            $genre = $genres[mt_rand(0, 1)];

            $picture = 'https://randomuser.me/api/portraits/';
            $pictureId = $faker->numberBetween(1, 99) . '.jpg';
            $picture = $picture . ($genre == "male" ? "men/" : "women/") . $pictureId;

            $users = new User();
            $users->setCivilite($genre == 'male' ? 'Mr' : 'Mme');
            $users->setNom($faker->firstName($genre));
            $users->setPrenom($faker->lastName);
            $users->setEmail($faker->email);
            $users->setDateNaissance($faker->dateTimeAD($max = 'now', $timezone = null));
            $users->setAdresse($faker->streetAddress);
            $users->setCodePostal($faker->postcode);
            $users->setVille($faker->city);
            $users->setPays($faker->country);
            $users->setDateInscription($faker->dateTimeAD($max = 'now', $timezone = null));
            $users->setTelephone($faker->phoneNumber);
            $users->setMotpasse($this->encoder->encodePassword($users, 'password'));
            $users->setPhoto($picture);

            $manager->persist($users);
            $tabUsers[] = $users;
        }

        //Gestion des regions        
        $communes = ['Grde Comores', 'Anjouan', 'Moheli'];
        $tabCommune = [];
        for ($i = 0; $i < count($communes); $i++) {
            $commune = new Commune();
            $commune->setLibelle($communes[$i])
                ->setDescription('<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>');
            $manager->persist($commune);
            $tabCommune[] = $commune;

            //Gestion des images regions
            for ($j = 1; $j < mt_rand(1, 4); $j++) {
                $image = new Image();
                $faker->addProvider(new ImagesGeneratorProvider($faker));
                $image->setTitre($faker->sentence());
                $image->setLien($faker->imageGenerator());
                $image->setCommune($commune);
                $manager->persist($image);
            }
        }

        //ajout de biens 
        $type = ['Hôtel', 'Particulier'];
        $cuisine = ['Equipée', 'Gaz', 'Au feu de bois', 'pas de cuisine'];
        $eau = ['Courant', 'Citerne', 'Pas eau'];
        $electricite = ['branchement public', 'Groupe électrogène', 'Energie solaire', 'Archaique'];
        for ($k = 1; $k < 50; $k++) {
            $commune = $tabCommune[mt_rand(0, count($tabCommune) - 1)];
            $proprio = $tabUsers[mt_rand(0, count($tabUsers) - 1)];
            $bien = new Biens();
            $bien->setTitre($faker->sentence())
                ->setDescription('<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>')
                ->setSuperficie(mt_rand(35, 500))
                ->setNbrePiece(mt_rand(1, 7))
                ->setNbreChambre(mt_rand(0, 6))
                ->setNbreVisiteur(mt_rand(1, 6))
                ->setPrix(mt_rand(100, 5000))
                ->setAdresse($faker->streetAddress)
                ->setCodePostal($faker->postcode)
                ->setVille($faker->city)
                ->setPays($faker->country)
                ->setTypeBien($type[mt_rand(0, 1)])
                ->setCommune($commune)
                ->setMetas($faker->sentence())
                ->setDateCreation($faker->dateTime('-2 years'))
                ->setProprio($proprio)
                ->setSalleBain(mt_rand(1, 3))
                ->setClimatisation(mt_rand(0, 1))
                ->setCuisine($cuisine[mt_rand(0, count($cuisine) - 1)])
                ->setEau($eau[mt_rand(0, count($eau) - 1)])
                ->setInternet(mt_rand(0, 1))
                ->setElectricite($electricite[mt_rand(0, count($electricite) - 1)])
                ->setNbreLit(mt_rand(1, 6));
            $manager->persist($bien);

            $tabBien[] = $bien;

            //Ajout des images 
            $tabImages = ["img/room1.jpg", "img/room2.jpg", "img/room3.jpg", "img/room4.jpg", "img/room5.jpg", "img/room6.jpg"];
            //Gestion des images 
            for ($l = 1; $l < mt_rand(1, 4); $l++) {
                $image = new Image();
                $faker->addProvider(new ImagesGeneratorProvider($faker));
                $image->setTitre($faker->sentence());
                $image->setLien($tabImages[mt_rand(0, 5)]);
                $image->setBiens($bien);
                $manager->persist($image);
            }

            //reservation
            for ($n = 1; $n < mt_rand(1, 25); $n++) {
                $user = $tabUsers[mt_rand(0, count($tabUsers) - 1)];
                $reserver = new Reserver();
                $createdAt = $faker->dateTime('-6 months');
                $debut = $faker->dateTimeBetween('-months');
                $duration = mt_rand(1, 10);
                $fin = (clone $debut)->modify("+$duration days");
                $price = $bien->getPrix() * $duration;
                $reserver->setDateCreation($createdAt)
                    ->setDateDebut($debut)
                    ->setDateFin($fin)
                    ->setMontant($price)
                    ->setUser($user)
                    ->setBiens($bien);
                $manager->persist($reserver);

                //Gestion des commentaires
                for ($h = 1; $h <= mt_rand(1, 10); $h++) {
                    $users = $tabUsers[mt_rand(0, count($tabUsers) - 1)];
                    $commentaire = new Commentaire();
                    $commentaire->setVote(mt_rand(1, 5))
                        ->setContenue($faker->sentence())
                        ->setUser($users)
                        ->setReserver($reserver);
                    $manager->persist($commentaire);
                }
            }
        }

        //on ajout en base
        $manager->flush();
    }
}
