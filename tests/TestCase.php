<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class TestCase extends BaseTestCase
{
    use CreatesApplication, MockeryPHPUnitIntegration;
}
