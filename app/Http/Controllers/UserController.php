<?php

namespace App\Http\Controllers;

use App\Jobs\JobSendEmail;
use App\Models\User;
use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->validateSession() ? view('home') : view('index');
    }

    public function validaEmail(Request $request)
    {   
        $this->validateSession() ? '' : view('index');
        $user = User::where('email',$request->email)->first();
        $result = [];
        if(is_null($user))
        {
            $result = [
                'status'=>true,
                'message'=> 'O login informado não existe!'
            ];
        }else{
            $result = [
                'status'=>false,
                'message'=> 'O login informado já existe!'
            ];
        }

        echo json_encode($result,JSON_PRETTY_PRINT);
        return;
    }

    public function login(Request $request)
    {
       $user = User::where('email',$request->email)
                    ->whereNotNull('registed_at')
                    ->first();


       if(!is_null($user))
       {
        !Hash::check($request->password,$user->password) ? $user = null : $user->password = null;

            is_null($user) ? $request->session()->pull('user') : $request->session()->put('user',$user);
            
       }
       return is_null($user) ? redirect()->route('user.index')->with('feedback','Login ou senha incorreta') : redirect()->route('user.index') ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cadastro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if($user->getKey())
        {
            JobSendEmail::dispatch($user->email);
            return [
                'status'=>true,
                'message'=> 'Cadastro realizado com sucesso'
            ];
        }
        
        return [
            'status'=>false,
            'message'=> 'Falha ao tentar cadastrar usuario'
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {        
        if(!$this->validateSession()){
            return view('index');
        }

        $poke = $user->pokemons;

        return view('profile',[
            'pokemons'=> $poke
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->name = strlen($request->name) > 0 ? $request->name : $user->name ;
        $user->login = strlen($request->login) > 0 ? $request->login : $user->login ;
        $user->password = strlen($request->password) > 0 ? Hash::make($request->password) : Hash::make($user->password) ;

        if($user->save()){
            $request->session()->put('user',$user);
            return back()->with('feedback','Alterações salvas com sucesso');
        }

            return back()->with('feedback','Falha ao salvar as alterações. Entre em contato com o administrador');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $res = new User();
        if(!is_null($request->password) && $this->validateSession())
        {
            $res = User::where('login',Session::get('user')->login)->first();

        }
        if(Hash::check($request->password,$res->password))
        {
            $user->delete();
            $request->session()->pull('user');
            return redirect()->route('user.index');
        }
        return back()->with('error','Senha incorreta');
    }

    public function exit(Request $request)
    {
        $request->session()->pull('user');
        return redirect()->route('user.index');
    }

    public function showPokemons(Request $request)
    {
        if(!$this->validateSession()){
            return view('index');
        }

        $offset = $request->offset ?? 0;
        $limit = $request->limit ?? 10;
        $pokemon = new Pokemon();
        return view('pokemons',[
            'pokemons' => $pokemon->pokemonsRandom($limit)
        ]);
    }
}
