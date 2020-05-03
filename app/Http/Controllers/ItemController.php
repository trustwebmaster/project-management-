<?php

namespace App\Http\Controllers;

use App\Item;
use App\Project;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;


class ItemController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __invoke()
    {
        return view('items.index');
    }

    public function index(Project $project)
    {
        if (Auth::check()) {
            $items = \App\Product::where('user_id', Auth::user()->id)->where('project_id', $project->id)->get();

            return view('items.index', ['items'=> $items, 'project' => $project]);

        }
        return view('auth.login');
    }

    public function insert(Request $request)
    {
        if($request->ajax())
     {
      $rules = array(
       'first_name.*'  => 'required',
       'last_name.*'  => 'required'
      );
      $error = FacadesValidator::make($request->all(), $rules);
      if($error->fails())
      {
       return response()->json([
        'error'  => $error->errors()->all()
       ]);
      }

      $first_name = $request->first_name;
      $last_name = $request->last_name;
      for($count = 0; $count < count($first_name); $count++)
      {
       $data = array(
        'first_name' => $first_name[$count],
        'last_name'  => $last_name[$count]
       );
       $insert_data[] = $data;
      }

      Item::insert($insert_data);
      return response()->json([
       'success'  => 'Data Added successfully.'
      ]);
     }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\items  $items
     * @return \Illuminate\Http\Response
     */
    public function show(Item $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $items)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $items)
    {
        //
    }

    public function update_stock(Request $request) {
        $keys = $request->all();

        foreach( $keys as $key => $value ) {

            if ( strpos($key, '_pid_') !== false ){
                $id = explode( '_pid_', $key )[1];
                $used = new \App\StockUsed();
                $used->project_id = $request->project_id;
                $used->product_id = $id;
                $used->quantity = $value;
                $used->save();
            }

        }



        return redirect()->back();
    }
}
