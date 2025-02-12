<?php

namespace App\Controller\Project;

use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Registry;


class ChoosePhpVersionController extends AbstractController
{

    public function __construct(private Registry $workflowRegistry) {}

    #[Route('/choose-php-version/{project}', name: "choose_php_version")]
    public function choosePhpVersion(Project $project): Response
    {
        $workflow = $this->workflowRegistry->get($project);

        if ($workflow->can($project, 'choose_php_version_to_symfony_version')) {
            $workflow->apply($project, 'choose_php_version_to_symfony_version');
        }

        return $this->render('project/php_version.html.twig', [
            'project' => $project,
        ]);
    }
}
