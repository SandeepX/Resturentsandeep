<?php

namespace App\Http\Controllers;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Setmenu;
use App\Menu;
class OrderController extends Controller
{   

   
    protected $setmenu = null;
    protected $order = null;
    public function __construct(Setmenu $setmenu, Order $order){
        $this->setmenu = $setmenu;
        $this->order = $order;
        
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = $this->setmenu->with('menu')->where('created_date','=', Carbon::today())->orderBy('id','DESC')->get();
        foreach($menu2 as $key =>$id){
            $menuId=$id->menu;
            $menu = Menu::find($menuId);
        }
           
      // dd($menu);
        return view('customer.Makeorder')
        
        ->with('menu',$menu); 
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
        $data=$request->all();
        $data['ordered_by']=$request->user()->id;
        $data['ordered_date']= $request['Ordered_date'];
        
        $date1['rate']= $request['rate'];
        $date2['qty']= $request['qty'];
        $data['cost']= $date1['rate']  * $date2['qty'];
        $order = new Order();

        $order->fill($data);
        $status = $order->save();
        
        if($status){
            $request->session()->flash('success','order successfully');
        }else{
             $request->session()->flash('error','opps! Error while ordering');

        }
        return redirect()->route('Makeorder.index');
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
         
        
    }
}
