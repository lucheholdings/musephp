<?php

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * ResourcesTestDebugProjectContainer
 *
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 */
class ResourcesTestDebugProjectContainer extends Container
{
    private $parameters;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->parameters = $this->getDefaultParameters();

        $this->services =
        $this->scopedServices =
        $this->scopeStacks = array();

        $this->set('service_container', $this);

        $this->scopes = array('request' => 'container');
        $this->scopeChildren = array('request' => array());
        $this->methodMap = array(
            'annotation_reader' => 'getAnnotationReaderService',
            'cache_clearer' => 'getCacheClearerService',
            'cache_warmer' => 'getCacheWarmerService',
            'clio_component.cache.factory.doctrine' => 'getClioComponent_Cache_Factory_DoctrineService',
            'clio_component.cache.provider_factory.doctrine' => 'getClioComponent_Cache_ProviderFactory_DoctrineService',
            'clio_component.normalizer' => 'getClioComponent_NormalizerService',
            'clio_component.normalizer.strategy.datetime' => 'getClioComponent_Normalizer_Strategy_DatetimeService',
            'clio_component.normalizer.strategy.jms' => 'getClioComponent_Normalizer_Strategy_JmsService',
            'clio_component.normalizer.strategy.reference' => 'getClioComponent_Normalizer_Strategy_ReferenceService',
            'clio_component.normalizer.strategy.scalar' => 'getClioComponent_Normalizer_Strategy_ScalarService',
            'clio_component.normalizer.strategy.std_class' => 'getClioComponent_Normalizer_Strategy_StdClassService',
            'clio_component.normalizer.strategy_collection' => 'getClioComponent_Normalizer_StrategyCollectionService',
            'controller_name_converter' => 'getControllerNameConverterService',
            'debug.controller_resolver' => 'getDebug_ControllerResolverService',
            'debug.debug_handlers_listener' => 'getDebug_DebugHandlersListenerService',
            'debug.deprecation_logger_listener' => 'getDebug_DeprecationLoggerListenerService',
            'debug.emergency_logger_listener' => 'getDebug_EmergencyLoggerListenerService',
            'debug.event_dispatcher' => 'getDebug_EventDispatcherService',
            'debug.scream_logger_listener' => 'getDebug_ScreamLoggerListenerService',
            'debug.stopwatch' => 'getDebug_StopwatchService',
            'erato_framework.accessor.field_accessor_factory.attribute' => 'getEratoFramework_Accessor_FieldAccessorFactory_AttributeService',
            'erato_framework.accessor.field_accessor_factory.collection' => 'getEratoFramework_Accessor_FieldAccessorFactory_CollectionService',
            'erato_framework.accessor.field_accessor_factory.ignore' => 'getEratoFramework_Accessor_FieldAccessorFactory_IgnoreService',
            'erato_framework.accessor.field_accessor_factory.method' => 'getEratoFramework_Accessor_FieldAccessorFactory_MethodService',
            'erato_framework.accessor.field_accessor_factory.public_property' => 'getEratoFramework_Accessor_FieldAccessorFactory_PublicPropertyService',
            'erato_framework.accessor.field_accessor_factory.tag' => 'getEratoFramework_Accessor_FieldAccessorFactory_TagService',
            'erato_framework.accessor.registry' => 'getEratoFramework_Accessor_RegistryService',
            'erato_framework.accessor.schema_accessor_factory.class' => 'getEratoFramework_Accessor_SchemaAccessorFactory_ClassService',
            'erato_framework.accessor.schema_accessor_factory.collection' => 'getEratoFramework_Accessor_SchemaAccessorFactory_CollectionService',
            'erato_framework.accessor.schema_accessor_factory.metadata' => 'getEratoFramework_Accessor_SchemaAccessorFactory_MetadataService',
            'erato_framework.doctrine_cache_factory' => 'getEratoFramework_DoctrineCacheFactoryService',
            'erato_framework.schema.cache_clearer' => 'getEratoFramework_Metadata_CacheClearerService',
            'erato_framework.schema.class_metadata_factory' => 'getEratoFramework_Metadata_ClassMetadataFactoryService',
            'erato_framework.schema.default_mapping_factory.accessor' => 'getEratoFramework_Metadata_DefaultMappingFactory_AccessorService',
            'erato_framework.schema.mapping_factory.attribute_map' => 'getEratoFramework_Metadata_MappingFactory_AttributeMapService',
            'erato_framework.schema.mapping_factory.collection' => 'getEratoFramework_Metadata_MappingFactory_CollectionService',
            'erato_framework.schema.mapping_factory.tag_set' => 'getEratoFramework_Metadata_MappingFactory_TagSetService',
            'erato_framework.schema.mapping_injector' => 'getEratoFramework_Metadata_MappingInjectorService',
            'erato_framework.schema.rebuilder' => 'getEratoFramework_Metadata_RebuilderService',
            'erato_framework.schema.registry' => 'getEratoFramework_Metadata_RegistryService',
            'erato_framework.schema.registry.cache_loader' => 'getEratoFramework_Metadata_Registry_CacheLoaderService',
            'erato_framework.schema.registry.cache_loader.cache' => 'getEratoFramework_Metadata_Registry_CacheLoader_CacheService',
            'erato_framework.schema.registry.factory_loader' => 'getEratoFramework_Metadata_Registry_FactoryLoaderService',
            'erato_framework.normalizer' => 'getEratoFramework_NormalizerService',
            'erato_framework.normalizer.default_strategy.accessor' => 'getEratoFramework_Normalizer_DefaultStrategy_AccessorService',
            'erato_framework.normalizer.strategy.accessor' => 'getEratoFramework_Normalizer_Strategy_AccessorService',
            'erato_framework.normalizer.strategy_collection' => 'getEratoFramework_Normalizer_StrategyCollectionService',
            'erato_framework.service_registry' => 'getEratoFramework_ServiceRegistryService',
            'file_locator' => 'getFileLocatorService',
            'filesystem' => 'getFilesystemService',
            'fragment.handler' => 'getFragment_HandlerService',
            'fragment.renderer.esi' => 'getFragment_Renderer_EsiService',
            'fragment.renderer.hinclude' => 'getFragment_Renderer_HincludeService',
            'fragment.renderer.inline' => 'getFragment_Renderer_InlineService',
            'http_kernel' => 'getHttpKernelService',
            'kernel' => 'getKernelService',
            'locale_listener' => 'getLocaleListenerService',
            'property_accessor' => 'getPropertyAccessorService',
            'request' => 'getRequestService',
            'request_stack' => 'getRequestStackService',
            'response_listener' => 'getResponseListenerService',
            'router' => 'getRouterService',
            'router.request_context' => 'getRouter_RequestContextService',
            'router_listener' => 'getRouterListenerService',
            'routing.loader' => 'getRouting_LoaderService',
            'security.secure_random' => 'getSecurity_SecureRandomService',
            'service_container' => 'getServiceContainerService',
            'streamed_response_listener' => 'getStreamedResponseListenerService',
            'translation.dumper.csv' => 'getTranslation_Dumper_CsvService',
            'translation.dumper.ini' => 'getTranslation_Dumper_IniService',
            'translation.dumper.json' => 'getTranslation_Dumper_JsonService',
            'translation.dumper.mo' => 'getTranslation_Dumper_MoService',
            'translation.dumper.php' => 'getTranslation_Dumper_PhpService',
            'translation.dumper.po' => 'getTranslation_Dumper_PoService',
            'translation.dumper.qt' => 'getTranslation_Dumper_QtService',
            'translation.dumper.res' => 'getTranslation_Dumper_ResService',
            'translation.dumper.xliff' => 'getTranslation_Dumper_XliffService',
            'translation.dumper.yml' => 'getTranslation_Dumper_YmlService',
            'translation.extractor' => 'getTranslation_ExtractorService',
            'translation.extractor.php' => 'getTranslation_Extractor_PhpService',
            'translation.loader' => 'getTranslation_LoaderService',
            'translation.loader.csv' => 'getTranslation_Loader_CsvService',
            'translation.loader.dat' => 'getTranslation_Loader_DatService',
            'translation.loader.ini' => 'getTranslation_Loader_IniService',
            'translation.loader.json' => 'getTranslation_Loader_JsonService',
            'translation.loader.mo' => 'getTranslation_Loader_MoService',
            'translation.loader.php' => 'getTranslation_Loader_PhpService',
            'translation.loader.po' => 'getTranslation_Loader_PoService',
            'translation.loader.qt' => 'getTranslation_Loader_QtService',
            'translation.loader.res' => 'getTranslation_Loader_ResService',
            'translation.loader.xliff' => 'getTranslation_Loader_XliffService',
            'translation.loader.yml' => 'getTranslation_Loader_YmlService',
            'translation.writer' => 'getTranslation_WriterService',
            'translator' => 'getTranslatorService',
            'translator.default' => 'getTranslator_DefaultService',
            'translator.selector' => 'getTranslator_SelectorService',
            'uri_signer' => 'getUriSignerService',
        );
        $this->aliases = array(
            'clio_component.cache.factory' => 'clio_component.cache.factory.doctrine',
            'clio_component.cache.provider_factory' => 'clio_component.cache.provider_factory.doctrine',
            'clio_component.normalizer.strategy' => 'clio_component.normalizer.strategy_collection',
            'erato_framework.accessor.field_accessor_factory' => 'erato_framework.accessor.field_accessor_factory.collection',
            'erato_framework.accessor.schema_accessor_factory' => 'erato_framework.accessor.schema_accessor_factory.collection',
            'erato_framework.cache_factory' => 'clio_component.cache.provider_factory.doctrine',
            'erato_framework.schema.mapping_factory' => 'erato_framework.schema.mapping_factory.collection',
            'erato_framework.schema.registry.loader' => 'erato_framework.schema.registry.cache_loader',
            'erato_framework.normalizer.strategy' => 'erato_framework.normalizer.strategy_collection',
            'event_dispatcher' => 'debug.event_dispatcher',
        );
    }

    /**
     * Gets the 'annotation_reader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Doctrine\Common\Annotations\FileCacheReader A Doctrine\Common\Annotations\FileCacheReader instance.
     */
    protected function getAnnotationReaderService()
    {
        return $this->services['annotation_reader'] = new \Doctrine\Common\Annotations\FileCacheReader(new \Doctrine\Common\Annotations\AnnotationReader(), '/Users/yoshi/Workspace/muse/bundle-dev/vendor/musephp/musephp/erato/src/Erato/Adapter/SymfonyBundles/FrameworkBundle/Tests/Resources/cache/test/annotations', true);
    }

    /**
     * Gets the 'cache_clearer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpKernel\CacheClearer\ChainCacheClearer A Symfony\Component\HttpKernel\CacheClearer\ChainCacheClearer instance.
     */
    protected function getCacheClearerService()
    {
        return $this->services['cache_clearer'] = new \Symfony\Component\HttpKernel\CacheClearer\ChainCacheClearer(array(0 => $this->get('erato_framework.schema.cache_clearer')));
    }

    /**
     * Gets the 'cache_warmer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerAggregate A Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerAggregate instance.
     */
    protected function getCacheWarmerService()
    {
        return $this->services['cache_warmer'] = new \Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerAggregate(array(0 => new \Symfony\Bundle\FrameworkBundle\CacheWarmer\RouterCacheWarmer($this->get('router'))));
    }

    /**
     * Gets the 'clio_component.cache.factory.doctrine' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Bridge\DoctrineCommon\Cache\Factory\DoctrineCacheFactory A Clio\Bridge\DoctrineCommon\Cache\Factory\DoctrineCacheFactory instance.
     */
    protected function getClioComponent_Cache_Factory_DoctrineService()
    {
        return $this->services['clio_component.cache.factory.doctrine'] = new \Clio\Bridge\DoctrineCommon\Cache\Factory\DoctrineCacheFactory();
    }

    /**
     * Gets the 'clio_component.cache.provider_factory.doctrine' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Bridge\DoctrineCommon\Cache\Factory\DoctrineCacheProviderFactory A Clio\Bridge\DoctrineCommon\Cache\Factory\DoctrineCacheProviderFactory instance.
     */
    protected function getClioComponent_Cache_ProviderFactory_DoctrineService()
    {
        return $this->services['clio_component.cache.provider_factory.doctrine'] = new \Clio\Bridge\DoctrineCommon\Cache\Factory\DoctrineCacheProviderFactory();
    }

    /**
     * Gets the 'clio_component.normalizer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Tool\Normalizer\Normalizer A Clio\Component\Tool\Normalizer\Normalizer instance.
     */
    protected function getClioComponent_NormalizerService()
    {
        return $this->services['clio_component.normalizer'] = new \Clio\Component\Tool\Normalizer\Normalizer($this->get('clio_component.normalizer.strategy_collection'));
    }

    /**
     * Gets the 'clio_component.normalizer.strategy.datetime' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Tool\Normalizer\Strategy\DateTimeStrategy A Clio\Component\Tool\Normalizer\Strategy\DateTimeStrategy instance.
     */
    protected function getClioComponent_Normalizer_Strategy_DatetimeService()
    {
        return $this->services['clio_component.normalizer.strategy.datetime'] = new \Clio\Component\Tool\Normalizer\Strategy\DateTimeStrategy();
    }

    /**
     * Gets the 'clio_component.normalizer.strategy.jms' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Bridge\JMSSerializer\Normalizer\JMSSerializerStrategy A Clio\Bridge\JMSSerializer\Normalizer\JMSSerializerStrategy instance.
     */
    protected function getClioComponent_Normalizer_Strategy_JmsService()
    {
        return $this->services['clio_component.normalizer.strategy.jms'] = new \Clio\Bridge\JMSSerializer\Normalizer\JMSSerializerStrategy(NULL);
    }

    /**
     * Gets the 'clio_component.normalizer.strategy.reference' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Tool\Normalizer\Strategy\ReferenceStrategy A Clio\Component\Tool\Normalizer\Strategy\ReferenceStrategy instance.
     */
    protected function getClioComponent_Normalizer_Strategy_ReferenceService()
    {
        return $this->services['clio_component.normalizer.strategy.reference'] = new \Clio\Component\Tool\Normalizer\Strategy\ReferenceStrategy();
    }

    /**
     * Gets the 'clio_component.normalizer.strategy.scalar' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Tool\Normalizer\Strategy\ScalarStrategy A Clio\Component\Tool\Normalizer\Strategy\ScalarStrategy instance.
     */
    protected function getClioComponent_Normalizer_Strategy_ScalarService()
    {
        return $this->services['clio_component.normalizer.strategy.scalar'] = new \Clio\Component\Tool\Normalizer\Strategy\ScalarStrategy();
    }

    /**
     * Gets the 'clio_component.normalizer.strategy.std_class' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Tool\Normalizer\Strategy\StdClassStrategy A Clio\Component\Tool\Normalizer\Strategy\StdClassStrategy instance.
     */
    protected function getClioComponent_Normalizer_Strategy_StdClassService()
    {
        return $this->services['clio_component.normalizer.strategy.std_class'] = new \Clio\Component\Tool\Normalizer\Strategy\StdClassStrategy();
    }

    /**
     * Gets the 'clio_component.normalizer.strategy_collection' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Tool\Normalizer\Strategy\PriorityCollection A Clio\Component\Tool\Normalizer\Strategy\PriorityCollection instance.
     */
    protected function getClioComponent_Normalizer_StrategyCollectionService()
    {
        return $this->services['clio_component.normalizer.strategy_collection'] = new \Clio\Component\Tool\Normalizer\Strategy\PriorityCollection();
    }

    /**
     * Gets the 'debug.controller_resolver' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpKernel\Controller\TraceableControllerResolver A Symfony\Component\HttpKernel\Controller\TraceableControllerResolver instance.
     */
    protected function getDebug_ControllerResolverService()
    {
        return $this->services['debug.controller_resolver'] = new \Symfony\Component\HttpKernel\Controller\TraceableControllerResolver(new \Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver($this, $this->get('controller_name_converter'), NULL), $this->get('debug.stopwatch'));
    }

    /**
     * Gets the 'debug.debug_handlers_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\DebugHandlersListener A Symfony\Component\HttpKernel\EventListener\DebugHandlersListener instance.
     */
    protected function getDebug_DebugHandlersListenerService()
    {
        return $this->services['debug.debug_handlers_listener'] = new \Symfony\Component\HttpKernel\EventListener\DebugHandlersListener(array(0 => $this->get('http_kernel', ContainerInterface::NULL_ON_INVALID_REFERENCE), 1 => 'terminateWithException'));
    }

    /**
     * Gets the 'debug.deprecation_logger_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\ErrorsLoggerListener A Symfony\Component\HttpKernel\EventListener\ErrorsLoggerListener instance.
     */
    protected function getDebug_DeprecationLoggerListenerService()
    {
        return $this->services['debug.deprecation_logger_listener'] = new \Symfony\Component\HttpKernel\EventListener\ErrorsLoggerListener('deprecation', NULL);
    }

    /**
     * Gets the 'debug.emergency_logger_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\ErrorsLoggerListener A Symfony\Component\HttpKernel\EventListener\ErrorsLoggerListener instance.
     */
    protected function getDebug_EmergencyLoggerListenerService()
    {
        return $this->services['debug.emergency_logger_listener'] = new \Symfony\Component\HttpKernel\EventListener\ErrorsLoggerListener('emergency', NULL);
    }

    /**
     * Gets the 'debug.event_dispatcher' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher A Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher instance.
     */
    protected function getDebug_EventDispatcherService()
    {
        $this->services['debug.event_dispatcher'] = $instance = new \Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher(new \Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher($this), $this->get('debug.stopwatch'), NULL);

        $instance->addSubscriberService('response_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ResponseListener');
        $instance->addSubscriberService('streamed_response_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\StreamedResponseListener');
        $instance->addSubscriberService('locale_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\LocaleListener');
        $instance->addSubscriberService('debug.emergency_logger_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ErrorsLoggerListener');
        $instance->addSubscriberService('debug.deprecation_logger_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ErrorsLoggerListener');
        $instance->addSubscriberService('debug.scream_logger_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ErrorsLoggerListener');
        $instance->addSubscriberService('debug.debug_handlers_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\DebugHandlersListener');
        $instance->addSubscriberService('router_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\RouterListener');

        return $instance;
    }

    /**
     * Gets the 'debug.scream_logger_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\ErrorsLoggerListener A Symfony\Component\HttpKernel\EventListener\ErrorsLoggerListener instance.
     */
    protected function getDebug_ScreamLoggerListenerService()
    {
        return $this->services['debug.scream_logger_listener'] = new \Symfony\Component\HttpKernel\EventListener\ErrorsLoggerListener('scream', NULL);
    }

    /**
     * Gets the 'debug.stopwatch' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Stopwatch\Stopwatch A Symfony\Component\Stopwatch\Stopwatch instance.
     */
    protected function getDebug_StopwatchService()
    {
        return $this->services['debug.stopwatch'] = new \Symfony\Component\Stopwatch\Stopwatch();
    }

    /**
     * Gets the 'erato_framework.accessor.field_accessor_factory.attribute' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Erato\Core\Accessor\Field\Factory\AttributeMapAccessorFactory A Erato\Core\Accessor\Field\Factory\AttributeMapAccessorFactory instance.
     */
    protected function getEratoFramework_Accessor_FieldAccessorFactory_AttributeService()
    {
        return $this->services['erato_framework.accessor.field_accessor_factory.attribute'] = new \Erato\Core\Accessor\Field\Factory\AttributeMapAccessorFactory('');
    }

    /**
     * Gets the 'erato_framework.accessor.field_accessor_factory.collection' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Util\Accessor\Field\Factory\FieldAccessorFactoryCollection A Clio\Component\Util\Accessor\Field\Factory\FieldAccessorFactoryCollection instance.
     */
    protected function getEratoFramework_Accessor_FieldAccessorFactory_CollectionService()
    {
        $this->services['erato_framework.accessor.field_accessor_factory.collection'] = $instance = new \Clio\Component\Util\Accessor\Field\Factory\FieldAccessorFactoryCollection();

        $instance->set('ignore', $this->get('erato_framework.accessor.field_accessor_factory.ignore'), 0);
        $instance->set('public_property', $this->get('erato_framework.accessor.field_accessor_factory.public_property'), 0);
        $instance->set('method', $this->get('erato_framework.accessor.field_accessor_factory.method'), 0);
        $instance->set('tags', $this->get('erato_framework.accessor.field_accessor_factory.tag'), 0);
        $instance->set('attributes', $this->get('erato_framework.accessor.field_accessor_factory.attribute'), 0);

        return $instance;
    }

    /**
     * Gets the 'erato_framework.accessor.field_accessor_factory.ignore' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Util\Accessor\Field\Factory\IgnoreFieldAccessorFactory A Clio\Component\Util\Accessor\Field\Factory\IgnoreFieldAccessorFactory instance.
     */
    protected function getEratoFramework_Accessor_FieldAccessorFactory_IgnoreService()
    {
        return $this->services['erato_framework.accessor.field_accessor_factory.ignore'] = new \Clio\Component\Util\Accessor\Field\Factory\IgnoreFieldAccessorFactory();
    }

    /**
     * Gets the 'erato_framework.accessor.field_accessor_factory.method' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Util\Accessor\Field\Factory\MethodFieldAccessorFactory A Clio\Component\Util\Accessor\Field\Factory\MethodFieldAccessorFactory instance.
     */
    protected function getEratoFramework_Accessor_FieldAccessorFactory_MethodService()
    {
        return $this->services['erato_framework.accessor.field_accessor_factory.method'] = new \Clio\Component\Util\Accessor\Field\Factory\MethodFieldAccessorFactory();
    }

    /**
     * Gets the 'erato_framework.accessor.field_accessor_factory.public_property' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Util\Accessor\Field\Factory\PublicPropertyFieldAccessorFactory A Clio\Component\Util\Accessor\Field\Factory\PublicPropertyFieldAccessorFactory instance.
     */
    protected function getEratoFramework_Accessor_FieldAccessorFactory_PublicPropertyService()
    {
        return $this->services['erato_framework.accessor.field_accessor_factory.public_property'] = new \Clio\Component\Util\Accessor\Field\Factory\PublicPropertyFieldAccessorFactory();
    }

    /**
     * Gets the 'erato_framework.accessor.field_accessor_factory.tag' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Erato\Core\Accessor\Field\Factory\TagSetFieldAccessorFactory A Erato\Core\Accessor\Field\Factory\TagSetFieldAccessorFactory instance.
     */
    protected function getEratoFramework_Accessor_FieldAccessorFactory_TagService()
    {
        return $this->services['erato_framework.accessor.field_accessor_factory.tag'] = new \Erato\Core\Accessor\Field\Factory\TagSetFieldAccessorFactory();
    }

    /**
     * Gets the 'erato_framework.accessor.registry' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Erato\Core\Accessor\SchemaAccessorRegistry A Erato\Core\Accessor\SchemaAccessorRegistry instance.
     */
    protected function getEratoFramework_Accessor_RegistryService()
    {
        return $this->services['erato_framework.accessor.registry'] = new \Erato\Core\Accessor\SchemaAccessorRegistry($this->get('erato_framework.schema.registry'));
    }

    /**
     * Gets the 'erato_framework.accessor.schema_accessor_factory.class' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Util\Accessor\Schema\Factory\BasicClassAccessorFactory A Clio\Component\Util\Accessor\Schema\Factory\BasicClassAccessorFactory instance.
     */
    protected function getEratoFramework_Accessor_SchemaAccessorFactory_ClassService()
    {
        return $this->services['erato_framework.accessor.schema_accessor_factory.class'] = new \Clio\Component\Util\Accessor\Schema\Factory\BasicClassAccessorFactory($this->get('erato_framework.accessor.field_accessor_factory.collection'));
    }

    /**
     * Gets the 'erato_framework.accessor.schema_accessor_factory.collection' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Util\Accessor\Schema\Factory\SchemaAccessorFactoryCollection A Clio\Component\Util\Accessor\Schema\Factory\SchemaAccessorFactoryCollection instance.
     */
    protected function getEratoFramework_Accessor_SchemaAccessorFactory_CollectionService()
    {
        $this->services['erato_framework.accessor.schema_accessor_factory.collection'] = $instance = new \Clio\Component\Util\Accessor\Schema\Factory\SchemaAccessorFactoryCollection();

        $instance->set('class', $this->get('erato_framework.accessor.schema_accessor_factory.class'), 0);
        $instance->set('metadata', $this->get('erato_framework.accessor.schema_accessor_factory.metadata'), 0);

        return $instance;
    }

    /**
     * Gets the 'erato_framework.accessor.schema_accessor_factory.metadata' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Erato\Core\Accessor\Schema\Factory\SchemaMetadataAccessorFactory A Erato\Core\Accessor\Schema\Factory\SchemaMetadataAccessorFactory instance.
     */
    protected function getEratoFramework_Accessor_SchemaAccessorFactory_MetadataService()
    {
        return $this->services['erato_framework.accessor.schema_accessor_factory.metadata'] = new \Erato\Core\Accessor\Schema\Factory\SchemaMetadataAccessorFactory($this->get('erato_framework.accessor.field_accessor_factory.collection'));
    }

    /**
     * Gets the 'erato_framework.doctrine_cache_factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Erato\Adapter\SymfonyBundles\FrameworkBundle\Cache\DoctrineCacheFactory A Erato\Adapter\SymfonyBundles\FrameworkBundle\Cache\DoctrineCacheFactory instance.
     */
    protected function getEratoFramework_DoctrineCacheFactoryService()
    {
        return $this->services['erato_framework.doctrine_cache_factory'] = new \Erato\Adapter\SymfonyBundles\FrameworkBundle\Cache\DoctrineCacheFactory($this);
    }

    /**
     * Gets the 'erato_framework.schema.cache_clearer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Erato\Adapter\SymfonyBundles\FrameworkBundle\Cache\CacheClearer A Erato\Adapter\SymfonyBundles\FrameworkBundle\Cache\CacheClearer instance.
     */
    protected function getEratoFramework_Metadata_CacheClearerService()
    {
        return $this->services['erato_framework.schema.cache_clearer'] = new \Erato\Adapter\SymfonyBundles\FrameworkBundle\Cache\CacheClearer($this->get('erato_framework.schema.registry.cache_loader.cache', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }

    /**
     * Gets the 'erato_framework.schema.class_metadata_factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Util\Metadata\Schema\Factory\ClassMetadataFactory A Clio\Component\Util\Metadata\Schema\Factory\ClassMetadataFactory instance.
     */
    protected function getEratoFramework_Metadata_ClassMetadataFactoryService()
    {
        return $this->services['erato_framework.schema.class_metadata_factory'] = new \Clio\Component\Util\Metadata\Schema\Factory\ClassMetadataFactory($this->get('erato_framework.schema.mapping_factory.collection'));
    }

    /**
     * Gets the 'erato_framework.schema.default_mapping_factory.accessor' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Erato\Core\Metadata\Mapping\Factory\AccessorMappingFactory A Erato\Core\Metadata\Mapping\Factory\AccessorMappingFactory instance.
     */
    protected function getEratoFramework_Metadata_DefaultMappingFactory_AccessorService()
    {
        return $this->services['erato_framework.schema.default_mapping_factory.accessor'] = new \Erato\Core\Metadata\Mapping\Factory\AccessorMappingFactory($this->get('erato_framework.accessor.schema_accessor_factory.metadata', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('erato_framework.accessor.field_accessor_factory.collection', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }

    /**
     * Gets the 'erato_framework.schema.mapping_factory.attribute_map' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Erato\Core\Metadata\Mapping\Factory\AttributeMapMappingFactory A Erato\Core\Metadata\Mapping\Factory\AttributeMapMappingFactory instance.
     */
    protected function getEratoFramework_Metadata_MappingFactory_AttributeMapService()
    {
        return $this->services['erato_framework.schema.mapping_factory.attribute_map'] = new \Erato\Core\Metadata\Mapping\Factory\AttributeMapMappingFactory();
    }

    /**
     * Gets the 'erato_framework.schema.mapping_factory.collection' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Util\Metadata\Mapping\Factory\Collection A Clio\Component\Util\Metadata\Mapping\Factory\Collection instance.
     */
    protected function getEratoFramework_Metadata_MappingFactory_CollectionService()
    {
        $this->services['erato_framework.schema.mapping_factory.collection'] = $instance = new \Clio\Component\Util\Metadata\Mapping\Factory\Collection();

        $instance->set('attribute', $this->get('erato_framework.schema.mapping_factory.attribute_map'));
        $instance->set('tag', $this->get('erato_framework.schema.mapping_factory.tag_set'));

        return $instance;
    }

    /**
     * Gets the 'erato_framework.schema.mapping_factory.tag_set' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Erato\Core\Metadata\Mapping\Factory\TagSetMappingFactory A Erato\Core\Metadata\Mapping\Factory\TagSetMappingFactory instance.
     */
    protected function getEratoFramework_Metadata_MappingFactory_TagSetService()
    {
        return $this->services['erato_framework.schema.mapping_factory.tag_set'] = new \Erato\Core\Metadata\Mapping\Factory\TagSetMappingFactory();
    }

    /**
     * Gets the 'erato_framework.schema.mapping_injector' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Util\Injection\Injector A Clio\Component\Util\Injection\Injector instance.
     */
    protected function getEratoFramework_Metadata_MappingInjectorService()
    {
        return $this->services['erato_framework.schema.mapping_injector'] = $this->get('erato_framework.schema.mapping_factory.collection')->getInjector();
    }

    /**
     * Gets the 'erato_framework.schema.rebuilder' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Util\Metadata\Tool\MetadataRebuilder A Clio\Component\Util\Metadata\Tool\MetadataRebuilder instance.
     */
    protected function getEratoFramework_Metadata_RebuilderService()
    {
        return $this->services['erato_framework.schema.rebuilder'] = new \Clio\Component\Util\Metadata\Tool\MetadataRebuilder($this->get('erato_framework.schema.mapping_injector'));
    }

    /**
     * Gets the 'erato_framework.schema.registry' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Extra\Metadata\SchemaRegistry A Clio\Extra\Metadata\SchemaRegistry instance.
     */
    protected function getEratoFramework_Metadata_RegistryService()
    {
        return $this->services['erato_framework.schema.registry'] = new \Clio\Extra\Metadata\SchemaRegistry($this->get('erato_framework.schema.registry.cache_loader'));
    }

    /**
     * Gets the 'erato_framework.schema.registry.cache_loader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Extra\Registry\Loader\CachedLoader A Clio\Extra\Registry\Loader\CachedLoader instance.
     */
    protected function getEratoFramework_Metadata_Registry_CacheLoaderService()
    {
        return $this->services['erato_framework.schema.registry.cache_loader'] = new \Clio\Extra\Registry\Loader\CachedLoader($this->get('erato_framework.schema.registry.factory_loader'), $this->get('erato_framework.schema.registry.cache_loader.cache', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }

    /**
     * Gets the 'erato_framework.schema.registry.factory_loader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Pattern\Registry\Loader\MappedFactoryLoader A Clio\Component\Pattern\Registry\Loader\MappedFactoryLoader instance.
     */
    protected function getEratoFramework_Metadata_Registry_FactoryLoaderService()
    {
        return $this->services['erato_framework.schema.registry.factory_loader'] = new \Clio\Component\Pattern\Registry\Loader\MappedFactoryLoader($this->get('erato_framework.schema.class_metadata_factory'));
    }

    /**
     * Gets the 'erato_framework.normalizer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Tool\Normalizer\Normalizer A Clio\Component\Tool\Normalizer\Normalizer instance.
     */
    protected function getEratoFramework_NormalizerService()
    {
        $this->services['erato_framework.normalizer'] = $instance = new \Clio\Component\Tool\Normalizer\Normalizer($this->get('erato_framework.normalizer.strategy_collection'));

        $instance->add($this->get('clio_component.normalizer', ContainerInterface::NULL_ON_INVALID_REFERENCE));

        return $instance;
    }

    /**
     * Gets the 'erato_framework.normalizer.default_strategy.accessor' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Erato\Core\Normalizer\Strategy\AccessorStrategy A Erato\Core\Normalizer\Strategy\AccessorStrategy instance.
     */
    protected function getEratoFramework_Normalizer_DefaultStrategy_AccessorService()
    {
        return $this->services['erato_framework.normalizer.default_strategy.accessor'] = new \Erato\Core\Normalizer\Strategy\AccessorStrategy(NULL);
    }

    /**
     * Gets the 'erato_framework.normalizer.strategy.accessor' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Erato\Core\Normalizer\Strategy\AccessorStrategy A Erato\Core\Normalizer\Strategy\AccessorStrategy instance.
     */
    protected function getEratoFramework_Normalizer_Strategy_AccessorService()
    {
        return $this->services['erato_framework.normalizer.strategy.accessor'] = new \Erato\Core\Normalizer\Strategy\AccessorStrategy(NULL);
    }

    /**
     * Gets the 'erato_framework.normalizer.strategy_collection' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Component\Tool\Normalizer\Strategy\PriorityCollection A Clio\Component\Tool\Normalizer\Strategy\PriorityCollection instance.
     */
    protected function getEratoFramework_Normalizer_StrategyCollectionService()
    {
        $this->services['erato_framework.normalizer.strategy_collection'] = $instance = new \Clio\Component\Tool\Normalizer\Strategy\PriorityCollection();

        $instance->add($this->get('erato_framework.normalizer.strategy.accessor'), 100);

        return $instance;
    }

    /**
     * Gets the 'erato_framework.service_registry' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Clio\Bridge\SymfonyDI\Registry\ServiceContainerRegistry A Clio\Bridge\SymfonyDI\Registry\ServiceContainerRegistry instance.
     */
    protected function getEratoFramework_ServiceRegistryService()
    {
        return $this->services['erato_framework.service_registry'] = new \Clio\Bridge\SymfonyDI\Registry\ServiceContainerRegistry($this);
    }

    /**
     * Gets the 'file_locator' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpKernel\Config\FileLocator A Symfony\Component\HttpKernel\Config\FileLocator instance.
     */
    protected function getFileLocatorService()
    {
        return $this->services['file_locator'] = new \Symfony\Component\HttpKernel\Config\FileLocator($this->get('kernel'), '/Users/yoshi/Workspace/muse/bundle-dev/vendor/musephp/musephp/erato/src/Erato/Adapter/SymfonyBundles/FrameworkBundle/Tests/Resources/Resources');
    }

    /**
     * Gets the 'filesystem' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Filesystem\Filesystem A Symfony\Component\Filesystem\Filesystem instance.
     */
    protected function getFilesystemService()
    {
        return $this->services['filesystem'] = new \Symfony\Component\Filesystem\Filesystem();
    }

    /**
     * Gets the 'fragment.handler' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpKernel\Fragment\FragmentHandler A Symfony\Component\HttpKernel\Fragment\FragmentHandler instance.
     */
    protected function getFragment_HandlerService()
    {
        $this->services['fragment.handler'] = $instance = new \Symfony\Component\HttpKernel\Fragment\FragmentHandler(array(), true, $this->get('request_stack'));

        $instance->addRenderer($this->get('fragment.renderer.inline'));
        $instance->addRenderer($this->get('fragment.renderer.hinclude'));
        $instance->addRenderer($this->get('fragment.renderer.esi'));

        return $instance;
    }

    /**
     * Gets the 'fragment.renderer.esi' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpKernel\Fragment\EsiFragmentRenderer A Symfony\Component\HttpKernel\Fragment\EsiFragmentRenderer instance.
     */
    protected function getFragment_Renderer_EsiService()
    {
        $this->services['fragment.renderer.esi'] = $instance = new \Symfony\Component\HttpKernel\Fragment\EsiFragmentRenderer(NULL, $this->get('fragment.renderer.inline'), $this->get('uri_signer'));

        $instance->setFragmentPath('/_fragment');

        return $instance;
    }

    /**
     * Gets the 'fragment.renderer.hinclude' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Fragment\ContainerAwareHIncludeFragmentRenderer A Symfony\Bundle\FrameworkBundle\Fragment\ContainerAwareHIncludeFragmentRenderer instance.
     */
    protected function getFragment_Renderer_HincludeService()
    {
        $this->services['fragment.renderer.hinclude'] = $instance = new \Symfony\Bundle\FrameworkBundle\Fragment\ContainerAwareHIncludeFragmentRenderer($this, $this->get('uri_signer'), '');

        $instance->setFragmentPath('/_fragment');

        return $instance;
    }

    /**
     * Gets the 'fragment.renderer.inline' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpKernel\Fragment\InlineFragmentRenderer A Symfony\Component\HttpKernel\Fragment\InlineFragmentRenderer instance.
     */
    protected function getFragment_Renderer_InlineService()
    {
        $this->services['fragment.renderer.inline'] = $instance = new \Symfony\Component\HttpKernel\Fragment\InlineFragmentRenderer($this->get('http_kernel'), $this->get('debug.event_dispatcher'));

        $instance->setFragmentPath('/_fragment');

        return $instance;
    }

    /**
     * Gets the 'http_kernel' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpKernel\DependencyInjection\ContainerAwareHttpKernel A Symfony\Component\HttpKernel\DependencyInjection\ContainerAwareHttpKernel instance.
     */
    protected function getHttpKernelService()
    {
        return $this->services['http_kernel'] = new \Symfony\Component\HttpKernel\DependencyInjection\ContainerAwareHttpKernel($this->get('debug.event_dispatcher'), $this, $this->get('debug.controller_resolver'), $this->get('request_stack'));
    }

    /**
     * Gets the 'kernel' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @throws RuntimeException always since this service is expected to be injected dynamically
     */
    protected function getKernelService()
    {
        throw new RuntimeException('You have requested a synthetic service ("kernel"). The DIC does not know how to construct this service.');
    }

    /**
     * Gets the 'locale_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\LocaleListener A Symfony\Component\HttpKernel\EventListener\LocaleListener instance.
     */
    protected function getLocaleListenerService()
    {
        return $this->services['locale_listener'] = new \Symfony\Component\HttpKernel\EventListener\LocaleListener('en', $this->get('router', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('request_stack'));
    }

    /**
     * Gets the 'property_accessor' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\PropertyAccess\PropertyAccessor A Symfony\Component\PropertyAccess\PropertyAccessor instance.
     */
    protected function getPropertyAccessorService()
    {
        return $this->services['property_accessor'] = new \Symfony\Component\PropertyAccess\PropertyAccessor();
    }

    /**
     * Gets the 'request' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @throws RuntimeException always since this service is expected to be injected dynamically
     * @throws InactiveScopeException when the 'request' service is requested while the 'request' scope is not active
     */
    protected function getRequestService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('request', 'request');
        }

        throw new RuntimeException('You have requested a synthetic service ("request"). The DIC does not know how to construct this service.');
    }

    /**
     * Gets the 'request_stack' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpFoundation\RequestStack A Symfony\Component\HttpFoundation\RequestStack instance.
     */
    protected function getRequestStackService()
    {
        return $this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack();
    }

    /**
     * Gets the 'response_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\ResponseListener A Symfony\Component\HttpKernel\EventListener\ResponseListener instance.
     */
    protected function getResponseListenerService()
    {
        return $this->services['response_listener'] = new \Symfony\Component\HttpKernel\EventListener\ResponseListener('UTF-8');
    }

    /**
     * Gets the 'router' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Routing\Router A Symfony\Bundle\FrameworkBundle\Routing\Router instance.
     */
    protected function getRouterService()
    {
        return $this->services['router'] = new \Symfony\Bundle\FrameworkBundle\Routing\Router($this, '/Users/yoshi/Workspace/muse/bundle-dev/vendor/musephp/musephp/erato/src/Erato/Adapter/SymfonyBundles/FrameworkBundle/Tests/Resources/config/routing.yml', array('cache_dir' => '/Users/yoshi/Workspace/muse/bundle-dev/vendor/musephp/musephp/erato/src/Erato/Adapter/SymfonyBundles/FrameworkBundle/Tests/Resources/cache/test', 'debug' => true, 'generator_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator', 'generator_base_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator', 'generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper', 'generator_cache_class' => 'ResourcesTestUrlGenerator', 'matcher_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_base_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper', 'matcher_cache_class' => 'ResourcesTestUrlMatcher', 'strict_requirements' => true), $this->get('router.request_context', ContainerInterface::NULL_ON_INVALID_REFERENCE), NULL);
    }

    /**
     * Gets the 'router_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\RouterListener A Symfony\Component\HttpKernel\EventListener\RouterListener instance.
     */
    protected function getRouterListenerService()
    {
        return $this->services['router_listener'] = new \Symfony\Component\HttpKernel\EventListener\RouterListener($this->get('router'), $this->get('router.request_context', ContainerInterface::NULL_ON_INVALID_REFERENCE), NULL, $this->get('request_stack'));
    }

    /**
     * Gets the 'routing.loader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader A Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader instance.
     */
    protected function getRouting_LoaderService()
    {
        $a = $this->get('file_locator');

        $b = new \Symfony\Component\Config\Loader\LoaderResolver();
        $b->addLoader(new \Symfony\Component\Routing\Loader\XmlFileLoader($a));
        $b->addLoader(new \Symfony\Component\Routing\Loader\YamlFileLoader($a));
        $b->addLoader(new \Symfony\Component\Routing\Loader\PhpFileLoader($a));

        return $this->services['routing.loader'] = new \Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader($this->get('controller_name_converter'), NULL, $b);
    }

    /**
     * Gets the 'security.secure_random' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Security\Core\Util\SecureRandom A Symfony\Component\Security\Core\Util\SecureRandom instance.
     */
    protected function getSecurity_SecureRandomService()
    {
        return $this->services['security.secure_random'] = new \Symfony\Component\Security\Core\Util\SecureRandom('/Users/yoshi/Workspace/muse/bundle-dev/vendor/musephp/musephp/erato/src/Erato/Adapter/SymfonyBundles/FrameworkBundle/Tests/Resources/cache/test/secure_random.seed', NULL);
    }

    /**
     * Gets the 'service_container' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @throws RuntimeException always since this service is expected to be injected dynamically
     */
    protected function getServiceContainerService()
    {
        throw new RuntimeException('You have requested a synthetic service ("service_container"). The DIC does not know how to construct this service.');
    }

    /**
     * Gets the 'streamed_response_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\StreamedResponseListener A Symfony\Component\HttpKernel\EventListener\StreamedResponseListener instance.
     */
    protected function getStreamedResponseListenerService()
    {
        return $this->services['streamed_response_listener'] = new \Symfony\Component\HttpKernel\EventListener\StreamedResponseListener();
    }

    /**
     * Gets the 'translation.dumper.csv' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Dumper\CsvFileDumper A Symfony\Component\Translation\Dumper\CsvFileDumper instance.
     */
    protected function getTranslation_Dumper_CsvService()
    {
        return $this->services['translation.dumper.csv'] = new \Symfony\Component\Translation\Dumper\CsvFileDumper();
    }

    /**
     * Gets the 'translation.dumper.ini' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Dumper\IniFileDumper A Symfony\Component\Translation\Dumper\IniFileDumper instance.
     */
    protected function getTranslation_Dumper_IniService()
    {
        return $this->services['translation.dumper.ini'] = new \Symfony\Component\Translation\Dumper\IniFileDumper();
    }

    /**
     * Gets the 'translation.dumper.json' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Dumper\JsonFileDumper A Symfony\Component\Translation\Dumper\JsonFileDumper instance.
     */
    protected function getTranslation_Dumper_JsonService()
    {
        return $this->services['translation.dumper.json'] = new \Symfony\Component\Translation\Dumper\JsonFileDumper();
    }

    /**
     * Gets the 'translation.dumper.mo' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Dumper\MoFileDumper A Symfony\Component\Translation\Dumper\MoFileDumper instance.
     */
    protected function getTranslation_Dumper_MoService()
    {
        return $this->services['translation.dumper.mo'] = new \Symfony\Component\Translation\Dumper\MoFileDumper();
    }

    /**
     * Gets the 'translation.dumper.php' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Dumper\PhpFileDumper A Symfony\Component\Translation\Dumper\PhpFileDumper instance.
     */
    protected function getTranslation_Dumper_PhpService()
    {
        return $this->services['translation.dumper.php'] = new \Symfony\Component\Translation\Dumper\PhpFileDumper();
    }

    /**
     * Gets the 'translation.dumper.po' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Dumper\PoFileDumper A Symfony\Component\Translation\Dumper\PoFileDumper instance.
     */
    protected function getTranslation_Dumper_PoService()
    {
        return $this->services['translation.dumper.po'] = new \Symfony\Component\Translation\Dumper\PoFileDumper();
    }

    /**
     * Gets the 'translation.dumper.qt' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Dumper\QtFileDumper A Symfony\Component\Translation\Dumper\QtFileDumper instance.
     */
    protected function getTranslation_Dumper_QtService()
    {
        return $this->services['translation.dumper.qt'] = new \Symfony\Component\Translation\Dumper\QtFileDumper();
    }

    /**
     * Gets the 'translation.dumper.res' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Dumper\IcuResFileDumper A Symfony\Component\Translation\Dumper\IcuResFileDumper instance.
     */
    protected function getTranslation_Dumper_ResService()
    {
        return $this->services['translation.dumper.res'] = new \Symfony\Component\Translation\Dumper\IcuResFileDumper();
    }

    /**
     * Gets the 'translation.dumper.xliff' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Dumper\XliffFileDumper A Symfony\Component\Translation\Dumper\XliffFileDumper instance.
     */
    protected function getTranslation_Dumper_XliffService()
    {
        return $this->services['translation.dumper.xliff'] = new \Symfony\Component\Translation\Dumper\XliffFileDumper();
    }

    /**
     * Gets the 'translation.dumper.yml' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Dumper\YamlFileDumper A Symfony\Component\Translation\Dumper\YamlFileDumper instance.
     */
    protected function getTranslation_Dumper_YmlService()
    {
        return $this->services['translation.dumper.yml'] = new \Symfony\Component\Translation\Dumper\YamlFileDumper();
    }

    /**
     * Gets the 'translation.extractor' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Extractor\ChainExtractor A Symfony\Component\Translation\Extractor\ChainExtractor instance.
     */
    protected function getTranslation_ExtractorService()
    {
        $this->services['translation.extractor'] = $instance = new \Symfony\Component\Translation\Extractor\ChainExtractor();

        $instance->addExtractor('php', $this->get('translation.extractor.php'));

        return $instance;
    }

    /**
     * Gets the 'translation.extractor.php' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Translation\PhpExtractor A Symfony\Bundle\FrameworkBundle\Translation\PhpExtractor instance.
     */
    protected function getTranslation_Extractor_PhpService()
    {
        return $this->services['translation.extractor.php'] = new \Symfony\Bundle\FrameworkBundle\Translation\PhpExtractor();
    }

    /**
     * Gets the 'translation.loader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Translation\TranslationLoader A Symfony\Bundle\FrameworkBundle\Translation\TranslationLoader instance.
     */
    protected function getTranslation_LoaderService()
    {
        $a = $this->get('translation.loader.xliff');

        $this->services['translation.loader'] = $instance = new \Symfony\Bundle\FrameworkBundle\Translation\TranslationLoader();

        $instance->addLoader('php', $this->get('translation.loader.php'));
        $instance->addLoader('yml', $this->get('translation.loader.yml'));
        $instance->addLoader('xlf', $a);
        $instance->addLoader('xliff', $a);
        $instance->addLoader('po', $this->get('translation.loader.po'));
        $instance->addLoader('mo', $this->get('translation.loader.mo'));
        $instance->addLoader('ts', $this->get('translation.loader.qt'));
        $instance->addLoader('csv', $this->get('translation.loader.csv'));
        $instance->addLoader('res', $this->get('translation.loader.res'));
        $instance->addLoader('dat', $this->get('translation.loader.dat'));
        $instance->addLoader('ini', $this->get('translation.loader.ini'));
        $instance->addLoader('json', $this->get('translation.loader.json'));

        return $instance;
    }

    /**
     * Gets the 'translation.loader.csv' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Loader\CsvFileLoader A Symfony\Component\Translation\Loader\CsvFileLoader instance.
     */
    protected function getTranslation_Loader_CsvService()
    {
        return $this->services['translation.loader.csv'] = new \Symfony\Component\Translation\Loader\CsvFileLoader();
    }

    /**
     * Gets the 'translation.loader.dat' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Loader\IcuDatFileLoader A Symfony\Component\Translation\Loader\IcuDatFileLoader instance.
     */
    protected function getTranslation_Loader_DatService()
    {
        return $this->services['translation.loader.dat'] = new \Symfony\Component\Translation\Loader\IcuDatFileLoader();
    }

    /**
     * Gets the 'translation.loader.ini' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Loader\IniFileLoader A Symfony\Component\Translation\Loader\IniFileLoader instance.
     */
    protected function getTranslation_Loader_IniService()
    {
        return $this->services['translation.loader.ini'] = new \Symfony\Component\Translation\Loader\IniFileLoader();
    }

    /**
     * Gets the 'translation.loader.json' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Loader\JsonFileLoader A Symfony\Component\Translation\Loader\JsonFileLoader instance.
     */
    protected function getTranslation_Loader_JsonService()
    {
        return $this->services['translation.loader.json'] = new \Symfony\Component\Translation\Loader\JsonFileLoader();
    }

    /**
     * Gets the 'translation.loader.mo' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Loader\MoFileLoader A Symfony\Component\Translation\Loader\MoFileLoader instance.
     */
    protected function getTranslation_Loader_MoService()
    {
        return $this->services['translation.loader.mo'] = new \Symfony\Component\Translation\Loader\MoFileLoader();
    }

    /**
     * Gets the 'translation.loader.php' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Loader\PhpFileLoader A Symfony\Component\Translation\Loader\PhpFileLoader instance.
     */
    protected function getTranslation_Loader_PhpService()
    {
        return $this->services['translation.loader.php'] = new \Symfony\Component\Translation\Loader\PhpFileLoader();
    }

    /**
     * Gets the 'translation.loader.po' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Loader\PoFileLoader A Symfony\Component\Translation\Loader\PoFileLoader instance.
     */
    protected function getTranslation_Loader_PoService()
    {
        return $this->services['translation.loader.po'] = new \Symfony\Component\Translation\Loader\PoFileLoader();
    }

    /**
     * Gets the 'translation.loader.qt' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Loader\QtFileLoader A Symfony\Component\Translation\Loader\QtFileLoader instance.
     */
    protected function getTranslation_Loader_QtService()
    {
        return $this->services['translation.loader.qt'] = new \Symfony\Component\Translation\Loader\QtFileLoader();
    }

    /**
     * Gets the 'translation.loader.res' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Loader\IcuResFileLoader A Symfony\Component\Translation\Loader\IcuResFileLoader instance.
     */
    protected function getTranslation_Loader_ResService()
    {
        return $this->services['translation.loader.res'] = new \Symfony\Component\Translation\Loader\IcuResFileLoader();
    }

    /**
     * Gets the 'translation.loader.xliff' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Loader\XliffFileLoader A Symfony\Component\Translation\Loader\XliffFileLoader instance.
     */
    protected function getTranslation_Loader_XliffService()
    {
        return $this->services['translation.loader.xliff'] = new \Symfony\Component\Translation\Loader\XliffFileLoader();
    }

    /**
     * Gets the 'translation.loader.yml' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Loader\YamlFileLoader A Symfony\Component\Translation\Loader\YamlFileLoader instance.
     */
    protected function getTranslation_Loader_YmlService()
    {
        return $this->services['translation.loader.yml'] = new \Symfony\Component\Translation\Loader\YamlFileLoader();
    }

    /**
     * Gets the 'translation.writer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\Writer\TranslationWriter A Symfony\Component\Translation\Writer\TranslationWriter instance.
     */
    protected function getTranslation_WriterService()
    {
        $this->services['translation.writer'] = $instance = new \Symfony\Component\Translation\Writer\TranslationWriter();

        $instance->addDumper('php', $this->get('translation.dumper.php'));
        $instance->addDumper('xlf', $this->get('translation.dumper.xliff'));
        $instance->addDumper('po', $this->get('translation.dumper.po'));
        $instance->addDumper('mo', $this->get('translation.dumper.mo'));
        $instance->addDumper('yml', $this->get('translation.dumper.yml'));
        $instance->addDumper('ts', $this->get('translation.dumper.qt'));
        $instance->addDumper('csv', $this->get('translation.dumper.csv'));
        $instance->addDumper('ini', $this->get('translation.dumper.ini'));
        $instance->addDumper('json', $this->get('translation.dumper.json'));
        $instance->addDumper('res', $this->get('translation.dumper.res'));

        return $instance;
    }

    /**
     * Gets the 'translator' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\Translation\IdentityTranslator A Symfony\Component\Translation\IdentityTranslator instance.
     */
    protected function getTranslatorService()
    {
        return $this->services['translator'] = new \Symfony\Component\Translation\IdentityTranslator($this->get('translator.selector'));
    }

    /**
     * Gets the 'translator.default' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Translation\Translator A Symfony\Bundle\FrameworkBundle\Translation\Translator instance.
     */
    protected function getTranslator_DefaultService()
    {
        return $this->services['translator.default'] = new \Symfony\Bundle\FrameworkBundle\Translation\Translator($this, $this->get('translator.selector'), array('translation.loader.php' => array(0 => 'php'), 'translation.loader.yml' => array(0 => 'yml'), 'translation.loader.xliff' => array(0 => 'xlf', 1 => 'xliff'), 'translation.loader.po' => array(0 => 'po'), 'translation.loader.mo' => array(0 => 'mo'), 'translation.loader.qt' => array(0 => 'ts'), 'translation.loader.csv' => array(0 => 'csv'), 'translation.loader.res' => array(0 => 'res'), 'translation.loader.dat' => array(0 => 'dat'), 'translation.loader.ini' => array(0 => 'ini'), 'translation.loader.json' => array(0 => 'json')), array('cache_dir' => '/Users/yoshi/Workspace/muse/bundle-dev/vendor/musephp/musephp/erato/src/Erato/Adapter/SymfonyBundles/FrameworkBundle/Tests/Resources/cache/test/translations', 'debug' => true));
    }

    /**
     * Gets the 'uri_signer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Symfony\Component\HttpKernel\UriSigner A Symfony\Component\HttpKernel\UriSigner instance.
     */
    protected function getUriSignerService()
    {
        return $this->services['uri_signer'] = new \Symfony\Component\HttpKernel\UriSigner('xxxxxxxxxx');
    }

    /**
     * Gets the 'controller_name_converter' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser A Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser instance.
     */
    protected function getControllerNameConverterService()
    {
        return $this->services['controller_name_converter'] = new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser($this->get('kernel'));
    }

    /**
     * Gets the 'erato_framework.schema.registry.cache_loader.cache' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return \Clio\Component\Util\Cache\CacheProvider A Clio\Component\Util\Cache\CacheProvider instance.
     */
    protected function getEratoFramework_Metadata_Registry_CacheLoader_CacheService()
    {
        return $this->services['erato_framework.schema.registry.cache_loader.cache'] = $this->get('clio_component.cache.provider_factory.doctrine')->createCacheProvider('file_system', array('directory' => '/Users/yoshi/Workspace/muse/bundle-dev/vendor/musephp/musephp/erato/src/Erato/Adapter/SymfonyBundles/FrameworkBundle/Tests/Resources/cache/test/erato_framework', 'extension' => 'cache.php'));
    }

    /**
     * Gets the 'router.request_context' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return \Symfony\Component\Routing\RequestContext A Symfony\Component\Routing\RequestContext instance.
     */
    protected function getRouter_RequestContextService()
    {
        return $this->services['router.request_context'] = new \Symfony\Component\Routing\RequestContext('', 'GET', 'localhost', 'http', 80, 443);
    }

    /**
     * Gets the 'translator.selector' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return \Symfony\Component\Translation\MessageSelector A Symfony\Component\Translation\MessageSelector instance.
     */
    protected function getTranslator_SelectorService()
    {
        return $this->services['translator.selector'] = new \Symfony\Component\Translation\MessageSelector();
    }

    /**
     * {@inheritdoc}
     */
    public function getParameter($name)
    {
        $name = strtolower($name);

        if (!(isset($this->parameters[$name]) || array_key_exists($name, $this->parameters))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }

        return $this->parameters[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function hasParameter($name)
    {
        $name = strtolower($name);

        return isset($this->parameters[$name]) || array_key_exists($name, $this->parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    /**
     * {@inheritdoc}
     */
    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $this->parameterBag = new FrozenParameterBag($this->parameters);
        }

        return $this->parameterBag;
    }
    /**
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return array(
            'kernel.root_dir' => '/Users/yoshi/Workspace/muse/bundle-dev/vendor/musephp/musephp/erato/src/Erato/Adapter/SymfonyBundles/FrameworkBundle/Tests/Resources',
            'kernel.environment' => 'test',
            'kernel.debug' => true,
            'kernel.name' => 'Resources',
            'kernel.cache_dir' => '/Users/yoshi/Workspace/muse/bundle-dev/vendor/musephp/musephp/erato/src/Erato/Adapter/SymfonyBundles/FrameworkBundle/Tests/Resources/cache/test',
            'kernel.logs_dir' => '/Users/yoshi/Workspace/muse/bundle-dev/vendor/musephp/musephp/erato/src/Erato/Adapter/SymfonyBundles/FrameworkBundle/Tests/Resources/logs',
            'kernel.bundles' => array(
                'FrameworkBundle' => 'Symfony\\Bundle\\FrameworkBundle\\FrameworkBundle',
                'TestBundle' => 'Symfony\\Bundle\\AsseticBundle\\Tests\\TestBundle\\TestBundle',
                'ClioComponentBundle' => 'Clio\\Adapter\\SymfonyBundles\\ComponentBundle\\ClioComponentBundle',
                'EratoFrameworkBundle' => 'Erato\\Adapter\\SymfonyBundles\\FrameworkBundle\\EratoFrameworkBundle',
            ),
            'kernel.charset' => 'UTF-8',
            'kernel.container_class' => 'ResourcesTestDebugProjectContainer',
            'controller_resolver.class' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\ControllerResolver',
            'controller_name_converter.class' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\ControllerNameParser',
            'response_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ResponseListener',
            'streamed_response_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\StreamedResponseListener',
            'locale_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\LocaleListener',
            'event_dispatcher.class' => 'Symfony\\Component\\EventDispatcher\\ContainerAwareEventDispatcher',
            'http_kernel.class' => 'Symfony\\Component\\HttpKernel\\DependencyInjection\\ContainerAwareHttpKernel',
            'filesystem.class' => 'Symfony\\Component\\Filesystem\\Filesystem',
            'cache_warmer.class' => 'Symfony\\Component\\HttpKernel\\CacheWarmer\\CacheWarmerAggregate',
            'cache_clearer.class' => 'Symfony\\Component\\HttpKernel\\CacheClearer\\ChainCacheClearer',
            'file_locator.class' => 'Symfony\\Component\\HttpKernel\\Config\\FileLocator',
            'uri_signer.class' => 'Symfony\\Component\\HttpKernel\\UriSigner',
            'request_stack.class' => 'Symfony\\Component\\HttpFoundation\\RequestStack',
            'fragment.handler.class' => 'Symfony\\Component\\HttpKernel\\Fragment\\FragmentHandler',
            'fragment.renderer.inline.class' => 'Symfony\\Component\\HttpKernel\\Fragment\\InlineFragmentRenderer',
            'fragment.renderer.hinclude.class' => 'Symfony\\Bundle\\FrameworkBundle\\Fragment\\ContainerAwareHIncludeFragmentRenderer',
            'fragment.renderer.hinclude.global_template' => '',
            'fragment.renderer.esi.class' => 'Symfony\\Component\\HttpKernel\\Fragment\\EsiFragmentRenderer',
            'fragment.path' => '/_fragment',
            'translator.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\Translator',
            'translator.identity.class' => 'Symfony\\Component\\Translation\\IdentityTranslator',
            'translator.selector.class' => 'Symfony\\Component\\Translation\\MessageSelector',
            'translation.loader.php.class' => 'Symfony\\Component\\Translation\\Loader\\PhpFileLoader',
            'translation.loader.yml.class' => 'Symfony\\Component\\Translation\\Loader\\YamlFileLoader',
            'translation.loader.xliff.class' => 'Symfony\\Component\\Translation\\Loader\\XliffFileLoader',
            'translation.loader.po.class' => 'Symfony\\Component\\Translation\\Loader\\PoFileLoader',
            'translation.loader.mo.class' => 'Symfony\\Component\\Translation\\Loader\\MoFileLoader',
            'translation.loader.qt.class' => 'Symfony\\Component\\Translation\\Loader\\QtFileLoader',
            'translation.loader.csv.class' => 'Symfony\\Component\\Translation\\Loader\\CsvFileLoader',
            'translation.loader.res.class' => 'Symfony\\Component\\Translation\\Loader\\IcuResFileLoader',
            'translation.loader.dat.class' => 'Symfony\\Component\\Translation\\Loader\\IcuDatFileLoader',
            'translation.loader.ini.class' => 'Symfony\\Component\\Translation\\Loader\\IniFileLoader',
            'translation.loader.json.class' => 'Symfony\\Component\\Translation\\Loader\\JsonFileLoader',
            'translation.dumper.php.class' => 'Symfony\\Component\\Translation\\Dumper\\PhpFileDumper',
            'translation.dumper.xliff.class' => 'Symfony\\Component\\Translation\\Dumper\\XliffFileDumper',
            'translation.dumper.po.class' => 'Symfony\\Component\\Translation\\Dumper\\PoFileDumper',
            'translation.dumper.mo.class' => 'Symfony\\Component\\Translation\\Dumper\\MoFileDumper',
            'translation.dumper.yml.class' => 'Symfony\\Component\\Translation\\Dumper\\YamlFileDumper',
            'translation.dumper.qt.class' => 'Symfony\\Component\\Translation\\Dumper\\QtFileDumper',
            'translation.dumper.csv.class' => 'Symfony\\Component\\Translation\\Dumper\\CsvFileDumper',
            'translation.dumper.ini.class' => 'Symfony\\Component\\Translation\\Dumper\\IniFileDumper',
            'translation.dumper.json.class' => 'Symfony\\Component\\Translation\\Dumper\\JsonFileDumper',
            'translation.dumper.res.class' => 'Symfony\\Component\\Translation\\Dumper\\IcuResFileDumper',
            'translation.extractor.php.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\PhpExtractor',
            'translation.loader.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\TranslationLoader',
            'translation.extractor.class' => 'Symfony\\Component\\Translation\\Extractor\\ChainExtractor',
            'translation.writer.class' => 'Symfony\\Component\\Translation\\Writer\\TranslationWriter',
            'property_accessor.class' => 'Symfony\\Component\\PropertyAccess\\PropertyAccessor',
            'debug.errors_logger_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ErrorsLoggerListener',
            'debug.event_dispatcher.class' => 'Symfony\\Component\\HttpKernel\\Debug\\TraceableEventDispatcher',
            'debug.stopwatch.class' => 'Symfony\\Component\\Stopwatch\\Stopwatch',
            'debug.container.dump' => '/Users/yoshi/Workspace/muse/bundle-dev/vendor/musephp/musephp/erato/src/Erato/Adapter/SymfonyBundles/FrameworkBundle/Tests/Resources/cache/test/ResourcesTestDebugProjectContainer.xml',
            'debug.controller_resolver.class' => 'Symfony\\Component\\HttpKernel\\Controller\\TraceableControllerResolver',
            'debug.debug_handlers_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\DebugHandlersListener',
            'kernel.secret' => 'xxxxxxxxxx',
            'kernel.http_method_override' => true,
            'kernel.trusted_hosts' => array(

            ),
            'kernel.trusted_proxies' => array(

            ),
            'kernel.default_locale' => 'en',
            'security.secure_random.class' => 'Symfony\\Component\\Security\\Core\\Util\\SecureRandom',
            'data_collector.templates' => array(

            ),
            'router.class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\Router',
            'router.request_context.class' => 'Symfony\\Component\\Routing\\RequestContext',
            'routing.loader.class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\DelegatingLoader',
            'routing.resolver.class' => 'Symfony\\Component\\Config\\Loader\\LoaderResolver',
            'routing.loader.xml.class' => 'Symfony\\Component\\Routing\\Loader\\XmlFileLoader',
            'routing.loader.yml.class' => 'Symfony\\Component\\Routing\\Loader\\YamlFileLoader',
            'routing.loader.php.class' => 'Symfony\\Component\\Routing\\Loader\\PhpFileLoader',
            'router.options.generator_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator',
            'router.options.generator_base_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator',
            'router.options.generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper',
            'router.options.matcher_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher',
            'router.options.matcher_base_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher',
            'router.options.matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper',
            'router.cache_warmer.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\RouterCacheWarmer',
            'router.options.matcher.cache_class' => 'ResourcesTestUrlMatcher',
            'router.options.generator.cache_class' => 'ResourcesTestUrlGenerator',
            'router_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\RouterListener',
            'router.request_context.host' => 'localhost',
            'router.request_context.scheme' => 'http',
            'router.request_context.base_url' => '',
            'router.resource' => '/Users/yoshi/Workspace/muse/bundle-dev/vendor/musephp/musephp/erato/src/Erato/Adapter/SymfonyBundles/FrameworkBundle/Tests/Resources/config/routing.yml',
            'router.cache_class_prefix' => 'ResourcesTest',
            'request_listener.http_port' => 80,
            'request_listener.https_port' => 443,
            'annotations.reader.class' => 'Doctrine\\Common\\Annotations\\AnnotationReader',
            'annotations.cached_reader.class' => 'Doctrine\\Common\\Annotations\\CachedReader',
            'annotations.file_cache_reader.class' => 'Doctrine\\Common\\Annotations\\FileCacheReader',
            'clio_component.cache.factory.doctrine.class' => 'Clio\\Bridge\\DoctrineCommon\\Cache\\Factory\\DoctrineCacheFactory',
            'clio_component.cache.provider_factory.doctrine.class' => 'Clio\\Bridge\\DoctrineCommon\\Cache\\Factory\\DoctrineCacheProviderFactory',
            'clio_component.normalizer.class' => 'Clio\\Component\\Tool\\Normalizer\\Normalizer',
            'clio_component.normalizer.strategy_collection.class' => 'Clio\\Component\\Tool\\Normalizer\\Strategy\\PriorityCollection',
            'clio_component.normalizer.scalar_strategy.class' => 'Clio\\Component\\Tool\\Normalizer\\Strategy\\ScalarStrategy',
            'clio_component.normalizer.reference_strategy.class' => 'Clio\\Component\\Tool\\Normalizer\\Strategy\\ReferenceStrategy',
            'clio_component.normalizer.datetime_strategy.class' => 'Clio\\Component\\Tool\\Normalizer\\Strategy\\DateTimeStrategy',
            'clio_component.normalizer.array_access_strategy.class' => 'Clio\\Component\\Tool\\Normalizer\\Strategy\\ArrayAccessStrategy',
            'clio_component.normalizer.std_class_strategy.class' => 'Clio\\Component\\Tool\\Normalizer\\Strategy\\StdClassStrategy',
            'clio_component.normalizer.jms_serializer_strategy.class' => 'Clio\\Bridge\\JMSSerializer\\Normalizer\\JMSSerializerStrategy',
            'erato_framework.event_listener.exception_listener.class' => 'Erato\\Adapter\\SymfonyBundles\\FrameworkBundle\\EventListener\\ExceptionListener',
            'erato_framework.service_registry.class' => 'Clio\\Bridge\\SymfonyDI\\Registry\\ServiceContainerRegistry',
            'erato_framework.factory_map.class' => 'Clio\\Component\\Pattern\\Factory\\NamedCollection',
            'erato_framework.component_factory.class' => 'Clio\\Component\\Pattern\\Factory\\ComponentFactory',
            'erato_framework.doctrine_cache_factory.class' => 'Erato\\Adapter\\SymfonyBundles\\FrameworkBundle\\Cache\\DoctrineCacheFactory',
            'erato_framework.schema.registry.class' => 'Clio\\Extra\\Metadata\\SchemaRegistry',
            'erato_framework.schema.registry.cache_loader.class' => 'Clio\\Extra\\Registry\\Loader\\CachedLoader',
            'erato_framework.schema.registry.factory_loader.class' => 'Clio\\Component\\Pattern\\Registry\\Loader\\MappedFactoryLoader',
            'erato_framework.schema.class_metadata_factory.class' => 'Clio\\Component\\Util\\Metadata\\Schema\\Factory\\ClassMetadataFactory',
            'erato_framework.schema.mapped_factory_loader.class' => 'Clio\\Component\\Pattern\\Registry\\Loader\\MappedFactoryLoader',
            'erato_framework.schema.mapping_factory_collection.class' => 'Clio\\Component\\Util\\Metadata\\Mapping\\Factory\\Collection',
            'erato_framework.schema.accessor_mapping_factory.class' => 'Erato\\Core\\Metadata\\Mapping\\Factory\\AccessorMappingFactory',
            'erato_framework.schema.attribute_map_mapping_factory.class' => 'Erato\\Core\\Metadata\\Mapping\\Factory\\AttributeMapMappingFactory',
            'erato_framework.schema.tag_set_mapping_factory.class' => 'Erato\\Core\\Metadata\\Mapping\\Factory\\TagSetMappingFactory',
            'erato_framework.schema.rebuilder.class' => 'Clio\\Component\\Util\\Metadata\\Tool\\MetadataRebuilder',
            'erato_framework.schema.cache_clearer.class' => 'Erato\\Adapter\\SymfonyBundles\\FrameworkBundle\\Cache\\CacheClearer',
            'erato_framework.accessor.registry.class' => 'Erato\\Core\\Accessor\\SchemaAccessorRegistry',
            'erato_framework.accessor.schema_accessor_factory_collection.class' => 'Clio\\Component\\Util\\Accessor\\Schema\\Factory\\SchemaAccessorFactoryCollection',
            'erato_framework.accessor.class_accessor_factory.class' => 'Clio\\Component\\Util\\Accessor\\Schema\\Factory\\BasicClassAccessorFactory',
            'erato_framework.accessor.schema_metadata_accessor_factory.class' => 'Erato\\Core\\Accessor\\Schema\\Factory\\SchemaMetadataAccessorFactory',
            'erato_framework.accessor.field_accessor_factory_collection.class' => 'Clio\\Component\\Util\\Accessor\\Field\\Factory\\FieldAccessorFactoryCollection',
            'erato_framework.accessor.attribute_map_field_accessor_factory.class' => 'Erato\\Core\\Accessor\\Field\\Factory\\AttributeMapAccessorFactory',
            'erato_framework.accessor.ignore_field_accessor_factory.class' => 'Clio\\Component\\Util\\Accessor\\Field\\Factory\\IgnoreFieldAccessorFactory',
            'erato_framework.accessor.public_property_field_accessor_factory.class' => 'Clio\\Component\\Util\\Accessor\\Field\\Factory\\PublicPropertyFieldAccessorFactory',
            'erato_framework.accessor.method_field_accessor_factory.class' => 'Clio\\Component\\Util\\Accessor\\Field\\Factory\\MethodFieldAccessorFactory',
            'erato_framework.accessor.tag_set_field_accessor_factory.class' => 'Erato\\Core\\Accessor\\Field\\Factory\\TagSetFieldAccessorFactory',
            'erato_framework.accessor.schema_accessor.interface' => 'Clio\\Component\\Util\\Accessor\\Schema\\SimpleSchemaAccessor',
            'erato_framework.accessor.attribute_map_accessor.class' => 'Erato\\Core\\Accessor\\AttributeMapAccessor',
            'erato_framework.accessor.field_accessor_collection.class' => 'Clio\\Component\\Util\\Accessor\\Field\\FieldAccessorCollection',
            'erato_framework.accessor.ignore_field_accessor.class' => 'Clio\\Component\\Util\\Accessor\\Field\\Ignore',
            'erato_framework.accessor.public_property_field_accessor.class' => 'Clio\\Component\\Util\\Accessor\\Field\\PublicPropertyFieldAccessor',
            'erato_framework.accessor.method_field_accessor.class' => 'Clio\\Component\\Util\\Accessor\\Field\\MethodFieldAccessor',
            'erato_framework.accessor.tag_set_field_accessor.class' => 'Erato\\Core\\Accessor\\Field\\TagSetFieldAccessor',
            'erato_framework.normalizer.class' => 'Clio\\Component\\Tool\\Normalizer\\Normalizer',
            'erato_framework.normalizer.strategy_collection.class' => 'Clio\\Component\\Tool\\Normalizer\\Strategy\\PriorityCollection',
            'erato_framework.normalizer.accessor_strategy.class' => 'Erato\\Core\\Normalizer\\Strategy\\AccessorStrategy',
            'console.command.ids' => array(

            ),
        );
    }
}
