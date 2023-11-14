<?php

namespace App\Http\Controllers;

use App\Http\Requests\userValidation;
use App\Models\User;
use Barryvdh\DomPDF\Facade\PDF;
use Exception;
use Illuminate\Http\Request;

class usuarioController extends Controller
{
    public function listar()
    {
        $user = User::get();
        return view('crud', compact("user"));
    }
    public function registrar(userValidation $data)
    {
        try {
            $user = User::create($data->all());
            return redirect()->to("/");

        } catch (Exception $e) {
            die("Error" . $e->getMessage());
        }
    }
    public function edit(Request $data)
    {
        $user = User::get();
        $userFind = User::find($data->id);
        return view('crud', compact("user"), compact("userFind"));
        
    }
    public function update(Request $data)
    {
        $user = User::find($data->id);
        $user->update($data->all());
        return redirect()->to("/");
        
    }
    public function delete(Request $data)
    {
      
        $user = User::find($data->id);
        $user->delete();
        return redirect()->to("/");
        
    }
    public function pdf(Request $data)
    {
        $userFind = User::find($data->id);
        $pdf = PDF::LoadView('pdf',compact("userFind"));
        return $pdf->stream();
        
    }
}
