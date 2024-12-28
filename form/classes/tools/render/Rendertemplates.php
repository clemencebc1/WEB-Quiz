<?php
declare(strict_types=1);
namespace classes\tools\render;
session_start();

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
    public function render_questions() {
        echo "<form method='POST' action='classes/tools/render/validation.php'>";
        foreach($this->content as $question){
            echo "<h2>" . $question['question'] . "</h2>";
            $className = 'classes\\tools\\type\\' . ucfirst($question['type']);
            $objet = new $className($question['name'], $question['required']);
            echo $objet->render() . PHP_EOL;
        }
        echo new Hidden(implode($this->content)).PHP_EOL;
        echo "<input type='Submit'>";
        echo "</form>";
    }

    public function render_answers(array $result) {
        $cpt = 0;
        foreach($this->content as $question){
            foreach($result as $answer){
                if ($question['réponse']==$answer){
                    $cpt ++;
                }
            }
        }
        return $cpt;
    }
}
?>