<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 03/06/2018
 * Time: 23:04
 */

namespace CodeEduBook\Models;


trait BookStorageTrait
{

    public function getDiskAttribute()
    {
        $bookStorageDriver = config('codeedubook.book_storage');
        return config("filesystems.disks.{$bookStorageDriver}.root");
    }

    public function getBookStorageAttribute()
    {
        return "{$this->disk}/{$this->id}";
    }

    public function getCoverEbookNameAttribute()
    {
        return 'cover.jpg';
    }

    public function getEbookTemplateAttribute()
    {
        return "{$this->id}/Resources/Templates/ebook";
    }

    public function getCoverEbookFileAttribute()
    {
        return "{$this->disk}/{$this->ebook_template}/{$this->cover_ebook_name}";
    }

    public function getCoverPdfNameAttribute()
    {
        return 'cover.pdf';
    }

    public function getPdfTemplateAttribute()
    {
        return "{$this->id}/Resources/Templates/pdf";
    }

    public function getPdfTemplateStorageAttribute()
    {
        return "{$this->disk}/{$this->pdf_template}";
    }

    public function getCoverPdfFileAttribute()
    {
        return "{$this->pdf_template_storage}/{$this->cover_pdf_name}";
    }
}