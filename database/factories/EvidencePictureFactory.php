<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EvidencePicture;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EvidencePicture>
 */
class EvidencePictureFactory extends Factory
{
    protected $model = EvidencePicture::class;

    public function definition(): array
    {
        // Obtener IDs de órdenes existentes
        $orderIds = DB::table('customer_orders')->pluck('id')->toArray();
        
        $orderId = !empty($orderIds) ? $this->faker->randomElement($orderIds) : 2;
        
        return [
            'order_id' => $orderId,
            'sent_photo_url' => $this->faker->imageUrl(),
            'received_photo_url' => $this->faker->imageUrl(),
            'sent_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'received_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'uploaded_by' => $this->faker->name,
        ];
    }
}