<?php

namespace App\Controller\Project;

use App\Entity\Project;
use App\Form\ProjectFormType;
use App\Service\ProjectConfigService;
use App\Service\WorkflowStepMapper;
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
        private WorkflowStepMapper $workflowStepMapper
    ) {}

    #[Route('/create-project/{step}', name: 'create_project')]
    public function createProject(string $step, Request $request): Response
    {
        $project = $request->getSession()->get('project', new Project());
        $project->setCurrentStep($step);

        $stepTitle = $request->getSession()->get('stepTitle', 'Choose Name');
        $stepDescription = $request->getSession()->get('stepDescription', 'Choose the name for your project');

        $form = $this->createForm(ProjectFormType::class, $project, [
            'current_step' => $step,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $workflow = $this->workflowRegistry->get($project);

            try {
                switch ($step) {
                    case 'choose_name':
                        $this->projectConfigService->generateYaml($project);
                        if ($workflow->can($project, 'choose_name_to_php_version')) {
                            $workflow->apply($project, 'choose_name_to_php_version');
                        }
                        $stepTitle = 'Choose PHP Version';
                        $stepDescription = 'Choose the PHP version for your project';
                        $nextStep = 'choose_php_version';
                        break;
                    case 'choose_php_version':
                        if ($workflow->can($project, 'choose_php_version_to_symfony_version')) {
                            $workflow->apply($project, 'choose_php_version_to_symfony_version');
                        }
                        $stepTitle = 'Choose Symfony Version';
                        $stepDescription = 'Choose the Symfony version for your project';
                        $nextStep = 'choose_symfony_version';
                        break;
                    case 'choose_symfony_version':
                        if ($workflow->can($project, 'choose_symfony_version_to_database')) {
                            $workflow->apply($project, 'choose_symfony_version_to_database');
                        }
                        $stepTitle = 'Choose Database';
                        $stepDescription = 'Choose the database for your project';
                        $nextStep = 'choose_database';
                        break;
                        // case 'choose_database':
                        //     if ($workflow->can($project, 'choose_database_to_authentication')) {
                        //         $workflow->apply($project, 'choose_database_to_authentication');
                        //     }
                        //     $stepTitle = 'Choose Authentication';
                        //     $stepDescription = 'Choose the authentication for your project';
                        //     $nextStep = 'choose_authentication';
                        //     break;
                    case 'choose_database':
                        if ($workflow->can($project, 'choose_database_to_destination_folder')) {
                            $workflow->apply($project, 'choose_database_to_destination_folder');
                        }
                        $stepTitle = 'Choose Destination Folder';
                        $stepDescription = 'Choose the destination folder for your project';
                        $nextStep = 'choose_destination_folder';
                        break;
                        // case 'choose_authentication':
                        //     if ($workflow->can($project, 'choose_authentication_to_dependencies')) {
                        //         $workflow->apply($project, 'choose_authentication_to_dependencies');
                        //     }
                        //     $stepTitle = 'Choose Dependencies';
                        //     $stepDescription = 'Choose the dependencies for your project';
                        //     $nextStep = 'choose_dependencies';
                        //     break;
                        // case 'choose_dependencies':
                        //     if ($workflow->can($project, 'choose_dependencies_to_js_integration')) {
                        //         $workflow->apply($project, 'choose_dependencies_to_js_integration');
                        //     }
                        //     $stepTitle = 'Choose JS Integration';
                        //     $stepDescription = 'Choose the JS integration for your project';
                        //     $nextStep = 'choose_js_integration';
                        //     break;
                        // case 'choose_js_integration':
                        //     if ($workflow->can($project, 'choose_js_integration_to_destination_folder')) {
                        //         $workflow->apply($project, 'choose_js_integration_to_destination_folder');
                        //     }
                        //     $stepTitle = 'Choose Destination Folder';
                        //     $stepDescription = 'Choose the destination folder for your project';
                        //     $nextStep = 'choose_destination_folder';
                        //     break;
                    case 'choose_destination_folder':
                        if ($workflow->can($project, 'choose_destination_folder_to_end')) {
                            $workflow->apply($project, 'choose_destination_folder_to_end');
                        }
                        $stepTitle = 'End';
                        $stepDescription = 'Your project is ready';
                        $nextStep = 'end';
                        break;
                    case 'end':
                        $request->getSession()->remove('project');
                        break;
                    default:
                        throw new \Exception('Invalid step');
                }
                $request->getSession()->set('stepTitle', $stepTitle);
                $request->getSession()->set('stepDescription', $stepDescription);
                $request->getSession()->set('project', $project);
                $this->projectConfigService->updateYaml($project);

                return $this->redirectToRoute('create_project', ['step' => $nextStep]);
            } catch (\Exception $e) {
            }
        }

        $currentStep = $this->workflowStepMapper->getStepForState($step);

        return $this->render('project/base_step.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
            'stepTitle' => $stepTitle,
            'stepDescription' => $stepDescription,
            'currentStep' => $currentStep,
        ]);
    }
}
