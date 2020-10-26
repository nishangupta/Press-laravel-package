<?php

namespace nishangupta\Press;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PressFileParser
{
  protected $filename;
  protected $data;

  public function __construct($filename)
  {
    $this->filename = $filename;

    $this->splitFile();
    $this->explodeData();
    $this->processFields();
  }

  public function getData()
  {
    return $this->data;
  }

  protected function explodeData()
  {
    $fieldStrings = explode("\r\n", trim($this->data[1]));
    foreach ($fieldStrings as $fieldString) {
      preg_match('/(.*):\s?(.*)/', $fieldString, $fieldArray);
      $this->data[$fieldArray[1]] = trim($fieldArray[2]);
    }
    $this->data['body'] = trim($this->data[2]);
  }

  protected function splitFile()
  {
    preg_match(
      '/^\-{3}(.*?)\-{3}(.*)/s',
      File::exists($this->filename) ? File::get($this->filename) : $this->filename,
      $this->data
    );
  }
  protected function processFields()
  {
    foreach ($this->data as $field => $value) {
      $class = 'nishangupta\\Press\Fields\\' . Str::title($field);

      if (class_exists($class) && method_exists($class, 'process')) {
        $this->data = array_merge($this->data, $class::process($field, $value));
      }
    }
  }
}
