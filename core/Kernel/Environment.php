<?php

namespace Core\Kernel;

enum Environment
{
 case Test;
 case Console;
 case HTTP;
}
