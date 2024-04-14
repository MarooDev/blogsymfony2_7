<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Post;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPostData implements FixtureInterface
{


    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        for ($i=1; $i<=200; $i++) {

           $post = new Post();
           $post->setTitle($faker->sentence(3));
           $post->setLead($faker->text(100));
           $post->setContent($faker->text(300));
           $post->setCreatedAt($faker->dateTimeThisMonth);

           $manager->persist($post);
        }
        $manager->flush();
    }
}