<?php


namespace App\Controller;


use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/article/new")
     * @throws Exception
     */
    public function new(EntityManagerInterface $em)
    {
        $article = new Article();
        $article->setTitle('Why asteroids Taste Like Bacon')
            ->setSlug('why-asteroids-like-bacon'.random_int(1,100))
            ->setContent(<<<EOF
 **Lorem ipsum** dolor sit amet, bacon adipisicing elit. Aperiam assumenda distinctio dolor dolore labore
            [beef ribs](https://google.com)maxime officia perspiciatis quidem sed voluptate? Debitis et fuga omnis quidem quisquam reprehenderit soluta
            vitae voluptates.

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid at cumque in nemo nesciunt totam voluptate!
            Alias beatae est itaque mollitia nam necessitatibus neque rem? Asperiores et laudantium modi neque?

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusamus, autem cumque doloremque earum
            eligendi facere itaque maxime nisi odit quaerat quidem rem rerum suscipit temporibus tenetur veniam
            voluptate voluptatem.
EOF);
        if (random_int(1,10) > 2) {
            $article->setPublishedAt(new \DateTime(sprintf('-%d days', random_int(1,100))));
        }

        $article->setAuthor('Marcelo Almeida')
            ->setHeartCount(random_int(5, 100))
            ->setImageFilename('asteroids.jpg');

        $em->persist($article);
        $em->flush();

        return new Response(sprintf(
            'Hiya! New article id: %d slug: %s',
            $article->getId(),
            $article->getSlug()
        ));
    }
}