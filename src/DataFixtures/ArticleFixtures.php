<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends BaseFixture
{
    private static $articleTitles = [
        'Why Asteroids Taste Like Bacon',
        'Life on Planet Mercury: Tan, Relaxing and Fabulous',
        'Light Speed Travel: Fountain of Youth or Fallacy'
    ];

    private static $articleImages = [
        'asteroids.jpg',
        'mercury.jpg',
        'lightspeed.jpeg',
    ];

    private static $articleAuthors = [
        'Marcelo Almeida',
        'Ana Pereira',
        'Camila Oliveira'
    ];

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Article::class, 10, function (Article $article, $count) {
            $article->setTitle($this->faker->randomElement(self::$articleTitles))
                ->setContent(<<<EOF
 **Lorem ipsum** dolor sit amet, bacon adipisicing elit. Aperiam assumenda distinctio dolor dolore labore
            [beef ribs](https://google.com)maxime officia perspiciatis quidem sed voluptate? Debitis et fuga omnis quidem quisquam reprehenderit soluta
            vitae voluptates.

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid at cumque in nemo nesciunt totam voluptate!
            Alias beatae est itaque mollitia nam necessitatibus neque rem? Asperiores et laudantium modi neque?

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusamus, autem cumque doloremque earum
            eligendi facere itaque maxime nisi odit quaerat quidem rem rerum suscipit temporibus tenetur veniam
            voluptate voluptatem.
EOF
                );
            if ($this->faker->boolean(70)) {
                $article->setPublishedAt($this->faker->dateTimeBetween('-100 days', '-1 days'));
            }

            $article->setAuthor($this->faker->randomElement(self::$articleAuthors))
                ->setHeartCount($this->faker->numberBetween(5, 100))
                ->setImageFilename($this->faker->randomElement(self::$articleImages));
        });
        $manager->flush();
    }
}
