<?php

declare(strict_types=1);

namespace App\UI\Pet;

use App\Components\Pet\Form\Add\Component as FormAddComponent;
use App\Components\Pet\Form\Add\ComponentFactory as FormAddComponentFactory;
use App\Components\Pet\Form\Edit\Component as FormEditComponent;
use App\Components\Pet\Form\Edit\ComponentFactory as FormEditComponentFactory;
use App\Components\Pet\Grid\Component as GridComponent;
use App\Components\Pet\Grid\ComponentFactory as GridComponentFactory;
use App\Model\PetStatus;
use App\Repository\PetRepository;
use Nette;
use Nette\Application\Attributes\Requires;
use Nette\Application\UI\Form;

final class PetPresenter extends Nette\Application\UI\Presenter
{
    public function __construct(
        private PetRepository $petRepository,
        private FormAddComponentFactory $formAddComponentFactory,
        private FormEditComponentFactory $formEditComponentFactory,
        private GridComponentFactory $gridComponentFactory
    ) {}

    #[Requires(methods: ['GET'])]
    public function renderList(): void
    {
        $pets = [];
        $status = $this->getParameter('status');

        if (in_array($status, PetStatus::getValidStatuses())) {
            $pets = $this->petRepository->getPetsByStatus($status);
        } else {
            $pets = $this->petRepository->getAllPets();
        }

        $this->template->pets = $pets;
    }

    public function createComponentPetGrid(): GridComponent
    {
        return $this->gridComponentFactory->create(
            [$this, 'gridOnDeleteFinish'],
            [$this, 'gridOnPetNotFound'],
            [$this, 'gridOnPetDeletedSuccess']
        );
    }

    public function gridOnDeleteFinish()
    {
        $this->redirect('Pet:list', ['status' => PetStatus::ALL]);
    }

    public function gridOnPetNotFound()
    {
        $this->flashMessage('Pet does not exist', 'error');
    }

    public function gridOnPetDeletedSuccess()
    {
        $this->flashMessage('Pet deleted successfully.', 'success');
    }

    public function createComponentAddPetForm(): FormAddComponent
    {
        return $this->formAddComponentFactory->create([$this, 'formAddOnSuccess']);
    }

    public function formAddOnSuccess()
    {
        $this->flashMessage('Pet added successfully.');
        $this->redirect('Pet:list', ['status' => PetStatus::ALL]);
    }

    public function actionEdit(int $id): void
    {
        $pet = $this->petRepository->getPetById($id);
        if (!$pet) {
            $this->flashMessage('Pet not found', 'error');
            $this->redirect('Pet:list', ['status' => PetStatus::ALL]);
        }
    }

    #[Requires(methods: ['GET'])]
    public function renderEdit(int $id): void
    {
        $this->template->pet = $this->petRepository->getPetById($id);
    }

    protected function createComponentEditPetForm(): FormEditComponent
    {
        return $this->formEditComponentFactory->create((int)$this->getParameter('id'), [$this, 'formEditOnSuccess']);
    }

    public function formEditOnSuccess(Form $form, $values): void
    {
        $this->flashMessage('Pet updated successfully', 'success');
        $this->redirect('Pet:list', ['status' => PetStatus::ALL]);
    }
}
