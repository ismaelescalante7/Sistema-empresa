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
        // Configuracion
        'Tipos Comprobantes' => [
            [
                'name' => 'tipos.comprobantes.index',
                'description' => 'Consulta de Tipos Comprobantes',
                'roles' => ['ADM'],
            ]
        ],

        'Condiciones Ivas' => [
            [
                'name' => 'condiciones.ivas.index',
                'description' => 'Consulta de Condiciones Ivas',
                'roles' => ['ADM'],
            ]
        ],

        // Productos
        'productos' => [
            [
                'name' => 'productos.index',
                'description' => 'Consulta de Productos',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'productos.create',
                'description' => 'Consulta de Productos',
                'roles' => ['ADM'],
            ],
        ],
        // Clientes
        'clientes' => [
            [
                'name' => 'clientes.index',
                'description' => 'Consulta de Clientes',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'clientes.create',
                'description' => 'Consulta de Clientes',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'clientes.show',
                'description' => 'Ver Cliente',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'clientes.edit',
                'description' => 'Modificar Cliente',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'clientes.destroy',
                'description' => 'Eliminar Cliente',
                'roles' => ['ADM'],
            ]
        ],
        // Usuarios
        'users' => [
            [
                'name' => 'users.index',
                'description' => 'Consulta de usuarios',
                'roles' => ['ADM']
            ],
            [
                'name' => 'users.create',
                'description' => 'Crear usuario',
                'roles' => ['ADM']
            ],
            [
                'name' => 'users.edit',
                'description' => 'Modificar usuario',
                'roles' => ['ADM']
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
