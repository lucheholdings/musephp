<?php

require_once __DIR__ . '/../vendor/autoload.php';

\Doctrine\Common\Annotations\AnnotationRegistry::registerAutoloadNamespace(
	'Erato\Bridge\DoctrineCommon\Annotation', __DIR__ . '/../erato/src/'
);
