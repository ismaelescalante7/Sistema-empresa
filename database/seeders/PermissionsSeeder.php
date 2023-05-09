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

        'administracion' => [
            // Productos
            [
                'name' => 'consulta_productos',
                'title' => 'Consulta de Productos',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'crear_producto',
                'title' => 'Consulta de Productos',
                'roles' => ['ADM'],
            ],

            // Usuarios
            [
                'name' => 'consulta_usuarios',
                'title' => 'Usuarios',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'crear_usuario',
                'title' => 'Crear Usuarios',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'modificar_usuario',
                'title' => 'Modificar Usuarios',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'ver_usuario',
                'title' => 'Ver Usuarios',
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
