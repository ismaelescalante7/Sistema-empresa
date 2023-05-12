<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    protected $permissions = [
        // Productos
        'productos' => [
            [
                'name' => 'consulta_productos',
                'description' => 'Consulta de Productos',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'crear_producto',
                'description' => 'Consulta de Productos',
                'roles' => ['ADM'],
            ],
        ],
        // Usuarios
        'usuarios' =>  [
            [
                'name' => 'consulta_usuarios',
                'description' => 'Usuarios',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'crear_usuario',
                'description' => 'Crear Usuarios',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'modificar_usuario',
                'description' => 'Modificar Usuarios',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'ver_usuario',
                'description' => 'Ver Usuarios',
                'roles' => ['ADM'],
            ],
        ],
        // Roles
        'roles' => [
            [
                'name' => 'roles.index',
                'description' => 'Consulta de roles',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'roles.create',
                'description' => 'Crear rol',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'roles.edit',
                'description' => 'Modificar rol',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'roles.destroy',
                'description' => 'Eliminar rol',
                'roles' => ['ADM'],
            ],
        ],
        // Permisos
        'permissions' => [
            [
                'name' => 'roles.permissions.index',
                'description' => 'Consulta de permisos',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'roles.permissions.edit',
                'description' => 'Modificar permiso',
                'roles' => ['ADM'],
            ],
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->permissions)->each(function ($abilities, $group) {
            foreach ($abilities as $ability) {
                $permission = Permission::forceCreate(
                    Arr::except($ability, ['roles'])
                );

                foreach ($ability['roles'] as $rol) {
                    Role::findByName($rol)->givePermissionTo($permission);
                }
            }
        });
    }
}
