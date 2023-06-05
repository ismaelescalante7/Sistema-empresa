<?php

namespace Database\Seeders;

use App\Models\Deposito;
use App\Models\Marca;
use App\Models\PlanCuenta;
use App\Models\RetencionIngresosBruto;
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
            CondicionIvaSeeder::class,
            RetencionIngresosBrutoSeeder::class,
            PlanCuentaSeeder::class,
            FormasPagosSeeder::class,
            RetencionIngresosBrutoSeeder::class,
            CondicionesPagoSeeder::class,
            RetencionGananciaSeeder::class,
            MedidaSeeder::class,
            MarcaSeeder::class,
            DepositoSeeder::class,
            RubroSeeder::class
        ]);
    }
}
