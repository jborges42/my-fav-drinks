<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use Illuminate\Http\Request;
use Session;

class DrinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drinks = Drink::select('id', 'name', 'is_alcohol')->orderBy('id', 'desc')->paginate();

        return response()->view('drinks.index', compact('drinks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('drinks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $drink = new Drink();
        $drink->name = $request->name;

        if ($request->has('isAlcohol')) {
            $drink->is_alcohol = 1;
        }

        $saved = $drink->save();

        if ($saved) {
            Session::flash('alert-success', 'Bebida cadastrada com sucesso');
            return redirect()->route('drinks.index');
        }

        Session::flash('alert-warning', 'Erro ao cadastrar');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $drink = Drink::select('id', 'name', 'is_alcohol')->where('id', $id)->first();

        if ($drink) {
            return response()->view('drinks.show', compact('drink'));
        }

        Session::flash('alert-warning', 'Erro ao exibir bebida');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $drink = Drink::select('id', 'name', 'is_alcohol')->where('id', $id)->first();

        if ($drink) {
            return response()->view('drinks.edit', compact('drink'));
        }

        Session::flash('alert-warning', 'Erro ao tentar atualizar bebida');
        return redirect()->back();
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
        $drink = Drink::select('id', 'name', 'is_alcohol')->where('id', $id)->first();

        $drink->name = $request->name;

        if ($request->has('isAlcohol')) {
            $drink->is_alcohol = 1;
        } else {
            $drink->is_alcohol = 0;
        }

        $updated = $drink->update();

        if ($updated) {
            Session::flash('alert-success', 'Bebida atualizada com sucesso');

            return redirect()->route('drinks.index');
        }

        Session::flash('alert-warning', 'Erro ao atualizar');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $drink = Drink::select('id', 'name', 'is_alcohol')->where('id', $id)->first();

        $deleted = $drink->delete();

        if ($deleted) {
            Session::flash('alert-success', 'Bebida deletada com sucesso');
            return redirect()->route('drinks.index');
        }

        Session::flash('alert-warning', 'Erro ao excluir');
        return redirect()->back();
    }
}