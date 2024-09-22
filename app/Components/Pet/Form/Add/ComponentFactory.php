<?php

namespace App\Components\Pet\Form\Add;

use App\Repository\PetRepository;

class ComponentFactory
{
	public function __construct(
		private PetRepository $petRepository,
	) {
	}

	public function create(callable $onSuccess): Component
	{
		return new Component($this->petRepository, $onSuccess);
	}
}