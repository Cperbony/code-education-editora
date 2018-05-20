<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Criteria\FindPermissionsGroupCriteria;
use CodeEduUser\Http\Requests\PermissionRequest;
use CodeEduUser\Http\Requests\RoleRequest;
use CodeEduUser\Repositories\PermissionRepository;
use CodeEduUser\Repositories\RoleRepository;
use CodeEduUser\Criteria\FindPermissionsResourceCriteria;
use CodePub\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use CodeEduUser\Annotations\Mapping as Permission;

/**
 * Class RolesController
 * @package CodeEduUser\Http\Controllers
 *
 * @Permission\Controller(name="roles-admin", description="Administração de papéis de usuários")
 */
class RolesController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $repository;
    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * RoleController constructor.
     * @param RoleRepository $repository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(RoleRepository $repository, PermissionRepository $permissionRepository)
    {
        $this->repository = $repository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @Permission\Action(name="list", description="Listar papeis de usuários")
     *
     * @return Response
     */
    public function index()
    {
        $roles = $this->repository->orderBy('name')->paginate(10);
        return view('codeeduuser::roles.index', compact('roles'));
    }

    /**
     * @Permission\Action(name="store", description="Cadastrar papéis de usuários")
     *
     * @return Response
     */
    public function create()
    {
        return view('codeeduuser::roles.create');
    }

    /**
     * @Permission\Action(name="store", description="Cadastrar papéis de usuários")
     *
     * @param RoleRequest $request
     * @return Response
     */
    public function store(RoleRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Papel de usuário cadastrado com sucesso');
        return redirect()->to($url);
    }

    /**
     * @Permission\Action(name="edit", description="Editar papéis de usuários")
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->repository->find($id);
        $this->permissionRepository->pushCriteria(new FindPermissionsResourceCriteria());
        $permissions = $this->permissionRepository->all();
        return view('codeeduuser::roles.edit', compact('role', 'permissions'));
    }

    /**
     * @Permission\Action(name="update", description="Atualizar papéis de usuários")
     *
     * @param RoleRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(RoleRequest $request, $id)
    {
        $data = $request->except('permissions');
        $this->repository->update($data, $id);
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Papel de Usuário Editado Com Sucesso!');
        return redirect()->to($url);
    }

    /**
     * @Permission\Action(name="destroy", description="Excluir papéis de usuários")
     *
     * @param RoleRequest $request
     * @param  int $id
     * @return Response
     */
    public function destroy(RoleRequest $request, $id)
    {
        try{
            $this->repository->delete($id);
            \Session::flash('message', 'Papel de usuário Removido Com Sucesso!');
        }catch (QueryException $ex) {
            \Session::flash('error', 'Papel de usuário não pode ser Removido. O mesmo esta relacionado com outros registros!');
        }
        return redirect()->to(\URL::previous());
    }

    public function editPermission($id) {
        $roles = $this->repository->find($id);

        $this->permissionRepository->pushCriteria(new FindPermissionsResourceCriteria());
        $permissions = $this->permissionRepository->all();

        $this->permissionRepository->resetCriteria();
        $this->permissionRepository->pushCriteria(new FindPermissionsGroupCriteria());
        $permissionsGroup = $this->permissionRepository->all(['name', 'description']);
        return view('codeeduuser::roles.permissions', compact('roles', 'permissions', 'permissionsGroup'));
    }

    public function updatePermission(PermissionRequest $request, $id) {
        $data = $request->only('permissions');
        $this->repository->update($data, $id);
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Permissões atribuídas com Sucesso!');
        return redirect()->to($url);
    }
}
