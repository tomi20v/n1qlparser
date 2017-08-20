<?php

namespace tomi20v\n1qlparser\Annotations;

/**
 * @usage('property'=>true, 'multiple'=>false)
 */
class PatternAnnotation extends Annotation1Value
{

    public function initAnnotation(array $properties)
    {
        parent::initAnnotation(['/^' . $properties[0] . '/']);
    }

}
