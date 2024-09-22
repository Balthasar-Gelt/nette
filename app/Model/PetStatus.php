<?php

declare(strict_types=1);

namespace App\Model;

class PetStatus
{
    public const AVAILABLE = 'available';
    public const PENDING = 'pending';
    public const SOLD = 'sold';
    public const ALL = 'all';
    public const DEFAULT = 'available';

    /**
     * Returns an array of valid pet statuses.
     *
     * @return string[] List of valid statuses.
     */
    public static function getValidStatuses(): array
    {
        return [
            self::AVAILABLE,
            self::PENDING,
            self::SOLD,
        ];
    }
}
