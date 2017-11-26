<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Requests\RoleRequest;
use CodeEduUser\Repositories\RoleRepository;
use CodePub\Http\Controllers\Controller;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $repository;

    /**
     * RoleController constructor.
     * @param RoleRepository $repository
     */
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = $this->repository->orderBy('name')->paginate(10);
        return view('codeeduuser::roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('codeeduuser::roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return Response
     */
    public function store(RoleRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        return redirect()->to($url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->repository->find($id);
        return view('codeeduuser::roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(RoleRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Role Editada Com Sucesso!');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RoleRequest $request
     * @param  int $id
     * @return Response
     */
    public function destroy(RoleRequest $request, $id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Role Removida Com Sucesso!');
        return redirect()->to(\URL::previous());
    }
}
