<?php

namespace MZJ\YabBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    MZJ\YabBundle\DependencyInjection\Compiler\CompilerPass;
    
class MZJYabBundle extends Bundle
{    
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CompilerPass());
    }
}
