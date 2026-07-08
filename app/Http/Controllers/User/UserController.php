<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Response as InertiaResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): InertiaResponse
    {
        $search = (string) $request->input('search', '');

        $users = User::query()
            ->when($search !=='', function ($query) use ($search) {
                $scapeSearch = str_replace(['%','_'],['\%','\_'], $search); // Escape special characters
                
                return $query->where('name', 'like', "%{$scapeSearch}%")
                    ->orWhere('email', 'like', "%{$scapeSearch}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('users/Index', [
            'users' => $users,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {    
        return inertia('users/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validado = $request->validate(
            [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            ],
            [
                'name.required' => 'O campo nome é obrigatório.',
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O campo email deve ser um endereço de email válido.',
                'email.unique' => 'O email informado já está em uso.',
                'password.required' => 'O campo senha é obrigatório.',
                'password.min' => 'A senha deve ter no mínimo :min caracteres.',
                'password.confirmed' => 'A confirmação da senha não corresponde.',
            ]
        );

        $user = User::create([
            'name' => $validado['name'],
            'email' => $validado['email'],
            'password' => $validado['password'],
        ]);
        
        return redirect()->route('users.show',['user'=>$user->id])->with('success', 'Usuário criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        
        return inertia('users/Show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
   
        return inertia('users/Edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, Request $request)
    {
        // Implement the logic to update the user with the given ID
        
        $validado = $request->validate(
            [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            ],
            [
                'name.required' => 'O campo nome é obrigatório.',
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O campo email deve ser um endereço de email válido.',
                'email.unique' => 'O email informado já está em uso.',
            ]
        );
        
        $user->update([
            'name' => $validado['name'],
            'email' => $validado['email'],            
        ]);

        return redirect()->route('users.show',['user'=>$user->id])->with('success', 'Usuário atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário removido com sucesso!');
    }

    public function exportcsv(Request $request): StreamedResponse
    {
        $search = (string) $request->input('search', '');
        $query = $this->applyFilters(User::query(), $search)->orderBy('name');

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="usuarios_export_' . now()->format('Ymd_His') . '.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () use ($query) {
            $handle = fopen('php://output', 'w');
            
            // Adiciona BOM para o Excel interpretar UTF-8 corretamente automaticamente
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Cabeçalho do CSV
            fputcsv($handle, ['ID', 'Nome', 'E-mail']);

            // Processa em pedaços (chunks) de 500 registros para evitar estouro de memória RAM (O(1) Memory Complexity)
            $query->chunkById(500, function ($users) use ($handle) {
                foreach ($users as $user) {
                    fputcsv($handle, [
                        $user->id,
                        $user->name,
                        $user->email
                    ]);
                }
            });

            fclose($handle);
        }, 200, $headers);
    }

    public function exportpdf(Request $request) 
    {
        $search = (string) $request->input('search', '');
                
        // Para o PDF, limitamos preventivamente ou usamos uma paginação estrita se a base for gigantesca.
        // Aqui buscamos a lista filtrada respeitando os limites razoáveis de renderização de documentos.
        
        $users = $this->applyFilters(User::query(), $search)
            ->select(['id', 'name', 'email'])
            ->orderBy('id', 'desc')
            ->take(1000) // Guardrail para evitar travamento em PDFs massivos (renderização síncrona)
            ->get();

        $pdf = Pdf::loadView('users.exportarpdf', ['users' => $users])->setPaper('a4', 'portrait');
        
        return $pdf->download('usuarios_export_' . now()->format('Ymd_His') . '.pdf');
    }

    private function applyFilters(Builder $query, string $search): Builder
    {
        return $query->select(['id', 'name', 'email'])
            ->when($search !== '', function ($query) use ($search) {
                $escapedSearch = str_replace(['%', '_'], ['\%', '\_'], $search);
                return $query->where(function ($q) use ($escapedSearch) {
                    $q->where('name', 'like', "%{$escapedSearch}%")
                      ->orWhere('email', 'like', "%{$escapedSearch}%");
                });
            });
    }


}
