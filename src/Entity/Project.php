<?php

namespace App\Entity;

use App\Enum\SymfonyDependencyEnum;

class Project
{
    public const PROJET_FILE_PATH = __DIR__ . '/../../config/projects/';

    private ?int $id = null;

    private ?string $name = null;

    private ?string $phpVersion = null;

    private ?string $symfonyVersion = null;

    private ?string $database = null;

    private ?string $authentication = null;

    /**
     * @var SymfonyDependencyEnum[]
     */
    private array $dependencies = [];

    private ?string $jsIntegration = null;

    private ?string $destinationFolder = null;

    private ?string $currentStep = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name = null): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPhpVersion(): ?string
    {
        return $this->phpVersion;
    }

    public function setPhpVersion(?string $phpVersion = null): self
    {
        $this->phpVersion = $phpVersion;
        return $this;
    }

    public function getSymfonyVersion(): ?string
    {
        return $this->symfonyVersion;
    }

    public function setSymfonyVersion(?string $symfonyVersion = null): self
    {
        $this->symfonyVersion = $symfonyVersion;
        return $this;
    }

    public function getDatabase(): ?string
    {
        return $this->database;
    }

    public function setDatabase(?string $database = null): self
    {
        $this->database = $database;
        return $this;
    }

    public function getAuthentication(): ?string
    {
        return $this->authentication;
    }

    public function setAuthentication(?string $authentication = null): self
    {
        $this->authentication = $authentication;
        return $this;
    }

    public function getDependencies(): array
    {
        return $this->dependencies;
    }

    public function setDependencies(array $dependencies): self
    {
        foreach ($dependencies as $dependency) {
            if (!SymfonyDependencyEnum::tryFrom($dependency)) {
                throw new \InvalidArgumentException("Invalid dependency: {$dependency}");
            }
        }
        $this->dependencies = $dependencies;
        return $this;
    }

    public function getJsIntegration(): ?string
    {
        return $this->jsIntegration;
    }

    public function setJsIntegration(?string $jsIntegration = null): self
    {
        $this->jsIntegration = $jsIntegration;
        return $this;
    }

    public function getDestinationFolder(): ?string
    {
        return $this->destinationFolder;
    }

    public function setDestinationFolder(?string $destinationFolder = null): self
    {
        $this->destinationFolder = $destinationFolder;
        return $this;
    }

    public function getCurrentStep(): ?string
    {
        return $this->currentStep;
    }

    public function setCurrentStep(?string $currentStep = null): self
    {
        $this->currentStep = $currentStep;
        return $this;
    }
}
