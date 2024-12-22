<?php
declare(strict_types=1);
namespace data;
use data\DataloaderInterface;

class Dataloaderjson implements DataInterface {
    public string $url;
    public function __construct(string $url) {
        $this->url = $url;
    }
    public function loader(): void {
        $source = file_get_contents($this->url);
        $questions = json_decode($source, true);

    }
}
?>