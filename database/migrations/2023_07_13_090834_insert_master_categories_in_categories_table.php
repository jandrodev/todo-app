<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $masterCategories = [
            [
                'name' => Category::PHP_CATEGORY,
            ],
            [
                'name' => Category::JS_CATEGORY,
            ],
            [
                'name' => Category::CSS_CATEGORY,
            ],
            [
                'name' => Category::OTHERS_CATEGORY,
            ]
        ];

        foreach ($masterCategories as $masterCategory) {
            Category::create($masterCategory);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Category::whereIn('name', Category::$masterCategories)->delete();
    }
};
