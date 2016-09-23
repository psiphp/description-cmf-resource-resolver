Psi Description Subject Resolver for Symfony CMF Resources
==========================================================

Subject resolver for Symfony CMF Resources.

This library will allow Symfony CMF resources to be described by their
payloads.

Usage:

.. code-block:: php

    <?php

    use Psi\Component\Description\DescriptionFactory;
    use Psi\Component\Description\Enhancer\Doctrine\PhpcrOdmEnhancer;

    $resourceResolver = new ResourcePayloadResolver();

    $factory = new DescriptionFactory([
        // ...
    ], null, [
        $resourceResolver
    ]);

    $cmfResource = // .. get CmfResource

    $factory->describe($cmfResource);

The aboce code will return the description for the resources *payload* rather
than the description for the resource itself.


