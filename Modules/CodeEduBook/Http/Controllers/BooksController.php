<?php

namespace CodeEduBook\Http\Controllers;

use CodeEduBook\Criteria\FindByAuthor;
use CodeEduBook\Models\Book;
use CodeEduUser\Annotations\Mapping as Permission;
use CodeEduBook\Http\Requests\BookCreateRequest;
use CodeEduBook\Http\Requests\BookUpdateRequest;
use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Repositories\CategoryRepository;
use Illuminate\Http\Request;

/**
 * Class BooksController
 * @package CodeEduBook\Http\Controllers
 *
 * @Permission\Controller(name="book-admin", description="Administração de Livros")
 */
class BooksController extends Controller
{
    /**
     * @var \CodeEduBook\Repositories\BookRepository
     */
    private $repository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * BooksController constructor.
     * @param BookRepository $repository
     * @param \CodeEduBook\Repositories\CategoryRepository $categoryRepository
     */
    function __construct(BookRepository $repository, CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->repository->pushCriteria(new FindByAuthor());
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Permission\Action(name="list", description="Ver Listagem de Livros")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $searchCategories = $request->get('searchCategories');
        //$this->repository->pushCriteria(new FindByTitleCriteria($search));
        $books = $this->repository->orderBy('id', 'desc')->paginate(10);
        $categories = $this->repository->withTrashed();
        return view('codeedubook::books.index', compact('books', 'categories', 'search', 'searchCategories'));
    }

    /**
     * @Permission\Action(name="create", description="Cadastrar Livros")
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->lists('name', 'id'); //Pluck
        return view('codeedubook::books.create', compact('categories'));
    }

    /**
     * @Permission\Action(name="create", description="Cadastrar Livros")
     *
     * @param BookCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookCreateRequest $request)
    {
        $data = $request->all();
        $data['author_id'] = \Auth::user()->id;
        $this->repository->create($data);
        $url = $request->get('redirect_to', route('books.index'));
        $request->session()->flash('message', 'Livro Cadastrado com Sucesso!');

        return redirect()->to($url);
    }

    /**
     * @Permission\Action(name="edit", description="Editar Livros")
     *
     * @param Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
//        $book = $this->repository->find($id);
        $this->categoryRepository->withTrashed();
//        $categories = Category::withTrashed()->pluck('name', 'id');
        $categories = $this->categoryRepository->listsWithMutators('name_trashed', 'id');
        return view('codeedubook::books.edit', compact('book', 'categories'));
    }

    /**
     * @Permission\Action(name="update", description="Atualizar Livros")
     *
     * @param BookUpdateRequest $request
     * @param Book $book
     * @return \Illuminate\Http\Response
     * @internal param Book $book
     * @internal param int $id
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        $data = $request->except(['author_id']);
        $data['published'] = $request->get('published', false);
        $this->repository->update($data, $book->id);
        $url = $request->get('redirect_to', route('books.index'));
        $request->session()->flash('message', 'Livro Atualizado com Sucesso!');

        return redirect()->to($url);
    }

    /**
     * @Permission\Action(name="delete", description="Remover Livros")
     * @param Book $book
     * @return \Illuminate\Http\Response* @internal param int $id
     */
    public function destroy(Book $book)
    {
        $this->repository->delete($book->id);
        \Session::flash('message', 'Livro excluído com sucesso.');

        return redirect()->to(\URL::previous());
    }
}
