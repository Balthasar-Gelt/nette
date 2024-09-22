<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\laragon\www\nette_zadanie\app\UI\Pet/list.latte */
final class Template_3fa9bd9f6e extends Latte\Runtime\Template
{
	public const Source = 'C:\\laragon\\www\\nette_zadanie\\app\\UI\\Pet/list.latte';

	public const Blocks = [
		['content' => 'blockContent'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		$this->renderBlock('content', get_defined_vars()) /* line 1 */;
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		$ʟ_tmp = $this->global->uiControl->getComponent('petGrid');
		if ($ʟ_tmp instanceof Nette\Application\UI\Renderable) $ʟ_tmp->redrawControl(null, false);
		$ʟ_tmp->render($pets) /* line 2 */;
	}
}
