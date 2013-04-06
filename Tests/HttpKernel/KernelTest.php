<?php

namespace AdrienBrault\SilexBundle\Tests\HttpKernel;

class KernelTest extends \PHPUnit_Framework_TestCase
{
    public function testServiceArrayAccess()
    {
        $serviceId = 'templating';
        $service = new \stdClass();

        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
        $container
            ->expects($this->once())
            ->method('get')
            ->with($serviceId)
            ->will($this->returnValue($service));
        $container
            ->expects($this->once())
            ->method('has')
            ->with($serviceId)
            ->will($this->returnValue(true));

        $kernel = $this->getMockForAbstractClass('AdrienBrault\SilexBundle\HttpKernel\Kernel', array(), '', false, true, true, array('getContainer'));
        $kernel
            ->expects($this->any())
            ->method('getContainer')
            ->will($this->returnValue($container));

        $this->assertEquals($service, $kernel[$serviceId]);
        $this->assertTrue(isset($kernel[$serviceId]));
    }
}
