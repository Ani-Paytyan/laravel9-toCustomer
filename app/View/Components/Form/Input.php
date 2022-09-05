<?php

namespace App\View\Components\Form;

class Input extends AbstractFormControl
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public ?string $label = null,
        public bool $dontMarkLabelRequired = false,
        public ?string $name = null,
    )
    {
    }

    protected function getName(): ?string
    {
        return $this->name;
    }

    protected function getViewPath(): string
    {
        return 'components.form.input';
    }
}
