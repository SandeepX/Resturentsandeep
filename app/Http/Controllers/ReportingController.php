<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
class ReportingController extends Controller
{
    

    protected $order = null;
    public function __construct( Order $order){
        $this->order = $order;
    } 

/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
 */
    public function index()
    {   
        $order=Order::where('status','=','completed')->paginate(10);
        //$order = $this->order->where('status','=', 'completed' )->orderBy('id','DESC')->get()->paginate(1); 
       
        $collection = Order::groupBy('item')
                    ->selectRaw('sum(cost) as total,item')
                    ->get();

        $customer = Order::groupBy('ordered_by')
                    ->selectRaw('sum(cost) as purchase,ordered_by')
                    ->get();

        return view('admin.Reporting')
        ->with('order', $order)  
        ->with('collection',$collection)
        ->with('customer',$customer);
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
