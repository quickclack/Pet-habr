<?php

namespace Domain\User\Rules;

use Illuminate\Contracts\Validation\Rule;

class CommentRule implements Rule
{
    public function __construct()
    {
    }

    public function passes($attribute, $value): bool
    {
        return !preg_match('/~[^и][hхx][уyu][йyяij]|[hхx][уyu][eеЁ][tlvлвт]|[hхx][уyu][йyijoeоеёЁ]+[vwbв][oiоы]|[pп][ieие][dдg][eaoеао][rpр]|[scс][yuу][kк][aiuаи]|[scс][yuу][4ч][кk]|[3zsз][aа][eiе][bpб][iи]|[^н][eе][bpб][aа][lл]|fuck|xyu|хуй|[pп][iи][zsз3][dд]|[z3ж]h?[оo][pп][aаyуыiеe]~si/', $value);
    }

    public function message(): string
    {
        return 'В сообщениях не допустимы нецензурные выражения';
    }
}
