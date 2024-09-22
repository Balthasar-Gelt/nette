<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\laragon\www\nette_zadanie\app\Components\Pet\Grid/default.latte */
final class Template_a57796572b extends Latte\Runtime\Template
{
	public const Source = 'C:\\laragon\\www\\nette_zadanie\\app\\Components\\Pet\\Grid/default.latte';


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		echo '<form method="post" id="deleteForm" style="display: none;" onsubmit="return confirm(\'Are you sure you want to delete this pet?\');">
</form>

<h1>Pet List</h1>

<p><a class="add-link" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link('Pet:add')) /* line 6 */;
		echo '">Add New Pet</a></p>
<p>
    <span>Filter:</span>
    <a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link('Pet:list', ['status' => 'all'])) /* line 9 */;
		echo '">All</a>
    <a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link('Pet:list', ['status' => 'available'])) /* line 10 */;
		echo '">Available</a>
    <a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link('Pet:list', ['status' => 'pending'])) /* line 11 */;
		echo '">Pending</a>
    <a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link('Pet:list', ['status' => 'sold'])) /* line 12 */;
		echo '">Sold</a>
</p>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Image</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
';
		foreach ($pets as $pet) /* line 25 */ {
			echo '        <tr>
            <td>';
			echo LR\Filters::escapeHtmlText($pet->getName()) /* line 27 */;
			echo '</td>
            <td>';
			echo LR\Filters::escapeHtmlText($pet->getCategory()) /* line 28 */;
			echo '</td>
            <td>
            <img src="';
			echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 30 */;
			echo '/';
			echo LR\Filters::escapeHtmlAttr($pet->getImage()) /* line 30 */;
			echo '" alt="Pet Image"></td>
            <td>';
			echo LR\Filters::escapeHtmlText($pet->getStatus()) /* line 31 */;
			echo '</td>
            <td>
                <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link('Pet:edit', ['id' => $pet->getId()])) /* line 33 */;
			echo '">Edit</a>
                <button class="btn-link-as-link" form="deleteForm" formaction="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('delete!', [$pet->getId()])) /* line 34 */;
			echo '">delete</button>
            </td>
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
			foreach (array_intersect_key(['pet' => '25'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}
}
