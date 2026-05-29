<?php

namespace App\Enums;

enum NotificationTypeEnum: string
{
    case SUCCESS = 'success';

    case WARNING = 'warning';

    case INFO = 'info';

    case ERROR = 'error';

    /*
    |--------------------------------------------------------------------------
    | LABEL
    |--------------------------------------------------------------------------
    */

    public function label(): string
    {
        return match ($this) {

            self::SUCCESS => 'Berhasil',

            self::WARNING => 'Peringatan',

            self::INFO => 'Informasi',

            self::ERROR => 'Error',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | BADGE
    |--------------------------------------------------------------------------
    */

    public function badge(): string
    {
        return match ($this) {

            self::SUCCESS
            => 'bg-green-100 text-green-700',

            self::WARNING
            => 'bg-yellow-100 text-yellow-700',

            self::INFO
            => 'bg-blue-100 text-blue-700',

            self::ERROR
            => 'bg-red-100 text-red-700',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | ICON
    |--------------------------------------------------------------------------
    */

    public function icon(): string
    {
        return match ($this) {

            self::SUCCESS => '✅',

            self::WARNING => '⚠️',

            self::INFO => 'ℹ️',

            self::ERROR => '❌',
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

            self::SUCCESS->value
            => self::SUCCESS->label(),

            self::WARNING->value
            => self::WARNING->label(),

            self::INFO->value
            => self::INFO->label(),

            self::ERROR->value
            => self::ERROR->label(),
        ];
    }
}
