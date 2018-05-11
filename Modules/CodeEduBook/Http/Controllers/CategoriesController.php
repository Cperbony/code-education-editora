<?php

namespace CodeEduBook\Http\Controllers;

use CodeEduUser\Annotations\Mapping as Permission;
use CodeEduBook\Http\Requests\CategoryRequest;
use CodeEduBook\Repositories\CategoryRepository;
use Illuminate\Http\Request;

/**
 * Class CategoriesController
 * @package CodeEduBook\Http\Controllers
 *
 * @Permission\Controller(name="categories-admin", description="Administração de Categorias")
 */
class CategoriesController extends Controller
{

    /**
     * @var \CodeEduBook\Repositories\CategoryRepository
     */
    private $repository;

    /**
     * CategoriesController constructor.
     * @param \CodeEduBook\Repositories\CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {

        $this->repository = $repository;
    }

    /**
     * @Permission\Action(name="list", description="Listar Categorias")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
//        $this->repository->pushCriteria(new FindByTitleCriteria($search));
        $categories = $this->repository->orderBy('id', 'desc')->paginate(10);
        return view('codeedubook::categories.index', compact('categories', 'search'));
    }

    /**
     * @Permission\Action(name="create", description="Criar Categorias")
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeedubook::categories.create');
    }

    /**
     * @Permission\Action(name="store", description="Criar Categorias")
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $this->repository->create($data);
        $url = $request->get('redirect_to', route('categories.index'));
        $request->session()->flash('message', 'Categoria Cadastrada com Sucesso!');

        return redirect()->to($url);
    }

      /**
     * @Permission\Action(name="edit", description="Editar Categorias")
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit($id)
    {
        $category = $this->repository->find($id);
        return view('codeedubook::categories.edit', compact('category'));
    }

    /**
     * @Permission\Action(name="update", description="Atualizar Categorias")
     *
     * @param CategoryRequest|Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(CategoryRequest $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);
        $url = $request->get('redirect_to', route('categories.index'));
        $request->session()->flash('message', 'Categoria Atualizada com Sucesso!');

        return redirect()->to($url);
    }

    /**
     * @Permission\Action(name="delete", description="Remover Categorias")
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Categoria removida com sucesso.');

        return redirect()->to(\URL::previous());
    }
}
