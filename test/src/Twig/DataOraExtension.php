<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Symfony\Component\Validator\Constraints\DateTime;
class DataOraExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('data', [$this, 'output_datetime']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('data', [$this, 'output_datetime']),
        ];
    }

    public function doSomething($value)
    {
        
    }
    public function output_datetime()
    {
        $seconds = time();
        $x = gmdate("d/m/Y H:i:s",$seconds);
        return $x;
    }
}
