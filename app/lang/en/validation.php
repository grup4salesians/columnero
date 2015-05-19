<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */
    "accepted"         => ":attribute ha de ser acceptat.",
    "active_url"       => ":attribute no és una URL vàlida.",
    "after"            => ":attribute ha de ser una data posterior a :date.",
    "alpha"            => ":attribute només pot contenir lletres.",
    "alpha_dash"       => ":attribute només pot contenir lletres, nombres i guions.",
    "alpha_num"        => ":attribute només pot contenir lletres i nombres.",
    "array"            => ":attribute ha de ser un conjunt.",
    "before"           => ":attribute ha de ser una data anterior a :date.",
    "between"          => [
        "numeric" => ":attribute ha d'estar entre :min - :max.",
        "file"    => ":attribute ha de pesar entre :min - :max kilobytes.",
        "string"  => ":attribute ha de tenir entre :min - :max caràcters.",
        "array"   => ":attribute ha de tenir entre :min - :max items.",
    ],
    "boolean"          => "El camp :attribute ha de tenir un valor veritable o fals.",
    "confirmed"        => "La confirmació de :attribute no coincideix.",
    "date"             => ":attribute no és una data vàlida.",
    "date_format"      => ":attribute no correspon al format :format.",
    "different"        => ":attribute i :other han de ser diferents.",
    "digits"           => ":attribute ha de tenir :digits dígits.",
    "digits_between"   => ":attribute ha de tenir entre :min i :max dígits.",
    "email"            => ":attribute no és un correu vàlid",
    "exists"           => ":attribute és invàlid.",
    "filled"           => "El camp :attribute és obligatori.",
    "image"            => ":attribute ha de ser una imatge.",
    "in"               => ":attribute es invàlid.",
    "integer"          => ":attribute ha de ser un nombre enter.",
    "ip"               => ":attribute ha de ser una direcció IP vàlida.",
    "max"              => [
        "numeric" => ":attribute no pot ser major que :max.",
        "file"    => ":attribute no pot ser major que :max kilobytes.",
        "string"  => ":attribute no pot ser major de :max caràcters.",
        "array"   => ":attribute no pot tenir més de :max elements.",
    ],
    "mimes"            => ":attribute ha de ser un archiu amb format: :values.",
    "min"              => [
        "numeric" => "La mida de :attribute ha de ser d'almenys :min.",
        "file"    => "La mida de :attribute ha de ser d'almenys :min kilobytes.",
        "string"  => ":attribute ha de contenir un mínim de :min caràcters.",
        "array"   => ":attribute ha de tenir un mínim de :min elements.",
    ],
    "not_in"           => ":attribute es invàlid.",
    "numeric"          => ":attribute ha de ser numèric.",
    "regex"            => "El format de :attribute es invàlid.",
    "required"         => "El camp :attribute és obligatori.",
    "required_if"      => "El camp :attribute és obligatori quan :other és :value.",
    "required_with"    => "El camp :attribute és obligatori quan :values està present.",
    "required_with_all" => "El camp :attribute és obligatori quan :values està present.",
    "required_without" => "El camp :attribute és obligatori quan :values no està present.",
    "required_without_all" => "El camp :attribute és obligatori quan cap de :values està present.",
    "same"             => ":attribute i :other han de coincidir.",
    "size"             => [
        "numeric" => "La mida de :attribute ha de ser :size.",
        "file"    => "La mida de :attribute ha de ser :size kilobytes.",
        "string"  => ":attribute ha de contenir :size caràcters.",
        "array"   => ":attribute ha de contenir :size elements.",
    ],
    "timezone"         => ":attribute ha de ser una zona vàlida.",
    "unique"           => ":attribute ja ha estat registrat.",
    "url"              => "El format :attribute és invàlid.",
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
    'attributes' => [],
];