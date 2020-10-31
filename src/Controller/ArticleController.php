<?php


namespace App\Controller;


use App\Service\MarkdownHelper;
use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(LoggerInterface $logger)
    {
        $logger->info('Homepage is accessed right now!');
        return $this->render('article/homepage.html.twig');
    }

    /**
     * @Route("/news/{slug}")
     */
    public function show($slug, MarkdownHelper $markdownHelper)
    {
        $comments = [
            'lorem  ipsulum',
            'lorem  ipsulum',
            'lorem  ipsulum',
        ];

        $articleContent = <<<EOF
 **Lorem ipsum** dolor sit amet, bacon adipisicing elit. Aperiam assumenda distinctio dolor dolore labore
            [beef ribs](https://google.com)maxime officia perspiciatis quidem sed voluptate? Debitis et fuga omnis quidem quisquam reprehenderit soluta
            vitae voluptates.

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid at cumque in nemo nesciunt totam voluptate!
            Alias beatae est itaque mollitia nam necessitatibus neque rem? Asperiores et laudantium modi neque?

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusamus, autem cumque doloremque earum
            eligendi facere itaque maxime nisi odit quaerat quidem rem rerum suscipit temporibus tenetur veniam
            voluptate voluptatem.
EOF;

        $articleContent = $markdownHelper->parse($articleContent);

        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'articleContent' => $articleContent,
            'slug' => $slug,
            'comments' => $comments
        ]);
    }
}