<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Annotations\Mapping as Permission;
use CodeEduUser\Http\Requests\UserDeleteRequest;
use CodeEduUser\Http\Requests\UserRequest;
use CodeEduUser\Repositories\RoleRepository;
use CodeEduUser\Repositories\UserRepository;
use Illuminate\Http\Request;

/**
 * Class UsersController
 * @package CodeEduUser\Http\Controllers
 *
 * @Permission\Controller(name="users-admin", description="Administração de Usuários")
 */
class UsersController extends Controller
{
    /**
     * @var \CodeEduUser\Repositories\UserRepository
     */
    private $repository;
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * CategoriesController constructor.
     * @param \CodeEduUser\Repositories\UserRepository $repository
     * @param RoleRepository $roleRepository
     */
    public function __construct(UserRepository $repository, RoleRepository $roleRepository)
    {
        $this->repository = $repository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * @Permission\Action(name="list", description="Ver Listagem de usuários")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
//        $this->repository->pushCriteria(new FindByTitleCriteria($search));
        $users = $this->repository->orderBy('id', 'desc')->paginate(10);
        return view('codeeduuser::users.index', compact('users', 'search'));
    }


    /**
     * @Permission\Action(name="create", description="Criar usuários")
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleRepository->all()->pluck('name', 'id');
        return view('codeeduuser::users.create', compact('roles'));
    }

    /**
     * @Permission\Action(name="store", description="Criar usuários")
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $this->repository->create($data);
        $url = $request->get('redirect_to', route('codeeduuser.users.index'));
        $request->session()->flash('message', 'Usuário Cadastrado com Sucesso!');

        return redirect()->to($url);
    }


    /**
     * @Permission\Action(name="edit", description="Editar usuários")
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit($id)
    {
        $user = $this->repository->find($id);
        $roles = $this->roleRepository->all()->pluck('name', 'id');
        return view('codeeduuser::users.edit', compact('user', 'roles'));
    }

    /**
     * @Permission\Action(name="update", description="Atualizar usuários")
     *
     * @param UserRequest|Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->except(['password']);
        $this->repository->update($data, $id);
        $url = $request->get('redirect_to', route('codeeduuser.users.index'));
        $request->session()->flash('message', 'Usuário Atualizado com Sucesso!');

        return redirect()->to($url);
    }


    /**
     * @Permission\Action(name="destroy", description="Remover usuários")
     *
     * @param UserDeleteRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(UserDeleteRequest $request, $id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Usuário removido com sucesso.');

        return redirect()->to(\URL::previous());
    }
}
