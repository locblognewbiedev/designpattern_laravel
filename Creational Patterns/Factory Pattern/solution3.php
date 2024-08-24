<?php

interface Document
{
    public function generate();
}

class Report implements Document
{
    public function generate()
    {
        echo "Generating report document\n";
    }
}

class Manual implements Document
{
    public function generate()
    {
        echo "Generating manual document\n";
    }
}

class Contract implements Document
{
    public function generate()
    {
        echo "Generating contract document\n";
    }
}
class DocumentFactory
{
    public static function createDocument($type)
    {
        if (strcasecmp($type, 'report') == 0) {
            return new Report();
        } else if (strcasecmp($type, 'manual') == 0) {
            return new Manual();
        } else if (strcasecmp($type, 'contract') == 0) {
            return new Contract();
        }
        return null;
    }
}
$documents = ['report', 'manual', 'contract'];
foreach ($documents as $docType) {
    $document = DocumentFactory::createDocument($docType);
    if ($document) {
        $document->generate();
    }
}