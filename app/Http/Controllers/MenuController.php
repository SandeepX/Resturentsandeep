<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
class MenuController extends Controller
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
        $this->menu = $this->menu->orderBy('id','DESC')->get(); 

        return view('admin.menu')->with('menuData', $this->menu);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */




    public function getprice(Request $request){
        //dd($request->all());
        $this->menu = $this->menu->find($request->Item);
        
        if(!$this->menu){
            return response()->json(['status' => false, 'msg' =>'Menu doesnot exist', 'data'=> null]);
        }
        return response()->json(['status' => true, 'msg' =>null, 'data'=> $this->menu]);
    }









    public function getMenuById(Request $request){
        $this->menu = $this->menu->find($request->menu_id);
        if(!$this->menu){
            return response()->json(['status' => false, 'msg' =>'Menu doesnot exist', 'data'=> null]);
        }
        return response()->json(['status' => true, 'msg' =>null, 'data'=> $this->menu]);
    }


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
        $rules = $this->menu->getRules();
        $request->validate($rules);


        $data = $request->all(); 

        $this->menu->fill($data);
        $status = $this->menu->save();
        if($status){
            $request->session()->flash('success','Menu added successfully');
        }else{
             $request->session()->flash('error','Menu not added');

        }
        return redirect()->route('menu.index');
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
        $this->menu = $this->menu->find($id); 
        
        if (!$this->menu) {
            $request->session()->flash('error',' Menu not found'); 
            return redirect()->route('menu.index');
        }   
        $rules = $this->menu->getRules();
        $request->validate($rules);

        $data = $request->all();
        $this->menu->fill($data);
        $status = $this->menu->save();
        if($status){
            $request->session()->flash('success',' Menu updated successfully');
        }else{
             $request->session()->flash('error',' Menu not updated ');

        }
        return redirect()->route('menu.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $this->menu =$this->menu->find($id);
        if(!$this->menu){
            request()->session()->flash('error', 'Menu not found.');
            return redirect()->route('menu.index');
        }
        $success = $this->menu->delete($id);
        if($success){
            request()->session()->flash('success','Menu deleted successfully.');
        }else{
             request()->session()->flash('error',' sorry !Menu not deleted.');
        }
        return redirect()->route('menu.index');
    }
}
