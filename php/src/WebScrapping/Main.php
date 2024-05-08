<?php

namespace Chuva\Php\WebScrapping;

use DOMDocument;

/**
 * Does the scrapping of a webpage.
 */
class Main
{
    public static function run()
    {
        $scraper = new Scrapper();
        try {
            // Tente carregar o arquivo HTML
            $html = file_get_contents(__DIR__ . '/../../assets/origin.html');
            if ($html === false) {
                throw new \Exception("Failed to load HTML file.");
            }

            // Crie um novo objeto DOMDocument
            $dom = new DOMDocument();

            // Carregue o HTML no DOMDocument, suprimindo os erros
            // para evitar que eles sejam exibidos
            @$dom->loadHTML($html);

            // Inicie a raspagem
            $papers = $scraper->scrap($dom);

            // Processamento adicional, se necessário

            // Saída dos resultados
            print_r($papers);
        } catch (\Exception $e) {
            // Lidar com a exceção
            echo "Error: " . $e->getMessage();
        }
    }
}
