<?php

use Illuminate\Database\Seeder;

use App\Entity\{Attribute};

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attrs = [
            ['name' => 'size', 'value' => 's'],
            ['name' => 'size', 'value' => 'm'],
            ['name' => 'size', 'value' => 'l'],
            ['name' => 'size', 'value' => 'xl'],
            ['name' => 'size', 'value' => 'xxl'],
            ['name' => 'color', 'value' => 'white'],
            ['name' => 'color', 'value' => 'grey'],
            ['name' => 'color', 'value' => 'black'],
            ['name' => 'color', 'value' => 'blue'],
            ['name' => 'color', 'value' => 'red'],
            ['name' => 'color', 'value' => 'yellow'],
            ['name' => 'color', 'value' => 'orange'],
            ['name' => 'color', 'value' => 'brown'],
            ['name' => 'color', 'value' => 'green'],
            ['name' => 'color', 'value' => 'violet'],
        ];

        foreach($attrs as $attr){
            $attribute = new Attribute($attr);
            $attribute->save();
        }
    }
}
