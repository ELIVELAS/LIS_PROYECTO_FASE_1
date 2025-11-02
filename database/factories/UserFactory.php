<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * Ajustado a tu esquema: firstname, lastname, email, password, user_type_id.
     */
    public function definition(): array
    {
        return [
            'firstname'    => $this->faker->firstName(),
            'lastname'     => $this->faker->lastName(),
            'email'        => $this->faker->unique()->safeEmail(),
            'password'     => static::$password ??= Hash::make('password'), // clave "password"
            'user_type_id' => $this->faker->randomElement([1, 2, 3]),       // 1=Admin, 2=Empresa, 3=Cliente
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
    }

    /**
     * Estado para crear un Admin real con credenciales conocidas.
     */
    public function admin(): static
    {
        return $this->state(fn () => [
            'firstname'    => 'Admin',
            'lastname'     => 'Principal',
            'email'        => 'admin@demo.test',
            'password'     => Hash::make('admin123'),
            'user_type_id' => 1,
        ]);
    }

    /**
     * Estado para Empresa.
     */
    public function empresa(): static
    {
        return $this->state(fn () => [
            'firstname'    => 'Empresa',
            'lastname'     => 'Demo',
            'email'        => 'empresa@demo.test',
            'password'     => Hash::make('empresa123'),
            'user_type_id' => 2,
        ]);
    }

    /**
     * Estado para Cliente.
     */
    public function cliente(): static
    {
        return $this->state(fn () => [
            'firstname'    => 'Cliente',
            'lastname'     => 'Demo',
            'email'        => 'cliente@demo.test',
            'password'     => Hash::make('cliente123'),
            'user_type_id' => 3,
        ]);
    }
}
