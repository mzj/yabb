<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tag
 *
 * @author Ana
 */
namespace MZJ\YabBundle\Entity;

use FPN\TagBundle\Entity\Tag as BaseTag;

class Tag extends BaseTag
{
     protected $tagging;
     
    public function __toString() 
    {
        return $this->name;
    }
}
    //put your code here

