<?php

namespace App\Twig;

use App\Service\MarkdownHelper;
use Psr\Container\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension implements ServiceSubscriberInterface
{
    /**
     * @var MarkdownHelper
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('cached_markdown', [$this, 'processMarkdown']),
        ];
    }

    public function processMarkdown($value): string
    {
        return $this->container
            ->get(MarkdownHelper::class)
            ->parse($value);
    }

    public static function getSubscribedServices()
    {
        return [
            MarkdownHelper::class
        ];
    }
}