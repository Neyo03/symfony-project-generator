<?php

namespace App\Service;

class WorkflowStepMapper
{
    private const STEP_MAPPING = [
        'choose_name' => 1,
        'choose_php_version' => 2,
        'choose_symfony_version' => 3,
        'choose_database' => 4,
        'choose_destination_folder' => 5,
    ];

    public function getStepForState(string $state): int
    {
        return self::STEP_MAPPING[$state] ?? 0;
    }

    public function getStateForStep(int $step): string
    {
        return array_flip(self::STEP_MAPPING)[$step] ?? '';
    }
}
