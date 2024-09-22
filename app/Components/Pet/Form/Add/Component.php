<?php

namespace App\Components\Pet\Form\Add;

use App\Model\Pet;
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
        callable $onSuccess
    ) {
        $this->onSuccess = $onSuccess;
    }

    public function render()
    {
        $this->template->render(__DIR__ . '/default.latte');
    }

    protected function createComponentAddPetForm(): Form
    {
        $form = new Form;
        $form->addText('name', 'Pet Name:')
            ->setRequired('Please enter the pet\'s name.');

        $form->addText('category', 'Category:')
            ->setRequired('Please enter the pet\'s category.');

        $form->addUpload('image', 'Image:')
            ->setRequired('Please upload an image.');

        $form->addSelect('status', 'Status:', array_combine(PetStatus::getValidStatuses(), PetStatus::getValidStatuses()))
            ->setRequired('Please enter the pet\'s status.');

        $form->addSubmit('send', 'Add Pet');

        $form->onSuccess[] = [$this, 'addPetFormSucceeded'];
        $form->onSuccess[] = $this->onSuccess;

        return $form;
    }

    public function addPetFormSucceeded(Form $form, \stdClass $values): void
    {
        $file = $values->image;

        if ($file->isOk()) {
            $imagePath = 'images/' . $file->getSanitizedName();
            $file->move($imagePath);
        } else {
            $imagePath = null;
        }

        $this->petRepository->save(new Pet($values->name, $values->category, $imagePath, $values->status));
    }
}
