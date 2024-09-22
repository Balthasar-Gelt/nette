<?php

namespace App\Components\Pet\Form\Edit;

use App\Repository\PetRepository;

class ComponentFactory
{
	public function __construct(
		private PetRepository $petRepository,
	) {
	}

	public function create(int $petId, callable $onSuccess): Component
	{
		return new Component($this->petRepository, $petId, $onSuccess);
	}
}