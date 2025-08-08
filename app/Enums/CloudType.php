<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 *
 */
final class CloudType extends Enum
{
    const OD = 1;
    const GD = 2;
    const FTP = 3;
    const S3 = 4;

    public static function getDescription($value): string
    {
        return match ($value) {
            self::OD => 'OneDrive',
            self::GD => 'Google Drive',
            self::FTP => 'FTP',
            self::S3 => 'Amazon S3',
            default => parent::getDescription($value),
        };
    }

    public static function getIcon($value): string
    {
        return match ($value) {
            self::OD => asset('assets/icons/onedrive.svg'),
            self::GD => asset('assets/icons/googledrive.svg'),
            self::FTP => asset('assets/icons/ftp.svg'),
            self::S3 => asset('assets/icons/s3.svg'),
            default => parent::getIcon($value),
        };
    }

    public static function asArray(): array
    {
        return [
            self::OD => [
                'name' => self::getDescription(self::OD),
                'icon' => self::getIcon(self::OD),
            ],
            self::GD => [
                'name' => self::getDescription(self::GD),
                'icon' => self::getIcon(self::GD),
            ],
            self::FTP => [
                'name' => self::getDescription(self::FTP),
                'icon' => self::getIcon(self::FTP),
            ],
            self::S3 => [
                'name' => self::getDescription(self::S3),
                'icon' => self::getIcon(self::S3),
            ],
        ];
    }
}
