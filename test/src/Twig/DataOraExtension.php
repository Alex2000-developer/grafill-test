<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class DataOraExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('data', [$this, 'stringa']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('data', [$this, 'stringa']),
        ];
    }

    public function doSomething($value)
    {
        
    }
    public function stringa($value)
    {
        return "Ciao";
    }
}
