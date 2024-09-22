<?php

namespace App\Components\Pet\Grid;

use App\Repository\PetRepository;
use Nette\Application\Attributes\Requires;
use Nette\Application\UI\Control;

class Component extends Control
{
    /**
     * @var callable
     */
    private $onDeleteFinish;

    /**
     * @var callable|null
     */
    private $onPetNotFound;

    /**
     * @var callable|null
     */
    private $onPetDeletedSuccess;

    public function __construct(
        private PetRepository $petRepository,
        callable $onDeleteFinish,
        ?callable $onPetNotFound = null,
        ?callable $onPetDeletedSuccess = null,

    ) {
        $this->onDeleteFinish = $onDeleteFinish;
        $this->onPetNotFound = $onPetNotFound;
        $this->onPetDeletedSuccess = $onPetDeletedSuccess;
    }

    public function render($pets): void
    {
        $this->template->pets = $pets;
        $this->template->render(__DIR__ . '/default.latte');
    }

    #[Requires(methods: 'POST')]
    public function handleDelete(int $id): void
    {
        $pet = $this->petRepository->getPetById($id);

        if (!$pet) {
            ($this->onPetNotFound)();
        } else {
            $imagePath = $pet->getImage();
            if ($imagePath && file_exists($imagePath)) {
                unlink($imagePath);
            }

            $this->petRepository->deletePet($id);
            ($this->onPetDeletedSuccess)();
        }

        ($this->onDeleteFinish)();
    }
}
