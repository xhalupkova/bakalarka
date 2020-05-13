<?php

return ['after'  => ':attribute musí byť väčší ako :date.',
        'before' => ':attribute musí byť menší ako :date.',
        'confirmed' => ':attribute sa nezhoduje s potvrdzovacím.',
        'date' => ':attribute nie je dátum.',
        'email' => ':attribute musí byť správna e-mail adresa',
        'max' => [  'numeric' => ':attribute nemôže byť väčšie od :max.',
                    'file' => ':attribute nemôže obsahovať viac ako :max kB.',
                    'string' => ':attribute nemôže obsahovať viac ako :max znakov.',
                    'array' => ':attribute nemôže obsahovať viac ako :max položiek.',
                    ],
        'min' => [  'numeric' => ':attribute musí byť aspoň :min.',
                    'file' => ':attribute musí obsahovať aspoň :min kB.',
                    'string' => ':attribute musí obsahovať aspoň :min znakov.',
                    'array' => ':attribute musí obsahovať aspoň :min položiek.',
                    ],
        'required' => 'Pole :attribute je povinné.',
        'string' => ':attribute musí byť string',
        'unique' => ':attribute je už obsadené.',



        'attributes' => [
            'dateFrom' => 'dátum od',
            'dateTo' => 'dátum do',
            'description' => 'popis',
            'name' => 'meno',
            'password' => 'heslo',

        ],
];
