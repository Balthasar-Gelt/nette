<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\laragon\www\nette_zadanie\app\UI\Home/default.latte */
final class Template_f453f53a3a extends Latte\Runtime\Template
{
	public const Source = 'C:\\laragon\\www\\nette_zadanie\\app\\UI\\Home/default.latte';

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

		$this->renderBlock('content', get_defined_vars()) /* line 3 */;
	}


	/** {block content} on line 3 */
	public function blockContent(array $ʟ_args): void
	{
	}
}
