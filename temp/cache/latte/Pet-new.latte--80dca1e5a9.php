<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: C:\laragon\www\nette_zadanie\app\UI\Pet/new.latte */
final class Template_80dca1e5a9 extends Latte\Runtime\Template
{
	public const Source = 'C:\\laragon\\www\\nette_zadanie\\app\\UI\\Pet/new.latte';

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

		echo '    <h1>Add New Pet</h1>

    <form action="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 4 */;
		echo '/pet" method="post">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required>
        </div>

        <div>
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="available">Available</option>
                <option value="pending">Pending</option>
                <option value="sold">Sold</option>
            </select>
        </div>

        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image">
        </div>

        <button type="submit">Add Pet</button>
    </form>

    <a class="add-link" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Pet:list')) /* line 32 */;
		echo '">Back to list</a>
';
	}
}
