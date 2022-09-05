<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Textarea extends AbstractFormControl
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public ?string $name = null,
        public ?string $label = null,
    )
    {
        //
    }

    protected function getViewPath(): string
    {
        return 'components.form.textarea';
    }

    protected function getName(): ?string
    {
        return $this->name;
    }
}
