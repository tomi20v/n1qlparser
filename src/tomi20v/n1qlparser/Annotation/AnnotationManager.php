<?php

namespace tomi20v\n1qlparser\Annotation;

class AnnotationManager
{

    public function annotationByClass(string $className, string $propertyName)
    {
        $reflectionProperty = new \ReflectionProperty($className, $propertyName);
        $phpDoc = $reflectionProperty->getDocComment();
        $propertyAnnotationsFactory = new PropertyAnnotationsFactory();
        $annotations = $propertyAnnotationsFactory->fromPhpDoc($phpDoc);
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
