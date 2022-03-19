<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use App\Entity\User;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $categories = ['Php', 'Symfony', 'Api'];

        foreach ($categories as $cat) {
            $category = new Category();
            $category->setName($cat);
            $manager->persist($category);
        }
        $manager->flush();

        $categories = $manager->getRepository(Category::class)->findAll();

        for ($i = 0; $i < 50; $i++) {
            $post = new Post();
            $post->setName($faker->name());
            $post->setCategory($faker->randomElement($categories));
            $post->setText($faker->text());
            $post->setCreatedAt($faker->DateTime());
            $post->setUpdateAt($faker->DateTime());
            $post->setSlug('slug-name' . $i);
            $manager->persist($post);
        }
        $manager->flush();
    
    }
}
