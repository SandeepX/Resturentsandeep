<?php

namespace App\Http\Controllers;
use App\Setmenu;
use Illuminate\Http\Request;
use App\Menu;
class SetmenuController extends Controller
{

    protected $menu = null;
    
    public function __construct(Menu $menu){
        
        $this->menu = $menu;
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $menu = $this->menu->orderBy('id','DESC')->get();
         return view('staff.setmenu')
        ->with('menuData', $menu);
    }

    





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        foreach ($request->menu as $menu) {
            $data = new Setmenu;
            $data->menu=$menu;
            $data->created_date=$request->created_date;
            $data->added_by = $request->user()->id;
            $status=$data->save();
        }
        if($status){
            $request->session()->flash('success','Menu of the day added successfully');
        }else{
             $request->session()->flash('error','Menu of the day not added  ');

        }
       return view('staff.dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
