<?php

namespace App\Enums;

enum StatusBerkasEnum: string
{
    case PENDING = 'pending';

    case DITERIMA = 'diterima';

    case DITOLAK = 'ditolak';

    /*
    |--------------------------------------------------------------------------
    | LABEL
    |--------------------------------------------------------------------------
    */

    public function label(): string
    {
        return match ($this) {

            self::PENDING
            => 'Pending',

            self::DITERIMA
            => 'Diterima',

            self::DITOLAK
            => 'Ditolak',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | BADGE COLOR
    |--------------------------------------------------------------------------
    */

    public function badge(): string
    {
        return match ($this) {

            self::PENDING
            => 'bg-yellow-100 text-yellow-700',

            self::DITERIMA
            => 'bg-green-100 text-green-700',

            self::DITOLAK
            => 'bg-red-100 text-red-700',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | OPTIONS
    |--------------------------------------------------------------------------
    */

    public static function options(): array
    {
        return [

            self::PENDING->value
            => self::PENDING->label(),

            self::DITERIMA->value
            => self::DITERIMA->label(),

            self::DITOLAK->value
            => self::DITOLAK->label(),
        ];
    }
}
