<?php
namespace Clio\Component\Pce\Metadata;

/**
 * ClassMetadata
 * 
 * @uses Metadata
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ClassMetadata extends Metadata
{
	function getReflectionClass();

	// Proxy Functions of ReflectionClass
    function getConstant($name);

    function getConstants();

    function getConstructor();

    function getDefaultProperties();

    function getDocComment();

    function getEndLine();

    function getExtension();

    function getExtensionName();

    function getFileName();

    function getInterfaceNames();

    function getInterfaces();

    function getMethod($name);

    function getMethods($filter = null);

    function getModifiers();

    function getName();

    function getNamespaceName();

    function getParentClass();

    function getProperties($filter = null);

    function getProperty($name);

    function getShortName();

    function getStartLine();

    function getStaticProperties();

    function getStaticPropertyValue($name , &$def_value = null);

    function getTraitAliases();

    function getTraitNames();

    function getTraits();

    function hasConstant($name);

    function hasMethod($name);

    function hasProperty($name);

    function implementsInterface($interface);

    function inNamespace();

    function isAbstract();

    function isCloneable();

    function isFinal();

    function isInstance($object);

    function isInstantiable();

    function isInterface();

    function isInternal();

    function isIterateable();

    function isSubclassOf($class);

    function isTrait();

    function isUserDefined();

    function newInstance();

    function newInstanceArgs(array $args = array());

    function newInstanceWithoutConstructor();

    function setStaticPropertyValue($name, $value);
}

