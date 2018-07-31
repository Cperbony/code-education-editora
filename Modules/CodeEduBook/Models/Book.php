<?php

namespace CodeEduBook\Models;

use Bootstrapper\Interfaces\TableInterface;
use CodeEduBook\Events\BookPreIndexEvent;
use CodeEduUser\Models\User;
use Collective\Html\Eloquent\FormAccessible;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property mixed author_id
 */
class Book extends Model implements TableInterface
{
    use TransformableTrait;
    use FormAccessible;
    use SoftDeletes;
    use BookStorageTrait;
    use BookThumbnailTrait;
    use Sluggable;
    use SluggableScopeHelpers;
    use Searchable;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'subtitle',
        'price',
        'author_id',
        'dedication',
        'description',
        'website',
        'percent_complete',
        'published'
    ];

//    public function searchable()
//    {
//        return 'meu Indíce de Livros';
//    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        //Disparar um evento
        //Neste evento, teremos um ouvinte que tomará uma ação
        $event = new BookPreIndexEvent($this);
        event($event);

        $array = array_merge($array, ['ranking' => $event->getRanking()]);
        return $array;

        //Retornar apenas o titulo na pesquisa
//        return [
//            'title' => $this->title
//        ];
    }

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
        return $this->belongsToMany(Category::class)->withTrashed();
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function formCategoriesAttribute()
    {
        return $this->categories->pluck('id')->all();

    }

    public function formCategoriesNameAttribute()
    {
        return $this->categories->pluck('name');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Autor', 'Título', 'Subtítulo', 'Preço', 'Categorias'];
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
                if (file_exists($this->zip_file)) {
                    $route = route('books.download', ['id' => $this->id]);
                    return "<a href=\"{$route}\" target=\"_blank\">{$this->title}</a>";
                } else {
                    return $this->title;
                }
            case 'Subtítulo':
                return $this->subtitle;
            case 'Preço':
                return $this->price;
            case 'Categorias':
                return $this->formCategoriesNameAttribute();
            // return $this->categories()->pluck('name');
        }
    }
}
