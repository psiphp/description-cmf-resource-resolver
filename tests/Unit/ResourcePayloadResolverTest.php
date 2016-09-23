<?php

namespace Psi\Component\Description\SubjectResolver\SymfonyCmfResource\Tests\Unit;

use Symfony\Cmf\Component\Resource\Repository\Resource\CmfResource;
use Psi\Component\Description\Subject;
use Psi\Component\Description\SubjectResolver\SymfonyCmfResource\ResourcePayloadResolver;

class ResourcePayloadResolverTest extends \PHPUnit_Framework_TestCase
{
    private $resolver;

    public function setUp()
    {
        $this->resolver = new ResourcePayloadResolver();
        $this->resource = $this->prophesize(CmfResource::class);
    }

    /**
     * It should return the orginal subject if the subject has no object.
     */
    public function testReturnOriginalNoObject()
    {
        $subject = Subject::createFromClass(\stdClass::class);
        $resolvedSubject = $this->resolver->resolve($subject);

        $this->assertSame($subject, $resolvedSubject);
    }

    /**
     * It should return the original subject if the subject does not implement CmfResource.
     */
    public function testReturnOriginalNotCmfResource()
    {
        $subject = Subject::createFromObject(new \stdClass());
        $resolvedSubject = $this->resolver->resolve($subject);

        $this->assertSame($subject, $resolvedSubject);
    }

    /**
     * It should return the resource payload if the subject is a CmfResource object.
     */
    public function testReturnPayload()
    {
        $payload = new \stdClass();
        $subject = Subject::createFromObject($this->resource->reveal());
        $this->resource->getPayload()->willReturn($payload);

        $resolvedSubject = $this->resolver->resolve($subject);

        $this->assertNotSame($subject, $resolvedSubject);
        $this->assertSame($resolvedSubject->getObject(), $payload);
    }
}
