<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateuserRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\User;
use App\Models\UserProfile;
use App\Http\Requests;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $users =  User::all();
      return view('modules.admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.admin.users.create');
    }

    /**
     * password the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
       return view('modules.admin.users.change_password');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateuserRequest  $request)
    {
        $data = [
            'username' => $request->get('username'),
            'password' =>  $request->get('password'),
            'status' =>  'A'
        ];
        $user = User::create($data);

        $dataProfile = [
            'user_id' => $user->id,
            'home_page' => 'home',
            'avatar' =>  'avatar.png'
        ];
        UserProfile::create($dataProfile);
        return redirect()->route('admin.users.show',$user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $userProfile = UserProfile::where('user_id', '=', $id)->firstOrFail();

        if(empty($userProfile))
        {
            Flash::error('Perfil no encontrado');

            return redirect()->back();
        }

        return view('modules.admin.users.profile_admin', compact('user', 'userProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('modules.admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {

        $data = [
            'username' => $request->get('username'),
            'status' =>  'A'
        ];

        $user = User::findOrFail($id);
        $user->fill($data);
        $user->save();
      //  return redirect()->route('admin.users.index');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //dd('Eliminando :'.$id);
        //User::destroy($id);
        //abort(500);

        $user = User::findOrFail($id);

        $user->delete();

        $message=$user->FullName.' fue Eliminado de Nuestro Registro';

        if($request->ajax()){
            return response()->json([
              'id' => $user->id,
              'message' => $message
            ]);
        }

        Session::flash('message',$message);

        return redirect()->route('admin.users.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_profile(Request $request, $id)
    {
        $userProfile = UserProfile::where('user_id', '=', $id)->firstOrFail();

        $rules = array(
            'name' => 'required|unique:user_profiles,name,'.$userProfile->id,
            'email' => 'required|unique:user_profiles,email,'.$userProfile->id,
            'home_page' => 'required'
        );

        $this->validate($request, $rules);

        $data= [
            'id'   => $userProfile->id,
            'name'  => $request->get('name'),
            'email'  => $request->get('email'),
            'phone'  => $request->get('phone'),
            'extending'  => $request->get('extending'),
            'user_name_windows'  => $request->get('user_name_windows'),
            'home_page'  => $request->get('home_page'),
            'user_id'  => $id,
            'created_at' => new \DateTime,
            'updated_at' =>  new \Datetime
        ];
       // dd($userProfile->save($data));

        $userProfile->fill($data);

        $userProfile->save();

       // return redirect()->route('admin.users.index');
       return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_password(Request $request, $id)
    {
        $user = User::findOrFail($id);

       // dd(Crypt::decrypt($user->password));

        $rules = array(
            'password' => 'confirmed|min:6'
        );

        $this->validate($request, $rules);

        $data = [
            'password' =>  $request->get('password')
        ];

        $user->fill($data);
        $user->save();
        //  return redirect()->route('admin.users.index');
        return redirect()->back();
    }




}
