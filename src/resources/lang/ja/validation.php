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

    'accepted' => ':attribute は受け入れる必要があります。',
    'accepted_if' => ':attribute は :other が :value の場合に受け入れられる必要があります。',
    'active_url' => ':attribute は有効なURLではありません。',
    'after' => ':attribute は :date より後の日付でなければなりません。',
    'after_or_equal' => ':attribute は :date と同じかそれより後の日付でなければなりません。',
    'alpha' => ':attribute は文字のみを含む必要があります。',
    'alpha_dash' => ':attribute は文字、数字、ダッシュ、アンダースコアのみを含む必要があります。',
    'alpha_num' => ':attribute は文字と数字のみを含む必要があります。',
    'array' => ':attribute は配列でなければなりません。',
    'before' => ':attribute は :date より前の日付でなければなりません。',
    'before_or_equal' => ':attribute は :date と同じかそれより前の日付でなければなりません。',
    'between' => [
        'numeric' => ':attribute は :min と :max の間の値でなければなりません。',
        'file' => ':attribute は :min と :max キロバイトの間でなければなりません。',
        'string' => ':attribute は :min と :max 文字の間でなければなりません。',
        'array' => ':attribute は :min と :max の間のアイテムを含む必要があります。',
    ],
    'boolean' => ':attribute フィールドは true または false でなければなりません。',
    'confirmed' => ':attribute の確認が一致しません。',
    'current_password' => 'パスワードが正しくありません。',
    'date' => ':attribute は有効な日付ではありません。',
    'date_equals' => ':attribute は :date と同じ日付でなければなりません。',
    'date_format' => ':attribute は :format という形式と一致しません。',
    'declined' => ':attribute は拒否されるべきです。',
    'declined_if' => ':attribute は :other が :value の場合に拒否されるべきです。',
    'different' => ':attribute と :other は異なる必要があります。',
    'digits' => ':attribute は :digits 桁でなければなりません。',
    'digits_between' => ':attribute は :min と :max の間の桁数でなければなりません。',
    'dimensions' => ':attribute の画像サイズが無効です。',
    'distinct' => ':attribute フィールドには重複する値が含まれています。',
    'email' => ':attribute は有効なメールアドレスでなければなりません。',
    'ends_with' => ':attribute は以下のいずれかで終わる必要があります: :values。',
    'enum' => '選択した :attribute は無効です。',
    'exists' => '選択した :attribute は無効です。',
    'file' => ':attribute はファイルでなければなりません。',
    'filled' => ':attribute フィールドには値が含まれている必要があります。',
    'gt' => [
        'numeric' => ':attribute は :value より大きい必要があります。',
        'file' => ':attribute は :value キロバイトより大きい必要があります。',
        'string' => ':attribute は :value 文字より大きい必要があります。',
        'array' => ':attribute は :value より多くのアイテムを含む必要があります。',
    ],
    'gte' => [
        'numeric' => ':attribute は :value 以上でなければなりません。',
        'file' => ':attribute は :value キロバイト以上でなければなりません。',
        'string' => ':attribute は :value 文字以上でなければなりません。',
        'array' => ':attribute は :value アイテム以上を含む必要があります。',
    ],
    'image' => ':attribute は画像でなければなりません。',
    'in' => '選択した :attribute は無効です。',
    'in_array' => ':attribute フィールドは :other に存在しません。',
    'integer' => ':attribute は整数でなければなりません。',
    'ip' => ':attribute は有効なIPアドレスでなければなりません。',
    'ipv4' => ':attribute は有効なIPv4アドレスでなければなりません。',
    'ipv6' => ':attribute は有効なIPv6アドレスでなければなりません。',
    'json' => ':attribute は有効なJSON文字列でなければなりません。',
    'lt' => [
        'numeric' => ':attribute は :value より小さい必要があります。',
        'file' => ':attribute は :value キロバイトより小さい必要があります。',
        'string' => ':attribute は :value 文字より小さい必要があります。',
        'array' => ':attribute は :value より少ないアイテムを含む必要があります。',
    ],
    'lte' => [
        'numeric' => ':attribute は :value 以下でなければなりません。',
        'file' => ':attribute は :value キロバイト以下でなければなりません。',
        'string' => ':attribute は :value 文字以下でなければなりません。',
        'array' => ':attribute は :value アイテム以上を含んではいけません。',
    ],
    'mac_address' => ':attribute は有効なMACアドレスでなければなりません。',
    'max' => [
        'numeric' => ':attribute は :max 以下でなければなりません。',
        'file' => ':attribute は :max キロバイト以下でなければなりません。',
        'string' => ':attribute は :max 文字以下でなければなりません。',
        'array' => ':attribute は :max アイテム以下でなければなりません。',
    ],
    'mimes' => ':attribute は :values タイプのファイルでなければなりません。',
    'mimetypes' => ':attribute は :values タイプのファイルでなければなりません。',
    'min' => [
        'numeric' => ':attribute は少なくとも :min でなければなりません。',
        'file' => ':attribute は少なくとも :min キロバイトでなければなりません。',
        'string' => ':attribute は少なくとも :min 文字でなければなりません。',
        'array' => ':attribute は少なくとも :min アイテムを含む必要があります。',
    ],
    'multiple_of' => ':attribute は :value の倍数でなければなりません。',
    'not_in' => '選択した :attribute は無効です。',
    'not_regex' => ':attribute の形式が無効です。',
    'numeric' => ':attribute は数字でなければなりません。',
    'password' => 'パスワードが正しくありません。',
    'present' => ':attribute フィールドは存在する必要があります。',
    'prohibited' => ':attribute フィールドは禁止されています。',
    'prohibited_if' => ':attribute フィールドは :other が :value の場合に禁止されています。',
    'prohibited_unless' => ':attribute フィールドは :other が :values に含まれない限り禁止されています。',
    'prohibits' => ':attribute フィールドは :other が存在することを禁止しています。',
    'regex' => ':attribute の形式が無効です。',
    'required' => ':attribute フィールドは必須です。',
    'required_array_keys' => ':attribute フィールドには :values のエントリが含まれている必要があります。',
    'required_if' => ':attribute フィールドは :other が :value の場合に必須です。',
    'required_unless' => ':attribute フィールドは :other が :values に含まれない限り必須です。',
    'required_with' => ':attribute フィールドは :values が存在する場合に必須です。',
    'required_with_all' => ':attribute フィールドは :values がすべて存在する場合に必須です。',
    'required_without' => ':attribute フィールドは :values が存在しない場合に必須です。',
    'required_without_all' => ':attribute フィールドは :values のいずれも存在しない場合に必須です。',
    'same' => ':attribute と :other は一致する必要があります。',
    'size' => [
        'numeric' => ':attribute は :size でなければなりません。',
        'file' => ':attribute は :size キロバイトでなければなりません。',
        'string' => ':attribute は :size 文字でなければなりません。',
        'array' => ':attribute は :size アイテムを含む必要があります。',
    ],
    'starts_with' => ':attribute は以下のいずれかで始まる必要があります: :values。',
    'string' => ':attribute は文字列でなければなりません。',
    'timezone' => ':attribute は有効なタイムゾーンでなければなりません。',
    'unique' => ':attribute はすでに使用されています。',
    'uploaded' => ':attribute のアップロードに失敗しました。',
    'url' => ':attribute は有効なURLでなければなりません。',
    'uuid' => ':attribute は有効なUUIDでなければなりません。',

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
