<?php

namespace App\Controller\Project;

use App\Entity\Project;
use App\Form\ProjectNameType;
use App\Service\ProjectConfigService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Registry;

class CreateProjectController extends AbstractController
{

    public function __construct(
        private Registry $workflowRegistry,
        private ProjectConfigService $projectConfigService,
    ) {}

    #[Route('/create-project', name: "create_project")]
    public function createProject(Request $request): Response
    {

        $project = new Project();
        $project->setCurrentStep('choose_name');

        $form = $this->createForm(ProjectNameType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->projectConfigService->generateYaml($project);

            $workflow = $this->workflowRegistry->get($project);

            if ($workflow->can($project, 'choose_name_to_php_version')) {
                $workflow->apply($project, 'choose_name_to_php_version');
            }

            $this->projectConfigService->updateYaml($project);

            return $this->redirectToRoute('choose_php_version', ['project' => $project->getId()]);
        }

        return $this->render('project/create.html.twig', [
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }
}
