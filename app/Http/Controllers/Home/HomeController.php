<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
Use App\Models\User;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index(): Response
    {
        $user = DB::table('users')->where('id',2)->get();

        return Inertia::render('home/Home',[
            'titulo' => 'Minha Página Inicial',
            'description' => 'Associação Brasileira de Mantenedoras',
            'user' => $user,
        ]);
    }

    public function sobre(): Response
    {
        return Inertia::render('home/Sobre',[
            'conteudo'=> "Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit eveniet ea asperiores numquam magni laudantium vel rerum consequatur maiores, labore quidem obcaecati eum, doloribus, ad laborum reprehenderit! Nihil, molestias suscipit!",
        ]);
    }

    public function contato(): Response
    {
        return Inertia::render('home/Contato', [
            'celular' => '(61) 98426-7154',
            'endereco'=> 'Rua 860 Lt22 Areal - Águas Claras',
            'cidade'=> 'Brasília - DF',
        ]);
    }

}
