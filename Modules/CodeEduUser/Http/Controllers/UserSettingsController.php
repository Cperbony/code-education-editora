<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 01/11/2017
 * Time: 23:46
 */

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Requests\UserSettingRequest;
use CodeEduUser\Repositories\UserRepository;

class UserSettingsController extends Controller
{

    /**
     * @var \CodeEduUser\Repositories\UserRepository
     */
    private $repository;

    /**
     * CategoriesController constructor.
     * @param UserRepository|\CodeEduUser\Repositories\UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {

        $this->repository = $repository;
    }

    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\Http\Response
     * @internal param $id
     * @internal param int $id
     */
    public function edit()
    {
        $user = \Auth::user();
        return view('codeeduuser::user-settings.setting', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param UserSettingRequest $request
     * @return \Illuminate\Http\Response
     * @internal param $id
     * @internal param int $id
     */
    public function update(UserSettingRequest $request)
    {
        $user = \Auth::user();
        $this->repository->update($request->all(), $user->id );
        $request->session()->flash('message', 'Usuário Atualizado com Sucesso!');

        return redirect()->route('codeeduuser.user_settings.edit');
    }
}