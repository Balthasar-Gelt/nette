<?php

declare(strict_types=1);

namespace App\Model;

class Pet
{
    /**
     * The unique identifier of the pet.
     *
     * @var int|null
     */
    private ?int $id = null;

    public function __construct(
        private string $name,
        private string $category,
        private ?string $image,
        private string $status
    ) {}

    /**
     * Gets the pet's ID.
     *
     * @return int|null The ID of the pet or null if not set.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Sets the pet's ID.
     *
     * @param int $id The ID to assign to the pet.
     * @return static The current instance for method chaining.
     */
    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the pet's name.
     *
     * @return string The name of the pet.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the pet's name.
     *
     * @param string $name The new name for the pet.
     * @return static The current instance for method chaining.
     */
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the pet's category.
     *
     * @return string The category of the pet.
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * Sets the pet's category.
     *
     * @param string $category The new category for the pet.
     * @return static The current instance for method chaining.
     */
    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Gets the pet's image.
     *
     * @return string|null The image filename of the pet or null if not set.
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Sets the pet's image.
     *
     * @param string|null $image The new image filename for the pet or null if removing the image.
     * @return static The current instance for method chaining.
     */
    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Gets the pet's status.
     *
     * @return string The current status of the pet.
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Sets the pet's status.
     *
     * @param string $status The new status for the pet.
     * @return static The current instance for method chaining.
     */
    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Convert the Pet object to an associative array.
     *
     * @return array An associative array with Pet's attributes.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'category' => $this->getCategory(),
            'image' => $this->getImage(),
            'status' => $this->getStatus(),
        ];
    }
}
