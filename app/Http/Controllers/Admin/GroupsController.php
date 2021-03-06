<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Group;
use App\Http\Requests;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups =  Group::orderBy('id','DESC')->paginate();

        return view('modules.admin.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.admin.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = array(
            'name' => 'required|unique:groups,name|max:60'
        );

        /*conseguir el ultimo id*/

        $groupId= Group::all();
        $id =($groupId->last()->id)+1;

        //var_dump($groupId->last('id'));

        $this->validate($request, $rules);

        $input = Input::file('avatar');

        $image = Image::make($input);

        $name = 'groupId'.'_'.$id;

        $path = public_path().'/img/group/'.$name;

        if($image->save($path.'.jpg')){
            $image->resize(240,240);
            // Guardar
            $image->save($path.'-thumb'.'.jpg');
        }

        $data= [
            'name'  => $request->get('name'),
            'description'  => $request->get('description'),
            'avatar'  => $name.'.jpg',
            'status'  => 'A',
            'created_at' => new \DateTime,
            'updated_at' =>  new \Datetime
        ];
        //dd($data);
        $Group = Group::create($data);

        return redirect()->route('admin.groups.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::findOrFail($id);
        return view('modules.admin.groups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = array(
            'name' => 'required|unique:groups,name|max:255'
        );

        $this->validate($request, $rules);

        $Group = Group::findOrFail($id);

        $input = Input::file('avatar');

        $image = Image::make($input);

        $name = 'groupId'.'_'.$id;

        $path = public_path().'/img/group/'.$name;

        if($image->save($path.'.jpg')){
            $image->resize(240,240);
            // Guardar
            $image->save($path.'-thumb'.'.jpg');
        }

        $data= [
            'name'  => $request->get('name'),
            'description'  => $request->get('description'),
            'avatar'  => $name.'.jpg',
            'status'  => 'A',
            'created_at' => new \DateTime,
            'updated_at' =>  new \Datetime
        ];
        //dd($data);


        $Group->fill($data);
        $Group->save();
        return redirect()->route('admin.groups.index');

        //return redirect()->back(); //con este redirecciona al mismo formulario
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
        //Group::destroy($id);
        //abort(500);

        $Group = Group::findOrFail($id);

        $Group->delete();

        $message=$Group->name.' fue Eliminado de Nuestro Registro';

        if($request->ajax()){
            return response()->json([
                'id' =>$Group->id,
                'message' => $message
            ]);
        }

        Session::flash('message',$message);

        return redirect()->route('admin.groups.index');
    }
}
