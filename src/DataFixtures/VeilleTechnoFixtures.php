<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use DateTimeImmutable;
use App\Entity\Category;
use App\Entity\VeilleTechno;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class VeilleTechnoFixtures extends Fixture
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
            $veilleTechno = new VeilleTechno();
            $veilleTechno->setName('nameVeilleTechno'. $i);
            $veilleTechno->addCategory($faker->randomElement($categories));
            $veilleTechno->setAuthor($faker->name());
            $veilleTechno->setLien('lien' . $i);
            $veilleTechno->setSlug('slug-veilleTechno' . $i);
            $manager->persist($veilleTechno);
        }
        $manager->flush();
    
    }
}
