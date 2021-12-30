<?php

declare (strict_types = 1);

namespace App\Rules;

use App\Model\Rules;

class CategoryRules extends Rules
{
    public function rules()
    {
        $this->createRules('name', ['min' => 3, "max" => 32]);
        $this->createRules('image', ['require' => true, 'max' => 256]);
    }

    public function messages()
    {
        $this->createMessages('name', [
            'between' => "Nazwa kategorii powinna zawierać od " . $this->value('name.min') . " do " . $this->value('name.max') . " znaków",
        ]);

        $this->createMessages('image', [
            'require' => "Pole adres obrazka jest wymagane",
            'max' => "Adres obrazka nie może zawierać więcej niż " . $this->value('image.max') . " znaków",
        ]);
    }
}
