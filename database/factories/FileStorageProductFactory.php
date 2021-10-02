<?php

namespace Database\Factories;

use App\Models\FileStorageProduct;
use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileStorageProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FileStorageProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'relation' => "products",
            'relation_id' => function () {
                return (new Products())->factory()->create()->id;
            },
            'status' => 'N',
            'ext' => 'jpg',
            'size' => $this->faker->numberBetween(2,200),
            'path' => $this->faker->imageUrl,
        ];
    }
}
