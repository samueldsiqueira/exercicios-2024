<?php

namespace Chuva\Php\WebScrapping\Entity;

/**
 * The Paper class represents the row of the parsed data.
 */
class Paper
{

  public $id;
  public $title;
  public $type;
  public $authors;


  public function __construct($id, $title, $type, $authors = [])
  {
  }

}
