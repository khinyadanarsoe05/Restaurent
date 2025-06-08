<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDishRequest;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Order;
use Illuminate\Http\Request;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $dishes=Dish::orderBy('id','desc')->get();
        return view('kitchen.dish',compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('kitchen.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDishRequest $request)
    {
//dd($request);
        $dish=new Dish();
        $dish->name=$request->name;
        $dish->category_id=$request->category_id;
        $imagePath = $request->file('dish_image')->store('images', 'public');
        $dish->dish_image=$imagePath;

        $dish->save();
        return redirect('/dish')->with('status','Successfully Created');
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
    public function edit(Dish $dish)
    {    $categories=Category::all();
        return view('kitchen.dishEdit',compact('dish','categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDishRequest $request, $id)
    {
        $dish=Dish::findOrFail($id);
        $dish->name=$request->name;
        $dish->category_id=$request->category_id;
       // $imagePath = $request->file('dish_image')->store('images', 'public');
         if ($request->hasFile('dish_image')) {
        $imagePath = $request->file('dish_image')->store('images', 'public');
        $dish->dish_image = $imagePath;
    }

     //  $dish->dish_image=$imagePath;

        $dish->save();
        return redirect('/dish')->with('status','Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Dish::findOrFail($id)->delete();
        return redirect('/dish')->with('status','Successfully Deleted');
    }
    public function orderList(){
        $orders=Order::whereIn('status',[1,2])->get();
        $rawStatus=config('res.status');

        $status=array_flip($rawStatus);
            return view('kitchen.order',compact('orders','status'));
    }
    public function Approve(Order $order){
        $order->status=config('res.status.processing');
        $order->save();
        return redirect('order')->with('status','Status change ');
    }
    public function Cancel(Order $order){
        $order->status=config('res.status.cancle');
        $order->save();
        return redirect('order')->with('status','Status change ');
    }
    public function Ready(Order $order){
        $order->status=config('res.status.ready');
        $order->save();
        return redirect('order')->with('status','Status change ');
    }
      public function Done(Order $order){
        $order->status=config('res.status.done');
        $order->save();
        return redirect('order')->with('status','Status change ');
    }
}
