<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use App\Entity\User;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $users = $manager->getRepository(User::class)->findAll();
        $posts = $manager->getRepository(Post::class)->findAll();

        for ($i = 0; $i < 50; $i++) {
            $comment = new Comment();
            $comment->setText($faker->text());
            $comment->setCreatedAt($faker->dateTimeBetween('-1 week', '+1 week'));
            $comment->setUser($faker->randomElement($users));
            $comment->setPost($faker->randomElement($posts));

            $manager->persist($comment);
        }
        $manager->flush();
    
    }
}
