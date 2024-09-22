<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\laragon\www\nette_zadanie\app\UI\Pet/index.latte */
final class Template_5340bddfcd extends Latte\Runtime\Template
{
	public const Source = 'C:\\laragon\\www\\nette_zadanie\\app\\UI\\Pet/index.latte';

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


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['pet' => '5'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '<h1>Pets Index</h1>

<ul>
';
		foreach ($pets as $pet) /* line 5 */ {
			echo '        <li>';
			echo LR\Filters::escapeHtmlText($pet->name) /* line 6 */;
			echo ' - ';
			echo LR\Filters::escapeHtmlText($pet->status) /* line 6 */;
			echo '</li>
';

		}

		echo '</ul>

';
	}
}
