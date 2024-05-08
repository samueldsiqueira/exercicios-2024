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
  /**
   * Summary of __construct
   * @param int $id number in web card
   * @param string $title publication title
   * @param string $type  type of publications
   * @param array $authors name of authors
   */
  public function __construct($id, $title, $type, array $authors)
  {
    $this->id = $id;
    $this->title = $title;
    $this->type = $type;
    $this->authors = $authors;

  }

}
