<?php
declare(strict_types=1);
namespace classes\tools\render;

use classes\tools\type\Checkbox;
use classes\tools\type\Hidden;
use classes\tools\type\Text;
use classes\tools\type\Textarea;
use data\Dataloaderjson;

class Rendertemplates {
    private array $content;
    public function __construct(array $content){
        $this->content = $content;
    }
    public function render() {
        echo "<form method='POST' action='validation.php'>";
        foreach($this->content as $question){
            echo "<h2>" . $question['question'] . "</h2>";
            $className = 'classes\\tools\\type\\' . ucfirst($question['type']);
            $objet = new $className($question['name'], $question['required']);
            echo $objet->render() . PHP_EOL;
        echo "<input type='Submit'>";
        echo "</form>";
        }
    }
}
?>