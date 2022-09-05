<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Select extends AbstractFormControl
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public ?string $name = null,
        public ?string $label = null,
        public array $options = [],
        public bool $withSearch = false,
    )
    {
        //
    }

    protected function getName(): ?string
    {
        return $this->name;
    }

    protected function getViewPath(): string
    {
        return 'components.form.select';
    }
}
