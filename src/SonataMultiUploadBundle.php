<?php

namespace Wow\Sonata\MultiUploadBundle;

use Wow\Sonata\MultiUploadBundle\DependencyInjection\Compiler\MultiUploadCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SonataMultiUploadBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new MultiUploadCompilerPass());
    }
}
