<?php

namespace App\Http\Controllers;
use App\User; 
use Illuminate\Http\Request;
use Hash;
class UserController extends Controller
{   
    protected $user = null;
    public function __construct(User $user){
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $this->user = $this-> user->orderBy('id','DESC')->get(); 
         
        return view('admin.users')->with('userData', $this->user);
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
        $rules = $this->user->getRules();
        $request->validate($rules);


        $data = $request->all(); 
        $data['password']=Hash::make($request->password);
        $this->user->fill($data);
        $status = $this->user->save();
        if($status){
            $request->session()->flash('success','User added successfully');
        }else{
             $request->session()->flash('error','User not added');

        }
        return redirect()->route('user.index');
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


    public function getUserById(Request $request){
        $this->user = $this->user->find($request->user_id);
        if(!$this->user){
            return response()->json(['status' => false, 'msg' =>'User doesnot exist', 'data'=> null]);
        }
        return response()->json(['status' => true, 'msg' =>null, 'data'=> $this->user]);
    }
    
    public function update(Request $request, $id)
    {
        
        $this->user = $this->user->find($id); 
        
        if (!$this->user) {
            $request->session()->flash('error',' User not found'); 
            return redirect()->route('user.index');
        }   
        $rules = $this->user->getRules();
        $request->validate($rules);

        $data = $request->all();
        $this->user->fill($data);
        $status = $this->user->save();
        if($status){
            $request->session()->flash('success',' User updated successfully');
        }else{
             $request->session()->flash('error',' User not updated ');

        }
        return redirect()->route('user.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user =$this->user->find($id);
        if(!$this->user){
            request()->session()->flash('error', 'User not found.');
            return redirect()->route('user.index');
        }
        $success = $this->user->delete($id);
        if($success){
            request()->session()->flash('success','User deleted successfully.');
        }else{
             request()->session()->flash('error',' sorry !User not deleted.');
        }
        return redirect()->route('user.index');
    }
}
