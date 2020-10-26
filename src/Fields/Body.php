<?php

namespace nishangupta\Press\Fields;

use nishangupta\Press\MarkdownParser;

class Body
{
  public static function process($type, $value)
  {
    return [
      $type => MarkdownParser::parse($value),
    ];
  }
}
