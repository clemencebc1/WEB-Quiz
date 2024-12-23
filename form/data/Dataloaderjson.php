<?php
declare(strict_types=1);
namespace data;
use data\DataloaderInterface;

class Dataloaderjson implements DataloaderInterface {
    public string $url;
    public function __construct(string $url) {
        $this->url = $url;
    }
    public function loader(): array {
        $source = file_get_contents($this->url);
        $questions = json_decode($source, true);
        return $questions;

    }
}
?>