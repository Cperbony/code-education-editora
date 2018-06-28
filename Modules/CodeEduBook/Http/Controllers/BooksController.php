<?php

namespace CodeEduBook\Http\Controllers;

use CodeEduBook\Criteria\FindByAuthor;
use CodeEduBook\Http\Requests\BookCoverRequest;
use CodeEduBook\Jobs\GenerateBook;
use CodeEduBook\Models\Book;
use CodeEduBook\Notifications\BookExported;
use CodeEduBook\Pub\BookCoverUpload;
//use CodeEduBook\Pub\BookExport;
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


    /**
     * @Permission\Action(name="cover", description="Cover de Livros")
     * @param Book $book
     * @return \Illuminate\Http\Response* @internal param int $id
     */
    public function coverForm(Book $book)
    {
        return view('codeedubook::books.cover', compact('book'));
    }

    /**
     * @Permission\Action(name="cover", description="Cover de Livros")
     * @param BookCoverRequest $request
     * @param Book $book
     * @param BookCoverUpload $upload
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function coverStore(BookCoverRequest $request, Book $book, BookCoverUpload $upload)
    {
        $upload->upload($book, $request->file('file'));

        $url = $request->get('redirect_to', route('books.index'));
        $request->session()->flash('message', 'Cover Adicionado com Sucesso!');
        return redirect()->to($url);
    }

    /**
     * @param Book $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function export(Book $book)
    {
//        $bookExport = app(BookExport::class);
//        $bookExport->export($book);
//        $bookExport->compress($book);
//        dispatch(new GenerateBook($book));
        $user = \Auth::user();
        $user->notify(new BookExported($user, $book));

        \Session::flash('message', "O Livro {$this->book->title} foi exportado com Sucesso!");
        return redirect()->route('books.index');
    }

    public function download(Book $book)
    {
        return response()->download($book->zip_file);
    }
}
