<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialDriverLandingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            ['post_type'=>'blog','link'=>'#','link_name'=>'{"en":"Learn more"}','title'=>'{"en":"Los mejores conductores y compañías de taxis."}', 'description'=>'{"en":"Nos hemos asociado con más de 560 compañías de taxis líderes y conductores individuales para ofrecerle la mejor experiencia posible. Encontrar tu taxi ahora es mucho más fácil. "}', 'image'=>'https://i.imgur.com/JrkHJ9x.jpg'],
            ['post_type'=>'blog','link'=>'#','link_name'=>'{"en":"Request taxi now"}','title'=>'{"en":"Hacer que el taxi sea más social"}', 'description'=>'{"en":"Estamos cambiando la forma en que funcionan los taxis. Acercándolo a sus clientes. Solicitar un taxi vía whatsapp, sencillo para ambos lados."}', 'image'=>'https://i.imgur.com/R7Oe2AB.jpg'],
            ['post_type'=>'faq','title'=>'{"en":"How i get paid?"}', 'description'=>'{"en":"El cliente puede pagarte al final del viaje en efectivo o con carrito, PayPal o MercadoPago"}'],
            ['post_type'=>'faq','title'=>'{"en":"Can I reject requested ride?"}', 'description'=>'{"en":"Sí, puede rechazar el viaje según sus preferencias. El cliente será informado"}'],
            ['post_type'=>'faq','title'=>'{"en":"I am individual driver. Can I use the Company plan?"}', 'description'=>'{"en":"Sí, puede suscribirse a cualquier plan ofrecido."}'],
        ];

        foreach ($posts as $key => $post) {
            DB::table('posts')->insert([
                'post_type' => $post['post_type'],
                'subtitle' => isset($post['subtitle'])?$post['subtitle']:"",
                'title' => $post['title'],
                'description' => $post['description'],
                'link' => isset($post['link'])?$post['link']:"",
                'link_name' => isset($post['link_name'])?$post['link_name']:"",
                'image' =>  isset($post['image'])?$post['image']:"",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


    }
}
