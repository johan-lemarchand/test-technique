<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Product;
use App\Entity\Avis;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
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

        // On crée une instance de Faker en français
        $generator = Faker\Factory::create('fr_FR');

        // On passe le Manager de Doctrine à Faker !
        $populator = new Faker\ORM\Doctrine\Populator($generator, $manager);

        for ($i = 1; $i <= 30; $i++){

        $product = new Product();


        $name = $generator->sentence(4);
        $picture = $generator->imageUrl(100, 100);
        $description =$generator->sentence(10);



        $product->setName($name);
        $product->setDescription($description);
        $product->setPrice(mt_rand(20, 90));
        $product->setPicture($picture);

        if(mt_rand(0, 1)) {
            $avis = new Avis();

            $email = $generator->safeEmail;
            $pseudo = $generator->firstName;
            $comment = $generator->sentence(30);
            $picture = $generator->imageUrl(50, 50);


            $avis->setEmail($email);
            $avis->setPseudo($pseudo);
            $avis->setComment($comment);
            $avis->setPicture($picture);
            $avis->setRate(mt_rand(0, 5));
            $avis->setProduct($product);

            $manager->persist($avis);
        }


        $manager->persist($product);
        }

        // Flush
        $manager->flush();
    }
}