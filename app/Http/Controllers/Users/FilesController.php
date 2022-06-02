<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\File as ModelsFile;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $files = ModelsFile::whereUserId(Auth::id())->get();

        return view('index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FilesRequest $request)
    {
        $user = Auth::id();
        $files = $request->file('file');

       /* if(count($files) > 1){

        }*/

        foreach($files as $file){
            $fileName = Str::slug($file->getClientOriginalName()).'.'. $file->getClientOriginalExtension();
            if(Storage::putFileAs('/public/' . $user . '/', $file, $file->getClientOriginalName())){

                ModelsFile::create([
                        'name' =>$fileName,
                        'user_id' => $user
                    ]);
              }
            }


        Alert::success('Exito', 'Guardado de manera exitosa');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = ModelsFile::whereId($id)->firstOrFail();

        //Borrar del storage
        unlink(public_path('storage' . '/' . Auth::id() . '/' . $file->name));

        $file->delete();

        Alert::success('Exito', 'Eliminado de manera exitosa');

        return back();
    }
}
