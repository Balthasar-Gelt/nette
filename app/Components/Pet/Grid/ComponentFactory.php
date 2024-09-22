<?php

namespace App\Components\Pet\Grid;

use App\Repository\PetRepository;

class ComponentFactory
{
	public function __construct(
		private PetRepository $petRepository,
	) {}

	public function create(callable $onDeleteFinish, callable $onPetNotFound, callable $onPetDeletedSuccess): Component
	{
		return new Component($this->petRepository, $onDeleteFinish, $onPetNotFound, $onPetDeletedSuccess);
	}
}
