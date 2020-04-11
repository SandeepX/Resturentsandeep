<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
class VieworderController extends Controller
{
    protected $order = null;
    
    public function __construct(Order $order){
        
        $this->order = $order;
    }  


    public function index()
    {
        $OrderData = $this->order->orderBy('id','DESC')->get();
        return view('staff.viewOrder')
        ->with('OrderData', $OrderData);
    }

   
    public function getOrderById(Request $request){
        $this->order = $this->order->find($request->order_id);
        //dd($this->order);
        if(!$this->order){
            return response()->json(['status' => false, 'msg' =>'Order doesnot exist', 'data'=> null]);
        }
        return response()->json(['status' => true, 'msg' =>null, 'data'=> $this->order]);
    }

    public function update2(Request $request){
        $this->order = $this->order->where('id',$request->order_id)->update(['status'=>$request->newdata]);
        return response()->json(['status' =>'success']);
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
        //
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
        
    }

    
    public function destroy($id)
    {
        $this->order =$this->order->find($id);
        if(!$this->order){
            request()->session()->flash('error', 'Order not found.');
            return redirect()->route('viewOrder.index');
        }
        $success = $this->order->delete($id);
        if($success){
            request()->session()->flash('success','Order cancalled successfully.');
        }else{
             request()->session()->flash('error',' sorry !order not canelled.');
        }
        return redirect()->route('viewOrder.index');
    }
}
