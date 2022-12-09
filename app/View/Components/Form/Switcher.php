<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Switcher extends AbstractFormControl
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public ?string $label = null,
        public ?string $id = null,
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
        return 'components.form.switcher';
    }
}
