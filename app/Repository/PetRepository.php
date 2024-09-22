<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Pet;
use App\Storage\XMLStorageManager;

class PetRepository
{
    public function __construct(
        private XMLStorageManager $storageManager
    ) {}

    /**
     * Updates an existing pet with the provided values.
     *
     * @param int $id The ID of the pet to update.
     * @param array $values An associative array of values to update, which should include.
     * @return void
     */
    public function updatePet(int $id, array $values): void
    {
        $pet = $this->getPetById($id);
        $xmlData = $this->storageManager->load();

        foreach ($xmlData as $xmlPet) {
            if (intval($xmlPet->id) == $pet->getId()) {
                foreach ($values as $key => $value) {
                    if (isset($xmlPet->{$key})) {
                        $xmlPet->{$key}[0] = (string)$value;
                    }
                }
            }
        }

        $this->storageManager->save($xmlData);
    }

    /**
     * Deletes a pet by its ID.
     *
     * @param int $id The ID of the pet to delete.
     * @return void
     */
    public function deletePet(int $id): void
    {
        $xmlData = $this->storageManager->load();

        foreach ($xmlData->pet as $pet) {
            if (intval($pet->id) === $id) {
                $dom = dom_import_simplexml($pet);

                $dom->parentNode->removeChild($dom);
                break;
            }
        }

        $this->storageManager->save($xmlData);
    }

    /**
     * Retrieves all pets from the storage.
     *
     * @return Pet[] An array of Pet objects.
     */
    public function getAllPets(): array
    {
        $xmlData = $this->storageManager->load();
        $pets = [];
        foreach ($xmlData->pet as $pet) {
            $pets[] = $this->InitializePet($pet);
        }

        return $pets;
    }

    /**
     * Retrieves pets by their status.
     *
     * @param string $status The status to filter pets by.
     * @return Pet[] An array of Pet objects with the specified status.
     */
    public function getPetsByStatus(string $status): array
    {
        $pets = $this->getAllPets();

        return array_filter($pets, fn(Pet $pet) => $pet->getStatus() === $status);
    }

    /**
     * Saves a pet to the storage.
     *
     * If the pet does not have an ID, a new ID is assigned.
     *
     * @param Pet $pet The Pet object to save.
     * @return void
     */
    public function save(Pet $pet): void
    {
        if ($pet->getId() === null) {
            $pet->setId($this->getNextId());
        }

        $xmlData = $this->storageManager->load();
        $petElement = $xmlData->addChild('pet');

        foreach ($pet->toArray() as $key => $value) {
            $petElement->addChild($key, (string)$value);
        }

        $this->storageManager->save($xmlData);
    }

    /**
     * Retrieves the last pet from the storage.
     *
     * @return Pet|null The last Pet object, or null if no pets exist.
     */
    public function getLastPet(): ?Pet
    {
        $xmlData = $this->storageManager->load();
        $pets = $xmlData->xpath('/pets/pet');

        if (empty($pets)) {
            return null;
        }

        return $this->InitializePet(end($pets));
    }

    /**
     * Retrieves a pet by its ID.
     *
     * @param int $id The ID of the pet to retrieve.
     * @return Pet|null The Pet object with the specified ID, or null if no such pet exists.
     */
    public function getPetById(int $id): ?Pet
    {
        $xmlData = $this->storageManager->load();
        foreach ($xmlData->pet as $pet) {
            if (intval($pet->id) == $id) {
                return $this->InitializePet($pet);
            }
        }

        return null;
    }

    /**
     * Gets the next available ID for a new pet.
     *
     * @return int The next available ID.
     */
    private function getNextId(): int
    {
        $lastPet = $this->getLastPet();

        if (!$lastPet) {
            return 1;
        }

        return  $lastPet->getId() + 1;
    }

    /**
     * Initializes a Pet object from a SimpleXMLElement.
     *
     * @param \SimpleXMLElement $pet The SimpleXMLElement representing the pet.
     * @return Pet The initialized Pet object.
     */
    private function InitializePet(\SimpleXMLElement $pet): Pet
    {
        $newPet = new Pet(
            strval($pet->name),
            strval($pet->category),
            strval($pet->image),
            strval($pet->status)
        );
        $newPet->setId(intval($pet->id));

        return $newPet;
    }
}
