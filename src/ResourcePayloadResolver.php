<?php

namespace Psi\Component\Description\SubjectResolver\SymfonyCmfResource;

use Psi\Component\Description\SubjectResolverInterface;
use Psi\Component\Description\Subject;
use Symfony\Cmf\Component\Resource\Repository\Resource\CmfResource;

class ResourcePayloadResolver implements SubjectResolverInterface
{
    public function resolve(Subject $subject): Subject
    {
        if (!$subject->hasObject()) {
            return $subject;
        }

        if (false === $subject->getClass()->isSubclassOf(CmfResource::class)) {
            return $subject;
        }

        return Subject::createFromObject($subject->getObject()->getPayload());
    }
}
