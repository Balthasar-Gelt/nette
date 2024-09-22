<?php

namespace App\Components\Pet\Form\Edit;

use App\Model\PetStatus;
use App\Repository\PetRepository;
use Nette\Application\UI\Form;
use Nette\Application\UI\Control;

class Component extends Control
{
    /**
     * @var callable
     */
    private $onSuccess;

    public function __construct(
        private PetRepository $petRepository,
        private int $petId,
        callable $onSuccess
    ) {
        $this->onSuccess = $onSuccess;
    }

    public function render()
    {
        $this->template->render(__DIR__ . '/default.latte');
    }

    protected function createComponentEditPetForm(): Form
    {
        $form = new Form;
        $form->addHidden('id');

        $form->addText('name', 'Pet Name:')
            ->setRequired('Please enter the pet\'s name.');

        $form->addText('category', 'Category:')
            ->setRequired('Please enter the pet\'s category.');

        $form->addUpload('image', 'Image:')
            ->setRequired(false);

        $form->addHidden('existingImage');

        $form->addSelect('status', 'Status:', array_combine(PetStatus::getValidStatuses(), PetStatus::getValidStatuses()))
            ->setRequired('Please enter the pet\'s status.');

        $form->addSubmit('send', 'Update Pet');

        $form->onSuccess[] = [$this, 'editPetFormSucceeded'];
        $form->onSuccess[] = $this->onSuccess;

        if ($this->petId !== null) {
            $pet = $this->petRepository->getPetById($this->petId);
            $form->setDefaults([
                'id' => $pet->getId(),
                'name' => $pet->getName(),
                'category' => $pet->getCategory(),
                'image' => $pet->getImage(),
                'existingImage' => $pet->getImage(),
                'status' => $pet->getStatus(),
            ]);
        }

        return $form;
    }

    public function editPetFormSucceeded(Form $form, \stdClass $values): void
    {
        if (!$this->petRepository->getPetById((int)$values->id)) {
            $this->getPresenter()->flashMessage('Pet does not exist', 'error');
        } else {
            $file = $values->image;
            $existingFile = $values->existingImage;

            if ($file->isOk()) {
                $imagePath = 'images/' . $file->getSanitizedName();

                if ($existingFile && file_exists($existingFile)) {
                    unlink($existingFile);
                }

                $file->move($imagePath);
            } else {
                $imagePath = $existingFile;
            }

            $this->petRepository->updatePet((int)$values->id, [
                'name' => $values->name,
                'category' => $values->category,
                'image' => $imagePath,
                'status' => $values->status,
            ]);
        }
    }
}
