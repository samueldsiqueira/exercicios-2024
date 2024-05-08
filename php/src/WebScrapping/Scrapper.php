<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper
{

  /**
   * Loads paper information from the HTML and returns the array with the data.
   */
  public function scrap(\DOMDocument $dom): array
  {
    $papers = []; // Inicialize o array $papers
    $elTags = $dom->getElementsByTagName("a");
    foreach ($elTags as $els) {
      if (strpos($els->getAttribute('class'), 'paper-card') === 0) {

        $id = $this->findPaperId($els);
        $title = $this->findPaperTitle($els);
        $type = $this->findPaperType($els);
        $authors = $this->findPaperAuthors($els);

        $papers[] = new Paper($id, $title, $type, $authors);
      }
    }
    return $papers;
  }

  private function findPaperId(\DOMElement $domElement): string
  {
    $id = '';
    $elDivId = $domElement->getElementsByTagName('div');

    foreach ($elDivId as $elId) {
      $id = $elId->getAttribute('id');
      if (strpos($elId->getAttribute('class'), 'volume-info') === 0) {
        $id = $elId->textContent;
        break;
      }
    }
    return $id;
  }

  private function findPaperAuthors(\DOMElement $domElement): array
  {
    $authors = []; // Inicialize o array $authors
    $authorSpanEl = $domElement->getElementsByTagName('span');

    foreach ($authorSpanEl as $elAuthor) {
      $getNameAuthor = $elAuthor->textContent;
      $getInstitution = $elAuthor->getAttribute('title');
      $authors[] = new Person($getNameAuthor, $getInstitution);
    }
    return $authors;
  }

  private function findPaperType(\DOMElement $domElement): string
  {
    $type = '';
    $elDivType = $domElement->getElementsByTagName('div');
    foreach ($elDivType as $elDiv) {
      if (strpos($elDiv->getAttribute('class'), 'tags mr-sm') === 0) {
        $type = $elDiv->textContent;
        break;
      }
    }
    return $type;
  }

  private function findPaperTitle(\DOMElement $domElement): string
  {
    $title = '';
    $titleEl = $domElement->getElementsByTagName('h4');
    foreach ($titleEl as $elTitle) {
      if (strpos($elTitle->getAttribute('class'), 'my-xs paper-title') === 0) {
        $title = $elTitle->textContent;
        break;
      }
    }
    return $title;
  }
}
