<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\laragon\www\nette_zadanie\app\Components/addPetForm.latte */
final class Template_c63c051c9a extends Latte\Runtime\Template
{
	public const Source = 'C:\\laragon\\www\\nette_zadanie\\app\\Components/addPetForm.latte';


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		$form = $this->global->formsStack[] = $this->global->uiControl['addPetForm'] /* line 1 */;
		Nette\Bridges\FormsLatte\Runtime::initializeForm($form);
		echo '<form';
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), ['method' => null, 'enctype' => null], false) /* line 1 */;
		echo ' method="post" enctype="multipart/form-data">
';
		$ʟ_tmp = $this->global->uiControl->getComponent('addPetForm');
		if ($ʟ_tmp instanceof Nette\Application\UI\Renderable) $ʟ_tmp->redrawControl(null, false);
		$ʟ_tmp->render() /* line 2 */;

		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(end($this->global->formsStack), false) /* line 1 */;
		echo '</form>';
		array_pop($this->global->formsStack);
	}
}
