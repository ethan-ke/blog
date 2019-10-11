<?php

namespace App\Markdown;

/**
 * Class Markdown
 */
class Markdown
{

  public function __construct(Parser $parser)
  {
    $this->parser = $parser;
  }

  public function markdown($text)
  {
    $html = $this->parser->makeHtml($text);
    return $html;
  }
}
