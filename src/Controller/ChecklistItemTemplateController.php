<?php

namespace App\Controller;

use App\Entity\ChecklistItemTemplate;
use App\Entity\ChecklistTemplate;
use App\Form\ChecklistItemTemplateType;
use App\Repository\ChecklistItemTemplateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/checklist/template/{template_id}/item')]
final class ChecklistItemTemplateController extends AbstractController
{
    #[Route(name: 'app_checklist_item_template_index', methods: ['GET'])]
    public function index(ChecklistTemplate $template_id, ChecklistItemTemplateRepository $repository): Response
    {
        return $this->render('checklist_item_template/index.html.twig', [
            'checklist_item_templates' => $repository->findBy(['checklistTemplate' => $template_id]),
            'checklist_template' => $template_id,
        ]);
    }

    #[Route('/new', name: 'app_checklist_item_template_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ChecklistTemplate $template_id, EntityManagerInterface $entityManager): Response
    {
        $checklistItemTemplate = new ChecklistItemTemplate();
        $checklistItemTemplate->setChecklistTemplate($template_id);
        
        $form = $this->createForm(ChecklistItemTemplateType::class, $checklistItemTemplate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($checklistItemTemplate);
            $entityManager->flush();

            return $this->redirectToRoute('app_checklist_item_template_index', ['template_id' => $template_id->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('checklist_item_template/new.html.twig', [
            'checklist_item_template' => $checklistItemTemplate,
            'checklist_template' => $template_id,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_checklist_item_template_show', methods: ['GET'])]
    public function show(ChecklistItemTemplate $checklistItemTemplate): Response
    {
        return $this->render('checklist_item_template/show.html.twig', [
            'checklist_item_template' => $checklistItemTemplate,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_checklist_item_template_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ChecklistItemTemplate $checklistItemTemplate, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChecklistItemTemplateType::class, $checklistItemTemplate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_checklist_item_template_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('checklist_item_template/edit.html.twig', [
            'checklist_item_template' => $checklistItemTemplate,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_checklist_item_template_delete', methods: ['POST'])]
    public function delete(Request $request, ChecklistItemTemplate $checklistItemTemplate, ChecklistTemplate $template_id, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$checklistItemTemplate->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($checklistItemTemplate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_checklist_item_template_index', ['template_id' => $template_id->getId()], Response::HTTP_SEE_OTHER);
    }
}
