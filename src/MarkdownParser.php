<?php

namespace nishangupta\Press;

use Parsedown;

class MarkdownParser
{
  public static function parse($string)
  {
    return Parsedown::instance()->text($string);
  }
}
