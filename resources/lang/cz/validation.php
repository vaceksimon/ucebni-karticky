<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted' => ':attribute musí být přijat.',
    'accepted_if' => 'Atribut :attribute musí být přijat, když :other je :value.',
    'active_url' => ':attribute není platnou URL adresou.',
    'after' => ':attribute musí být datum po :date.',
    'after_or_equal' => ':attribute musí být datum :date nebo pozdější.',
    'alpha' => ':attribute může obsahovat pouze písmena.',
    'alpha_dash' => ':attribute může obsahovat pouze písmena, číslice, pomlčky a podtržítka. České znaky (á, é, í, ó, ú, ů, ž, š, č, ř, ď, ť, ň) nejsou podporovány.',
    'alpha_num' => ':attribute může obsahovat pouze písmena a číslice.',
    'array' => ':attribute musí být pole.',
    'before' => ':attribute musí být datum před :date.',
    'before_or_equal' => 'Datum :attribute musí být před nebo rovno :date.',
    'between' => [
        'numeric' => ':attribute musí být hodnota mezi :min a :max.',
        'file' => ':attribute musí být větší než :min a menší než :max Kilobytů.',
        'string' => ':attribute musí být delší než :min a kratší než :max znaků.',
        'array' => ':attribute musí obsahovat nejméně :min a nesmí obsahovat více než :max prvků.',
    ],
    'boolean' => ':attribute musí být true nebo false',
    'confirmed' => ':attribute nesouhlasí.',
    'current_password' => 'Heslo je nesprávné.',
    'date' => ':attribute musí být platné datum.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => ':attribute není platný formát data podle :format.',
    'declined' => ':attribute musí být odmítnut.',
    'declined_if' => ':attribute musí být odmítnut, když :other je :value.',
    'different' => ':attribute a :other se musí lišit.',
    'digits' => ':attribute musí být :digits pozic dlouhé.',
    'digits_between' => ':attribute musí být dlouhé nejméně :min a nejvíce :max pozic.',
    'dimensions' => ':attribute má neplatné rozměry.',
    'distinct' => ':attribute má duplicitní hodnotu.',
    'email' => ':attribute není platný formát.',
    'ends_with' => ':attribute musí končit jedním z následujících: :values.',
    'enum' => 'Vybraný :attribute je neplatný.',
    'exists' => 'Zvolená hodnota pro :attribute není platná.',
    'file' => ':attribute musí být soubor.',
    'filled' => ':attribute musí být vyplněno.',
    'gt' => [
        'numeric' => ':attribute musí být větší než :value.',
        'file' => 'Velikost souboru :attribute musí být větší než :value kB.',
        'string' => 'Počet znaků :attribute musí být větší :value.',
        'array' => 'Pole :attribute musí mít více prvků než :value.',
    ],
    'gte' => [
        'numeric' => ':attribute musí být větší nebo rovno :value.',
        'file' => 'Velikost souboru :attribute musí být větší nebo rovno :value kB.',
        'string' => 'Počet znaků :attribute musí být větší nebo rovno :value.',
        'array' => 'Pole :attribute musí mít :value prvků nebo více.',
    ],
    'image' => ':attribute musí být obrázek.',
    'in' => 'Zvolená hodnota pro :attribute je neplatná.',
    'in_array' => ':attribute není obsažen v :other.',
    'integer' => ':attribute musí být celé číslo.',
    'ip' => ':attribute musí být platnou IP adresou.',
    'ipv4' => ':attribute musí být platná IPv4 adresa.',
    'ipv6' => ':attribute musí být platná IPv6 adresa.',
    'json' => ':attribute musí být platný JSON řetězec.',
    'lt' => [
        'numeric' => ':attribute musí být menší než :value.',
        'file' => 'Velikost souboru :attribute musí být menší než :value kB.',
        'string' => ':attribute musí obsahovat méně než :value znaků.',
        'array' => ':attribute by měl obsahovat méně než :value položek.',
    ],
    'lte' => [
        'numeric' => ':attribute musí být menší nebo rovno než :value.',
        'file' => 'Velikost souboru :attribute musí být menší než :value kB.',
        'string' => ':attribute nesmí být delší než :value znaků.',
        'array' => ':attribute by měl obsahovat maximálně :value položek.',
    ],
    'mac_address' => ':attribute musí být platná adresa MAC.',
    'max' => [
        'numeric' => ':attribute nemůže být větší než :max.',
        'file' => 'Velikost souboru :attribute musí být menší než :value kB.',
        'string' => ':attribute nemůže být delší než :max znaků.',
        'array' => ':attribute nemůže obsahovat více než :max prvků.',
    ],
    'mimes' => ':attribute musí být jeden z následujících datových typů :values.',
    'mimetypes' => ':attribute musí být jeden z následujících datových typů :values.',
    'min' => [
        'numeric' => ':attribute musí být alespoň :min.',
        'file' => ':attribute musí mít alespoň :min kB.',
        'string' => ':attribute musí mít délku alespoň :min znaků.',
        'array' => ':attribute musí obsahovat alespoň :min prvků.',
    ],
    'multiple_of' => ':attribute musí být násobkem hodnoty :value.',
    'not_in' => 'Zvolená hodnota pro :attribute je neplatná.',
    'not_regex' => ':attribute musí být regulární výraz.',
    'numeric' => ':attribute musí být číslo.',
    'password' => 'Heslo je nesprávné.',
    'present' => ':attribute musí být vyplněno.',
    'prohibited' => 'Pole :attribute je zakázáno.',
    'prohibited_if' => 'Pole :attribute je zakázáno, když :other je :value.',
    'prohibited_unless' => 'Pole :attribute je zakázáno, pokud :other není v :values.',
    'prohibits' => 'Pole :attribute zakazuje přítomnost :other.',
    'regex' => ':attribute nemá správný formát.',
    'required' => ':attribute musí být vyplněno.',
    'required_array_keys' => 'Pole :attribute musí obsahovat položky pro: :values.',
    'required_if' => ':attribute musí být vyplněno pokud :other je :value.',
    'required_unless' => ':attribute musí být vyplněno dokud :other je v :values.',
    'required_with' => ':attribute musí být vyplněno pokud :values je vyplněno.',
    'required_with_all' => ':attribute musí být vyplněno pokud :values je zvoleno.',
    'required_without' => ':attribute musí být vyplněno pokud :values není vyplněno.',
    'required_without_all' => ':attribute musí být vyplněno pokud není žádné z :values zvoleno.',
    'same' => ':attribute a :other se musí shodovat.',
    'size' => [
        'numeric' => ':attribute musí být přesně :size.',
        'file' => ':attribute musí mít přesně :size Kilobytů.',
        'string' => ':attribute musí být přesně :size znaků dlouhý.',
        'array' => ':attribute musí obsahovat právě :size prvků.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => ':attribute musí být řetězec znaků.',
    'timezone' => ':attribute musí být platná časová zóna.',
    'unique' => ':attribute musí být unikátní.',
    'uploaded' => 'Nahrávání :attribute se nezdařilo.',
    'url' => 'Formát :attribute je neplatný.',
    'uuid' => ':attribute musí být validní UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'password' => 'Heslo',
    ],
];
