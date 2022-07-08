<?php

declare (strict_types = 1);

namespace App\Rules;

use App\Model\Rules;

class PageRules extends Rules
{
    public function rules()
    {
        $this->createRule('name', ['between' => ['min' => 3, "max" => 64]]);
        $this->createRule('image', ['require' => true, 'max' => 256]);
        $this->createRule('link', ['require' => true, 'max' => 256]);
    }

    public function messages()
    {
        $this->createMessages('name', [
            'between' => "Nazwa strony powinna zawierać od " . $this->between('name.min') . " do " . $this->between('name.max') . " znaków",
        ]);

        $this->createMessages('image', [
            'require' => "Pole adres obrazka jest wymagane",
            'max' => "Adres obrazka nie może zawierać więcej niż " . $this->value('image.max') . " znaków",
        ]);

        $this->createMessages('link', [
            'require' => "Pole link jest wymagane",
            'max' => "Link nie może zawierać więcej niż " . $this->value('image.max') . " znaków",
        ]);
    }
}
