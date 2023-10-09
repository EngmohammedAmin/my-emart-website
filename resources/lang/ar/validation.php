<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'يجب قبول السمة:.',
    'accepted_if' => 'يجب قبول السمة: عندما تكون القيمة:other.',
    'active_url' => 'السمة: ليست عنوان URL صالحًا.',
    'after' => 'يجب أن تكون السمة: تاريخًا بعد:date',
    'after_or_equal' => 'يجب أن تكون السمة: تاريخًا بعد أو يساوي:date.',
    'alpha' => 'يجب أن تحتوي السمة: على أحرف فقط.',
    'alpha_dash' => 'يجب أن تحتوي السمة: فقط على أحرف وأرقام وشرطات وشرطات سفلية.',
    'alpha_num' => 'يجب أن تحتوي السمة: على أحرف وأرقام فقط.',
    'array' => 'يجب أن تكون السمة: مصفوفة.',
    'before' => 'يجب أن تكون السمة: تاريخًا قبل:date.',
    'before_or_equal' => 'يجب أن تكون السمة: تاريخًا قبل أو يساوي:date.',
    'between' => [
        'numeric' => 'يجب أن تكون السمة: بين:min و:max.',
        'file' => 'يجب أن تكون السمة: بين:min و:max كيلو بايت.',
        'string' => 'يجب أن تكون السمة: بين أحرف:min و:max.',
        'array' => 'يجب أن تحتوي السمة: على عناصر بين:min و:max.',
    ],
    'boolean' => 'يجب أن يكون حقل السمة: صحيحًا أو خطأ.',
    'confirmed' => 'تأكيد السمة: غير متطابق.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => 'السمة: ليست تاريخًا صالحًا.',
    'date_equals' => 'يجب أن تكون السمة: تاريخًا مساويًا لـ:date.',
    'date_format' => 'السمة: لا تتطابق مع التنسيق:format.',
    'declined' => 'يجب رفض السمة:.',
    'declined_if' => 'يجب رفض السمة: عندما تكون قيمة:other هي:.',
    'different' => 'يجب أن تكون السمة: و:other مختلفة.',
    'digits' => 'يجب أن تكون السمة: أرقام أرقام.',
    'digits_between' => 'يجب أن تكون السمة بين رقمين:min و:max',
    'dimensions' => 'تحتوي السمة : على أبعاد صورة غير صالحة.',
    'distinct' => 'يحتوي الحقل :attribute على قيمة مكررة.',
    'email' => 'يجب أن تكون السمة عنوان بريد إلكتروني صالحًا..',
    'ends_with' => 'يجب أن تنتهي السمة بإحدى القيم التالية:',
    'enum' => 'السمة المحددة غير صالحة.',
    'exists' => 'السمة المحددة غير صالحة.',
    'file' => 'يجب أن تكون السمة ملفًا.',
    'filled' => 'يجب أن يحتوي حقل :attribute على قيمة.',
    'gt' => [
        'numeric' => 'يجب أن تكون السمة: أكبر من القيمة:.',
        'file' => 'يجب أن تكون السمة أكبر من القيمة بالكيلوبايت.',
        'string' => 'يجب أن تكون السمة: أكبر من أحرف القيمة:',
        'array' => 'يجب أن تحتوي السمة: على أكثر من عناصر القيمة:.',
    ],
    'gte' => [
        'numeric' => 'يجب أن تكون السمة: أكبر من أو تساوي: القيمة.',
        'file' => 'يجب أن تكون السمة: أكبر من أو تساوي: القيمة بالكيلوبايت.',
        'string' => 'يجب أن تكون السمة أكبر من أو تساوي أحرف القيمة:.',
        'array' => 'يجب أن تحتوي السمة: على عناصر قيمة أو أكثر.',
    ],
    'image' => 'يجب أن تكون السمة: صورة.',
    'in' => 'السمة المحددة غير صالحة.',
    'in_array' => 'حقل :attribute غير موجود في :other.',
    'integer' => 'يجب أن تكون السمة: عددًا صحيحًا.',
    'ip' => 'يجب أن تكون السمة عنوان IP صالحًا.',
    'ipv4' => 'يجب أن تكون السمة: عنوان IPv4 صالحًا.',
    'ipv6' => 'يجب أن تكون السمة: عنوان IPv6 صالحًا.',
    'mac_address' => 'يجب أن تكون السمة عنوان MAC صالحًا.',
    'json' => 'يجب أن تكون السمة: سلسلة JSON صالحة.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'file' => 'The :attribute must be less than or equal to :value kilobytes.',
        'string' => 'The :attribute must be less than or equal to :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute must not be greater than :max.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'string' => 'The :attribute must not be greater than :max characters.',
        'array' => 'The :attribute must not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'multiple_of' => 'يجب أن تكون السمة: من مضاعفات القيمة:.',
    'not_in' => 'السمة المحددة غير صالحة.',
    'not_regex' => 'تنسيق السمة: غير صالح.',
    'numeric' => 'يجب أن تكون السمة رقمًا.',
    'password' => 'كلمة المرور غير صحيحة.',
    'present' => 'يجب أن يكون حقل السمة موجودًا.',
    'prohibited' => 'حقل :attribute محظور.',
    'prohibited_if' => 'يُحظر حقل السمة عندما تكون القيمة :',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'يمنع حقل :attribute :other من التواجد.',
    'regex' => 'تنسيق السمة: غير صالح.',
    'required' => 'حقل السمة مطلوب.',
    'required_if' => 'حقل :attribute مطلوب عندما يكون :other هو :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'حقل :attribute مطلوب عند وجود :values.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute must be a valid URL.',
    'uuid' => 'The :attribute must be a valid UUID.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];