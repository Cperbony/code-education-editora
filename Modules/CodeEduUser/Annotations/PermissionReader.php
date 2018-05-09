<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 27/11/2017
 * Time: 22:20
 */

namespace CodeEduUser\Annotations;

use CodeEduUser\Annotations\Mapping\Action;
use CodeEduUser\Annotations\Mapping\ControllerAnnotation;
use Doctrine\Common\Annotations\Reader;

class PermissionReader
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * PermissionReader constructor.
     * @param Reader $reader
     *
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function getPermissions()
    {
        $controllersClasses = $this->getControllers();
//        dd($controllersClasses);
        $declared = get_declared_classes();
        $permissions = [];
        foreach ($declared as $className) {
            $rc = new \ReflectionClass($className);
            if (in_array($rc->getFileName(), $controllersClasses)) {
                $permission = $this->getPermission($className);
                if (count($permission)) {
                    $permissions = array_merge($permissions, $permission);
                }
            }
        }
        return $permissions;
    }

    public function getPermission($controllerClass, $action = null)
    {
        $rc = new \ReflectionClass($controllerClass);
        /** @var ControllerAnnotation $controllerAnnotation */
        $controllerAnnotation = $this->reader->getClassAnnotation($rc, ControllerAnnotation::class);
        $permissions = [];
        if ($controllerAnnotation) {
            $permission = [
                'name' => $controllerAnnotation->name,
                'description' => $controllerAnnotation->description
            ];
            //Pegar todos os métodos do Controller
            $rcMethods = !$action ? $rc->getMethods() : [$rc->getMethod($action)];
            foreach ($rcMethods as $rcMethod) {
                /** @var Action $actionAnnotation */
                $actionAnnotation = $this->reader->getMethodAnnotation($rcMethod, Action::class);
                if ($actionAnnotation) {
                    $permission['resource_name'] = $actionAnnotation->name;
                    $permission['resource_description'] = $actionAnnotation->description;
                    $permissions[] = (new \ArrayIterator($permission))->getArrayCopy();
                }
            }
        }
        return $permissions;
    }

    /**
     * @return array
     */
    private function getControllers()
    {
        $dirs = config('codeeduuser.acl.controllers_annotations');
        $files = [];
        foreach ($dirs as $dir) {
            foreach (\File::allFiles($dir) as $file) {
//                echo $file;
                $files[] = $file->getRealPath();
                require_once $file->getRealPath();
            }
        }
        return $files;
    }
}