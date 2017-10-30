<?php

namespace CodeEduBook\Http\Controllers;

use CodePub\Http\Controllers\Controller;
use CodeEduBook\Repositories\BookRepository;

use Illuminate\Http\Request;

class BooksTrashedController extends Controller
{
    /**
     * @var BookRepository
     */
    private $repository;

    /**
     * BooksController constructor.
     * @param BookRepository $repository
     */
    function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
//        $books = Book::onlyTrashed()->paginate(10);
        //$this->repository->pushCriteria(FindOnlyTrashedCriteria::class);
        $books = $this->repository->onlyTrashed()->orderBy('id', 'desc')->paginate(10);
        return view('codeedubook::trashed.books.index', compact('books', 'search'));
    }

    public function show($id)
    {
        $this->repository->onlyTrashed();
        $book = $this->repository->find($id);

        return view('codeedubook::trashed.books.show', compact('book'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->repository->onlyTrashed();
        $this->repository->restore($id);

        $url = $request->get('redirect_to', route('trashed.books.index'));
        $request->session()->flash('message', 'Livro Restaurado com Sucesso!');

        return redirect()->to($url);

    }

}
