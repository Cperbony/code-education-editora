@inject('categoryRepository', 'CodeEduStore\Repositories\CategoryRepository')
<aside class="col-md-3">
    <a href="#" class="list-group-item disabled">Categorias</a>
    @foreach($categoryRepository->all() as $category)
        <a href="{{ route('store.category', ['category' => $category->id]) }}" class="list-group-item">{{$category->name}}</a>
    @endforeach
</aside>