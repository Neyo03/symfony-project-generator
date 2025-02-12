<?php

namespace App\Service;

use App\Entity\Project;
use Symfony\Component\Yaml\Yaml;

class ProjectConfigService
{
    public function __construct(private string $projectDir) {}

    public function generateYaml(Project $project): void
    {
        $filePath = $this->projectDir . '/config/projects/' . $project->getName() . '.yaml';

        $data = [
            'name' => $project->getName(),
            'phpVersion' => $project->getPhpVersion(),
            'symfonyVersion' => $project->getSymfonyVersion(),
            'database' => $project->getDatabase(),
            'authentication' => $project->getAuthentication(),
            'dependencies' => $project->getDependencies(),
            'jsIntegration' => $project->getJsIntegration(),
            'destinationFolder' => $project->getDestinationFolder(),
            'currentStep' => $project->getCurrentStep(),
        ];

        file_put_contents($filePath, Yaml::dump($data, 4));
    }

    public function updateYaml(Project $project): void
    {
        $filePath = $this->projectDir . '/config/projects' . $project->getName() . '.yaml';

        $data = Yaml::parseFile($filePath);

        $data['currentStep'] = $project->getCurrentStep();

        file_put_contents($filePath, Yaml::dump($data, 4));
    }
}
