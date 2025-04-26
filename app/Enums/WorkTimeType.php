<?php

namespace App\Enums;

enum WorkTimeType: string
{
    case FULL_TIME = 'full-time';
    case PART_TIME = 'part-time';
    case CONTRACT = 'contract';
    case FREELANCE = 'freelance';

    public function label(): string
    {
        return match($this) {
            self::FULL_TIME => 'სრული განაკვეთი',
            self::PART_TIME => 'ნახევარი განაკვეთი',
            self::CONTRACT => 'კონტრაქტი',
            self::FREELANCE => 'ფრილანსი',
        };
    }

    public function englishLabel(): string
    {
        return match($this) {
            self::FULL_TIME => 'Full Time',
            self::PART_TIME => 'Part Time',
            self::CONTRACT => 'Contract',
            self::FREELANCE => 'Freelance',
        };
    }

    public static function toArray(): array
    {
        return [
            self::FULL_TIME->value => self::FULL_TIME->label(),
            self::PART_TIME->value => self::PART_TIME->label(),
            self::CONTRACT->value => self::CONTRACT->label(),
            self::FREELANCE->value => self::FREELANCE->label(),
        ];
    }
} 