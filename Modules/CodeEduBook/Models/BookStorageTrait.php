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

    public function getConfigFileAttribute(){
        return "{$this->book_storage}/config.yml";
    }

    public function getTemplateConfigFileAttribute(){
        return "{$this->disk}/template/config.yml";
    }

    public function getContentsStorageAttribute()
    {
        return "{$this->book_storage}/Contents";
    }

    public function getOutputStorageAttribute()
    {
        return "{$this->book_storage}/Output";
    }

    public function getZipFileAttribute()
    {
        $titleSlug = str_slug($this->title,'-');
        return "{$this->book_storage}/book-$titleSlug.zip";
    }
}