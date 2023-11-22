<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class StringToDateTimeTransformer implements DataTransformerInterface
{public function transform($datetime)
    {
        if (null === $datetime) {
            return null;
        }
    
        if (!$datetime instanceof \DateTimeInterface) {
            throw new TransformationFailedException('Expected a \DateTimeInterface.');
        }
    
        return $datetime->format('Y-m-d H:i:s');
    }
    

    public function reverseTransform($datetimeString)
    {
        if (!$datetimeString) {
            return null;
        }

        $datetime = \DateTime::createFromFormat('Y-m-d H:i:s', $datetimeString);

        if (!$datetime) {
            throw new TransformationFailedException('Invalid datetime string.');
        }

        return $datetime;
    }
}
