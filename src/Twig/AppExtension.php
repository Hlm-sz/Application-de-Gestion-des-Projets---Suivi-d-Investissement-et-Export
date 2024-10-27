<?php

namespace App\Twig;

use Exception;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

class AppExtension extends AbstractExtension
{


    public function getFunctions(): array
    {
        return [
            new TwigFunction('is_array', [$this, 'isArray']),
        ];
    }

    public function isArray($value)
    {
        if(!is_array($value)){
            return "false";
        }else{
            return "true";
        }
        
    }
}
