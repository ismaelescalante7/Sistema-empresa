<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesSeeder::class,
            PermissionsSeeder::class,
            UsersSeeder::class,
            ProvinciaSeeder::class,
            DepartamentoSeeder::class,
            LocalidadSeeder::class,
            TipoDocumentoSeeder::class,
            ClienteSeeder::class,
            CategoriaSeeder::class,
            TipoComprobanteSeeder::class,
            CondicionIvaSeeder::class
        ]);
    }
}
