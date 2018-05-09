<?php

namespace CodeEduUser\Console;

use CodeEduUser\Facade\PermissionReader;
use CodeEduUser\Repositories\PermissionRepository;
use Illuminate\Console\Command;

class CreatePermissionCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'codeeduuser:make-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criação de permissões baseado em controllers e actions';
    /**
     * @var PermissionRepository
     */
    private $repository;
    /**
     * @var PermissionReader
     */
    private $reader;

    /**
     * Create a new command instance.
     *
     * @param PermissionRepository $repository
     * @param PermissionReader $reader
     */
    public function __construct(PermissionRepository $repository, PermissionReader $reader)
    {
        parent::__construct();
        $this->repository = $repository;
        $this->reader = $reader;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $permissions = $this->reader::getPermissions();
        foreach ($permissions as $permission) {
            if (!$this->existsPermission($permission)){
            $this->repository->create($permission);
        }
            //name, description, resource_name, resource_description
        }
        $this->info("<info>Permissões Carregadas</info>");
    }

    private function existsPermission($permission)
    {
        $permission = $this->repository->findWhere([
            'name' => $permission['name'],
            'resource_name' => $permission['resource_name']
        ])->first();
        return $permission != null;
    }
}
