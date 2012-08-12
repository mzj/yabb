<?php

namespace MZJ\YabBundle\DependencyInjection\Compiler;



use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
    Symfony\Component\DependencyInjection\ContainerBuilder;

class CompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('fpn_tag.tag_manager');
        $definition->setClass('MZJ\YabBundle\Entity\TagManager');
    }
}

?>
