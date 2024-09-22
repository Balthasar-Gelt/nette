<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\laragon\www\nette_zadanie\app\Component\Pet\Grid/default.latte */
final class Template_de227c4378 extends Latte\Runtime\Template
{
	public const Source = 'C:\\laragon\\www\\nette_zadanie\\app\\Component\\Pet\\Grid/default.latte';


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		echo '<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
';
		foreach ($pets as $pet) /* line 10 */ {
			echo '        <tr>
            <td>';
			echo LR\Filters::escapeHtmlText($pet->name) /* line 12 */;
			echo '</td>
            <td>';
			echo LR\Filters::escapeHtmlText($pet->category) /* line 13 */;
			echo '</td>
            <td>';
			echo LR\Filters::escapeHtmlText($pet->status) /* line 14 */;
			echo '</td>
        </tr>
';

		}

		echo '    </tbody>
</table>';
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['pet' => '10'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}
}
