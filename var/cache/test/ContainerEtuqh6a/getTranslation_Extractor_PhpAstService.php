<?php

namespace ContainerEtuqh6a;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getTranslation_Extractor_PhpAstService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'translation.extractor.php_ast' shared service.
     *
     * @return \Symfony\Component\Translation\Extractor\PhpAstExtractor
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/translation/Extractor/AbstractFileExtractor.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/translation/Extractor/ExtractorInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/translation/Extractor/PhpAstExtractor.php';

        return $container->privates['translation.extractor.php_ast'] = new \Symfony\Component\Translation\Extractor\PhpAstExtractor(new RewindableGenerator(function () use ($container) {
            yield 0 => ($container->privates['translation.extractor.visitor.trans_method'] ??= new \Symfony\Component\Translation\Extractor\Visitor\TransMethodVisitor());
            yield 1 => ($container->privates['translation.extractor.visitor.translatable_message'] ??= new \Symfony\Component\Translation\Extractor\Visitor\TranslatableMessageVisitor());
            yield 2 => ($container->privates['translation.extractor.visitor.constraint'] ?? $container->load('getTranslation_Extractor_Visitor_ConstraintService'));
        }, 3));
    }
}
