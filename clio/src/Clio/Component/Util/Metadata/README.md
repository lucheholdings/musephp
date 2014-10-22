Metadata
========

Metadata is known as "Schema", or "Architect" Definition.

If an array is defined with specified "keys" and for each value related with the key is defined, 
you can define "Metadata" for the array.

In php ReflectionClass is a native Metadata for class, but with Metadata, you can specify 
 - the type of each fields
 - the identifier(s)


Architect
----------

I thought Metadata itself should be simple, but can extend any usage data.
To do this, "Mapping" is the another concept with Metadata.

Any extended information should be in Mapping, and Metadata just point that. 


Ex)
  if class can "identify", the class need "identifier(s)"
  to this possible, use IdentifierMapping as below

    //
	$metatada = new Metadata('name-of-metadata');
	$metadata
		->addMapping(new FieldTypeMapping())
		->addMapping(new IdentifierFieldMapping())
	;

	$metadata->getMapping('identifier')->addField('foo')

  Now, with metadata, you can get identifier

    $metadata->getMapping('identifier')->getIdentifiers();
	
Commonly, each component requires different mapping like "accessor".


Usage
------------
