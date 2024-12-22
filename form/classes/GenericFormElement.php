<?php
namespace classes;
use classes\InputRenderInterface;

abstract class GenericFormElement implements InputRenderInterface
{
    protected string $type;

    protected bool $required = false;

    protected mixed $value = '';

    public function __construct(
        protected readonly string $name, // Readonly cause property is immutable
        $required = false, 
        string $defaultValue = ''
    )
    {
        $this->required = $required;
        $this->value = $defaultValue;
    }

    public function __toString(): string
    {
        return $this->render();
    }

    function getId(): string 
    {
        return sprintf('form_%s', $this->name);
    }

    function getName(): string 
    {
        return $this->name;
    }

    function getValue(): array|string 
    {
        return $this->value;
    }

    function isRequired(): bool
    {
        return $this->required;
    }
}

?>
