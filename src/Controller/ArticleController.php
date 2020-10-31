<?php


namespace App\Controller;


use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(LoggerInterface $logger, ArticleRepository $ar)
    {
        $articles = $ar->findAllPublishedOrderedByNewest();

        $logger->info('Homepage is accessed right now!');
        return $this->render('article/homepage.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/news/{slug}")
     * @param Article $article
     * @return Response
     */
    public function show(Article $article): Response
    {
        $comments = [
            'lorem  ipsulum',
            'lorem  ipsulum',
            'lorem  ipsulum',
        ];

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'comments' => $comments
        ]);
    }
}