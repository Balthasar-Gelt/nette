<?php

declare(strict_types=1);

namespace App\Storage;

class XMLStorageManager
{
    public function __construct(
        private string $filePath
    ) {}

    /**
     * Loads the XML data from the file.
     *
     * If the file does not exist, creates a new XML document with a root element `<pets/>` and saves it.
     *
     * @return \SimpleXMLElement The loaded XML data.
     */
    public function load(): \SimpleXMLElement
    {
        if (!file_exists($this->filePath)) {
            $xml = new \SimpleXMLElement('<pets/>');
            $this->save($xml);
        }
        return simplexml_load_file($this->filePath);
    }

    /**
     * Saves the provided XML data to the file.
     *
     * @param \SimpleXMLElement $xmlData The XML data to save.
     * @return void
     */
    public function save(\SimpleXMLElement $xmlData): void
    {
        $xmlData->asXML($this->filePath);
    }
}
