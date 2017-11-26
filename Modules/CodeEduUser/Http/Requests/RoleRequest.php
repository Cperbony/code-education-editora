<?php

namespace CodeEduUser\Http\Requests;

use CodeEduUser\Repositories\RoleRepository;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * @var RoleRepository
     */
    private $repository;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @param RoleRepository $repository
     */

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function authorize()
    {
        $role = $this->repository->findByField('name', config('codeeduuser.acl.role_admin'))->first();
        return $this->route('role') != $role->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('role');
        $method = mb_strtoupper($this->getMethod());

        if (in_array($method, ['POST', 'PUT'])) {
            return [
                'name' => "required|max:255|unique:roles,name,{$id}",
                'description' => 'max:255'
            ];
        }
        return [];
    }
}
