<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use App\Entity\User;
use DateTimeImmutable;
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
            $category->setSlug('slug-name' .$cat);
            $manager->persist($category);
        }
        $manager->flush();

        $categories = $manager->getRepository(Category::class)->findAll();

        for ($i = 0; $i < 50; $i++) {
            $post = new Post();
            $post->setName('namePost'. $i);
            $post->setCategory($faker->randomElement($categories));
            $post->setText($faker->text());
            $post->setCreatedAt(new DateTimeImmutable());
            $post->setUpdateAt(new DateTimeImmutable());
            $post->setSlug('slug-name' . $i);
            $post->setLien('www.slug-name' . $i);
            $manager->persist($post);
        }
        $manager->flush();
    
    }
}
