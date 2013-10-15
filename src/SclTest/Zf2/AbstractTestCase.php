<?php

namespace SclTest\Zf2;

/**
 * Extention of the PHPUnit test case class with some extra assertions
 * which are useful when testing things within a Zend Framework 2 Application.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
abstract class AbstractTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Returns an instance of the application service manager.
     *
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    protected function getServiceManager()
    {
        // @todo Find a better way to locate the bootstrap
        return \TestBootstrap::getApplication()->getServiceManager();
    }

    /**
     * Assert that the service return is an instance of $type.
     *
     * @param  string $type        FQCN of expected class type.
     * @param  string $serviceName The name of the service being checked.
     * @param  string $message
     *
     * @return void
     */
    protected function assertServiceIsInstanceOf($type, $serviceName, $message = '')
    {
        $this->assertInstanceOf(
            $serviceName,
            $this->getServiceManager()->get($serviceName)
        );
    }

    /**
     * Checks that the service of the given name is a shared service.
     *
     * @param  string $serviceName
     *
     * @return void
     */
    protected function assertServiceIsShared($serviceName, $message = '')
    {
        $serviceLocator = $this->getServiceManager();

        if ('' === $message) {
            $message = "Failed asserting that service '$serviceName' is a shared service.";
        }

        $this->assertSame(
            $serviceLocator->get($serviceName),
            $serviceLocator->get($serviceName),
            $message
        );
    }

    /**
     * Checks that the service of the given name is not a shared service.
     *
     * @param  string $serviceName
     *
     * @return void
     */
    protected function assertServiceIsNotShared($serviceName, $message = '')
    {
        $serviceLocator = $this->getServiceManager();

        if ('' === $message) {
            $message = "Failed asserting that service '$serviceName' is not a shared service.";
        }

        $this->assertNotSame(
            $serviceLocator->get($serviceName),
            $serviceLocator->get($serviceName),
            $message
        );
    }
}
