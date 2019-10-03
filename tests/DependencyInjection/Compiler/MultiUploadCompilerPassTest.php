<?php

namespace Wow\Sonata\MultiUploadBundle\Tests\DependencyInjection\Compiler;

use PHPUnit\Framework\TestCase;
use Wow\Sonata\MultiUploadBundle\DependencyInjection\Compiler\MultiUploadCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class MultiUploadCompilerPassTest extends TestCase
{
    public function testProcess()
    {
        $definition = $this->createMock(Definition::class);

        $container = $this->createMock(ContainerBuilder::class);
        $container
            ->expects($this->once())
            ->method('getDefinition')
            ->with('sonata.media.provider.image')
            ->willReturn($definition);

        $taggedServices = [
            'sonata.media.provider.image' => [0 => ['multi_upload' => true]],
            'sonata.media.provider.youtube' => [0 => ['multi_upload' => false]],
            'sonata.media.provider.vimeo' => [],
        ];

        $container
            ->expects($this->once())
            ->method('findTaggedServiceIds')
            ->with('sonata.media.provider')
            ->willReturn($taggedServices);

        $definition
            ->expects($this->once())
            ->method('addMethodCall')
            ->with('setMultiUpload', [true]);

        $compilerPass = new MultiUploadCompilerPass();
        $compilerPass->process($container);
    }
}
