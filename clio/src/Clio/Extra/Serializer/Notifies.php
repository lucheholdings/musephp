<?php
namespace Clio\Extra\Serializer;

/**
 * Notifies 
 * 
 * @final
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
final class Notifies 
{
	// Notifies
	const SerializationBegin   = 'serializer.serialization_begin';
	const SerializationEnd     = 'serializer.serialization_end';

	const DeserializationBegin   = 'serializer.deserialization_begin';
	const DeserializationEnd     = 'serializer.deserialization_end';

	// const
	const OPTION_SERIALIZER    = 'serializer';
}

