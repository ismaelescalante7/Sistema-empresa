<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->text(10),
            'nombre' => $this->faker->word(),
            'categoria_id' => null,
            'precio_compra' =>  $this->faker->numberBetween(1000, 2000),
            'precio_venta' => $this->faker->numberBetween(1000, 2000),
            'stock_minimo' => $this->faker->numberBetween(50, 200),
            'alicuota' => $this->faker->numberBetween(1,100),
            'estado' => $this->faker->randomElement(['activo', 'pasivo']),
            'marca_id' => 1,
            'rubro_id' => 1,
            'compra' => $this->faker->boolean(),
            'vende' => $this->faker->boolean(),
            'stockeable' => $this->faker->boolean(),
            'retencion_ganancia_id' => 1,
            'retencion_ingreso_bruto_id' => 1
        ];
    }
}
