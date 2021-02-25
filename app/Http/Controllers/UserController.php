<?php

namespace App\Http\Controllers;

use App\User;
use App\Helpers\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
	{
		$this->middleware('auth')->except('store','login');
	}

    public function login(Request $request)
    {
        $user = User::by_field('email', $request->email);

		if (isset($user) && Hash::check($request->password, $user->password))
        {
            $token = new Token(['email' => $user->email]);
            $token = $token->encode();

            return response()->json([
                "token" => $token
            ], 200);
        }

        return response()->json([
            "message" => "no autorizado"
        ], 401);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return User::all();

        //return response()->json(['data' => User::all()], 200);

        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',

        ];

        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'email.required' => 'El campo correo no tiene el formato.',
            'password' => 'La contraseña es campo obligatorio.'
        ];

        $validateData = $request->validate($rules, $messages);
        $validateData['password'] = bcrypt($validateData['password']);
		
		//para jwt
        $data_token = [
            "email" => $validateData['email'],
        ];
        $token = new Token($data_token);
        $token = $token->encode();

        $user = User::create($validateData);
        return new UserResource($user);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $rules = [
            'name' => 'max:255',
            'email' => 'email',
            'password' => 'min:6|confirmed',
        ];

        $validatedData = $request->validate($rules);

        if ($request->filled('password')) {
            $validateData['password'] = bcrypt($request->input('password'));
        }

        
        $user->fill($validatedData);

        //Indica si a cambiado algun valor del modelo antes del cambio
        if (!$user->isDirty()) {

            return response()->json(['error' => ['code' => 422, 'message' => 'especifica algun cambio distinto']], 422);
        }
        $user->save();
        return new UserResource($user);
    }


}
