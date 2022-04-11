<?php

namespace Core\Container;

use Exception;
use Psr\Container\NotFoundExceptionInterface;

class ContainerNotFoundException extends Exception implements NotFoundExceptionInterface
{
}
