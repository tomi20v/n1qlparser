<?php

namespace tomi20v\n1qlparser\Annotation;

class AnnotationManager
{

    /** @var PropertyAnnotationsFactory */
    private $propertyAnnotationsFactory;

    public function __construct(
        PropertyAnnotationsFactory $propertyAnnotationsFactory
    ) {
        $this->propertyAnnotationsFactory = $propertyAnnotationsFactory;
    }

    public function annotationByClass(string $className, string $propertyName): PropertyAnnotation
    {
        $reflectionProperty = new \ReflectionProperty($className, $propertyName);
        $phpDoc = $reflectionProperty->getDocComment();
        $annotations = $this->propertyAnnotationsFactory->fromPhpDoc($phpDoc);
        return $annotations;
    }

    public function allAnnotationByClass(string $className)
    {
        $annotations = get_class_vars($className);
        foreach ($annotations as $eachPropertyName => $eachValue) {
            $annotations[$eachPropertyName] = $this->annotationByClass($className, $eachPropertyName);
        }
        return $annotations;
    }

}
