<?php

declare (strict_types = 1);

namespace App\Rules;

use App\Model\Rules;

class PageRules extends Rules
{
    public function rules()
    {
        $this->createRules('name', ['min' => 3, "max" => 64]);
        $this->createRules('image', ['require' => true, 'max' => 256]);
        $this->createRules('link', ['require' => true, 'max' => 256]);
    }

    public function messages()
    {
        $this->createMessages('name', [
            'between' => "Nazwa strony powinna zawierać od " . $this->value('name.min') . " do " . $this->value('name.max') . " znaków",
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
