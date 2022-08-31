<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato;
use Illuminate\Support\Facades\Validator;

use Log;

class ContatosController extends Controller
{
    public function carregarContatos() {
        $contatos = Contato::all();
        return response()->json($contatos);
    }

    public function criarContato(Request $request) {
        $rulesContato = [
            'nome' => 'required|string',
            'email' => 'required|string|unique:contatos',
            'celular' => 'required|string',
            'cep' => 'required|string',
            'numer' => 'required|string',
        ];

        Log::info( 'Dados recebidos: ' . json_encode( $request->all() ) );

        $validation = Validator::make($request->all(), $rulesContato);

        if ( $validation->fails() ) {
            return response()->json([$validation->errors()], 400);
        }

        $contato = Contato::create($request->all());
        return response()->json(array('contato' => $contato));
    }

    public function alterarContato(Request $request) {
        $contato = Contato::find($request->input('id'));
        if ( $contato ) {
            $contato->nome = $request->input("nome");
            $contato->email = $request->input("email");
            $contato->celular = $request->input("celular");
            $contato->telefone = $request->input("telefone");
            $contato->cep = $request->input("cep");
            $contato->numer = $request->input("numer");
            $contato->endereco = $request->input("endereco");
            $contato->bairro = $request->input("bairro");
            $contato->complemento = $request->input("complemento");
            $contato->cidade = $request->input("cidade");
            $contato->estado = $request->input("estado");
            $contato->save();

            return response()->json(array('contato' => $contato));            
        } else {
            return response()->json(["message" => "Contato não encontrado"], 400);
        }
    }

    public function excluirContato(Request $request) {
        $contato = Contato::find($request->input('id'));
        if ( $contato ) {
            $contato->delete();
            return response()->json(array('message' => "Contato excluído com sucesso"));
        } else {
            return response()->json(["message" => "Contato não encontrado"], 400);
        }
    }
}
