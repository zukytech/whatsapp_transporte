<?php

namespace App\Http\Controllers;
use App\Restorant;
use Illuminate\Http\Request;
use Akaunting\Module\Facade as Module;
use App\Models\Companies;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasRole(['admin','manager'])) {
            $title=Module::has('cloner')&&isset($_GET['cloneWith'])?__('Clone Restaurant')." ".(Restorant::findOrFail($_GET['cloneWith'])->name):__('Crear una compañia');
            return view('companies.create',['title'=>$title]);
        } else {
            return redirect()->route('orders.index')->withStatus(__('No Access'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $compañia = new Companies;
        $compañia->name = $request->name;
        $compañia->save();

        if (auth()->user()->hasRole(['admin','manager'])) {
            $title=Module::has('cloner')&&isset($_GET['cloneWith'])?__('Clone Restaurant')." ".(Restorant::findOrFail($_GET['cloneWith'])->name):__('Crear una compañia');
            return view('companies.create',['title'=>$title]);
        } else {
            return redirect()->route('orders.index')->withStatus(__('No Access'));
        }
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
