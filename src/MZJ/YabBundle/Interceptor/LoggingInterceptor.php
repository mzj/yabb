<?php

namespace MZJ\YabBundle\Interceptor;

use CG\Proxy\MethodInterceptorInterface;
use CG\Proxy\MethodInvocation;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

class LoggingInterceptor implements MethodInterceptorInterface
{
    private $context;
    private $logger;

    public function __construct(SecurityContextInterface $context,
                                LoggerInterface $logger)
    {
        $this->context = $context;
        $this->logger = $logger;
    }

    public function intercept(MethodInvocation $invocation)
    {
       // $user = $this->context->getToken()->getUsername();
        $this->logger->info(sprintf('"%s" method action invoked', $invocation->reflection->name));
        //$this->logger->crit(sprintf('"%s" method action invoked', $invocation->reflection->name));
        // make sure to proceed with the invocation otherwise the original
        // method will never be called
        return $invocation->proceed();
    }
}