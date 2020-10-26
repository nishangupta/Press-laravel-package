<?php

namespace nishangupta\Press\Tests;

use nishangupta\Press\PressFileParser;
use Orchestra\Testbench\TestCase;

class PressFileParserTest extends TestCase
{
  /** @test */
  public function the_head_and_body_gets_split()
  {
    $pressFileParser = new PressFileParser(__DIR__ . '/../blogs/MarkFile1.md');

    $data = $pressFileParser->getData();

    $this->assertStringContainsString('title: My Title', $data[1]);
    $this->assertStringContainsString('description: Description here', $data[1]);
    $this->assertStringContainsString('Blog post body here', $data[2]);
  }
}
