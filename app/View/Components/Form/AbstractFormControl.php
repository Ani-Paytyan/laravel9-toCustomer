<?php

namespace App\View\Components\Form;

use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;

abstract class AbstractFormControl extends Component
{
    protected abstract function getName(): ?string;

    protected abstract function getViewPath(): string;

    protected function getErrors(): ?array
    {
        $errors = null;

        /** @var null|ViewErrorBag $errorsBag */
        $errorsBag = \Session::get('errors');

        if ($this->getName() && $errorsBag) {
            $errorName = str_replace(['[', ']'], ['.', ''], $this->getName());
            $errors = $errorsBag->get($errorName);
        }

        return $errors;
    }

    public function render()
    {
        return view($this->getViewPath(), [
            'controlErrors' => $this->getErrors(),
        ]);
    }

    public function withAttributes(array $attributes)
    {
        if (!isset($attributes['name'])) {
            $attributes['name'] = $this->getName();
        }

        return parent::withAttributes($attributes);
    }
}
