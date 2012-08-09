<?php

namespace MZJ\YabBundle\Twig\Extension;

//use MZJ\YabBundle\Exception\LessThanZeroException;

class RepeatExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'repeat' => new \Twig_Filter_Method($this, 'repeat'),
        );
    }

    public function repeat($str, $times)
    {
        if($times < 0) {
            throw new \Exception();
        }
        return str_repeat($str, $times);
    }

    public function getName()
    {
        return 'repeat_extension';
    }
}
