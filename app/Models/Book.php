<?php

namespace CodePub\Models;

use Bootstrapper\Interfaces\TableInterface;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Traits\TransformableTrait;

class Book extends Model implements TableInterface
{
    use TransformableTrait;
    use FormAccessible;

    protected $fillable = [
        'title',
        'subtitle',
        'price',
        'author_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function formCategoriesAttribute() {
        return $this->categories->pluck('id')->all();

}

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Autor', 'Título', 'Subtítulo', 'Preço'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header) {
            case '#':
                return $this->id;
            case 'Autor':
                return $this->author->name;
            case 'Título':
                return $this->title;
            case 'Subtítulo':
                return $this->subtitle;
            case 'Preço':
                return $this->price;
        }
    }
}
