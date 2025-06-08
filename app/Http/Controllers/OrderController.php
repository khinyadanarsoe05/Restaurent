<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{ public function __construct()
{
    $this->middleware('auth');
}
    public function index(Request $request){

        $query = Dish::query();

    // Search logic
    if ($request->has('search') && $request->search != '') {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $dishes = $query->get();
      //  $dishes=Dish::all();
        $tables=Table::all();
        $orders=Order::where('status',4)->get();
        $rawStatus=config('res.status');
        $status=array_flip($rawStatus);
       // $search=$request->input('search');
      //  $sdish=Dish::where('name', 'LIKE', "%{$search}%")->orderBy('id', 'desc')->get();
        return view('order_form',compact('dishes','tables','orders','status'));

    }
    public function submit(Request $request){
    $data=array_filter($request->except('_token','table'));
    $order_Id=rand();
    foreach($data as $key => $value){
        if ($value >1){
            for($i=0;$i<$value;$i++){
                $order=new Order();
                $order->order_id=$order_Id;
               $order->dish_id=$key;
                $order->category_id=$request->table;
                $order->status=config('res.status.new');
                $order->save();

            }
        }
        else{
            $order=new Order();
                $order->order_id=$order_Id;
                $order->dish_id=$key;
                $order->category_id=$request->table;
                $order->status=config('res.status.new');
                $order->save();

        }
    }
return redirect('/')->with('status','Order submit successfully');
    }
    public function Serve(Order $order){
         $order->status=config('res.status.serve');
        $order->save();
        return redirect('/')->with('status','Status change ');
    }
    public function search(Request $request) {
        $search=$request->input('search');
        $tables=Table::all();
        $sdish=Dish::where('name', 'LIKE', "%{$search}%")->orderBy('id', 'desc')->get();
        return view('order_form',compact('sdish','tables'));
    }
}
