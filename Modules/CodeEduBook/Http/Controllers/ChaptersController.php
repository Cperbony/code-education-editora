<?php

namespace CodeEduBook\Http\Controllers;

use CodeEduBook\Criteria\FindByAuthor;
use CodeEduBook\Criteria\FindByBook;
use CodeEduBook\Criteria\OrderByOrder;
use CodeEduBook\Http\Requests\ChapterCreateRequest;
use CodeEduBook\Http\Requests\ChapterUpdateRequest;
use CodeEduBook\Models\Book;
use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Repositories\ChapterRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CodeEduUser\Annotations\Mapping as Permission;


/**
 * Class ChapterController
 * @package CodeEduBook\Http\Controllers
 *
 * @Permission\Controller(name="book-admin", description="Administração de Livros")
 */
class ChaptersController extends Controller
{
    /**
     * @var ChapterRepository
     */
    private $repository;
    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * BooksController constructor.
     * @param ChapterRepository $repository
     *
     * @param BookRepository $bookRepository
     */
    function __construct(ChapterRepository $repository, BookRepository $bookRepository)
    {
        $this->repository = $repository;
        $this->bookRepository = $bookRepository;
        $this->bookRepository->pushCriteria(new FindByAuthor());
    }

    /**
     * @Permission\Action(name="chapter", description="Capítulos")
     *
     * @param Request $request
     * @param Book $book
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Book $book)
    {
        $search = $request->get('search');

        $this->repository->pushCriteria(new FindByBook($book->id))
            ->pushCriteria(new OrderByOrder());

        $chapters = $this->repository->paginate(10);

        return view('codeedubook::chapters.index', compact('chapters', 'search', 'book'));
    }

    /**
     * @Permission\Action(name="create", description="Cadastrar Capítulos")
     *
     * @param Book $book
     * @return \Illuminate\Http\Response
     */
    public function create(Book $book)
    {
        return view('codeedubook::chapters.create', compact('book'));
    }

    /**
     * @Permission\Action(name="create", description="Cadastrar Capítulos")
     *
     * @param ChapterCreateRequest $request
     * @param Book $book
     * @return \Illuminate\Http\Response
     */
    public function store(ChapterCreateRequest $request, Book $book)
    {
        $data = $request->all();
        $data['book_id'] = $book->id;
        $this->repository->create($data);
        $url = $request->get('redirect_to', route('chapters.index', ['book' => $book->id]));
        $request->session()->flash('message', 'Capítulo Cadastrado com Sucesso!');

        return redirect()->to($url);
    }

    /**
     * @Permission\Action(name="edit", description="Editar Livros")
     *
     * @param Book $book
     * @param $chapterId
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book, $chapterId)
    {
        $this->repository->pushCriteria(new FindByBook($book->id));
        $chapter = $this->repository->find($chapterId);

        return view('codeedubook::chapters.edit', compact('chapter', 'book'));
    }

    /**
     * @Permission\Action(name="update", description="Atualizar Capítulos")
     *
     * @param ChapterUpdateRequest $request
     * @param Book $book
     * @param $chapterId
     * @return \Illuminate\Http\Response
     * @internal param Book $book
     * @internal param int $id
     */
    public function update(ChapterUpdateRequest $request, Book $book, $chapterId)
    {
        $this->repository->pushCriteria(new FindByBook($book->id));
        $data = $request->except(['book_id']);
        $this->repository->update($data, $chapterId);
        $url = $request->get('redirect_to', route('chapters.index', ['book' => $bookId]));
        $request->session()->flash('message', 'Capítulo Atualizado com Sucesso!');

        return redirect()->to($url);
    }

    /**
     * @Permission\Action(name="delete", description="Remover Capítulos")
     * @param Book $book
     * @return \Illuminate\Http\Response* @internal param int $id
     */
    public function destroy(Book $book, $chapterId)
    {
        $this->repository->pushCriteria(new FindByBook($book->id));
        $this->repository->delete($chapterId);
        \Session::flash('message', 'Capítulo excluído com sucesso.');

        return redirect()->to(\URL::previous());
    }
}
