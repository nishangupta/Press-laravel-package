<?php

namespace nishangupta\Press\Tests;

use nishangupta\Press\PressBaseServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
  protected function getPackageProviders($app)
  {
    return [
      PressBaseServiceProvider::class,
    ];
  }
}
