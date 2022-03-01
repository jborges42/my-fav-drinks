<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use Illuminate\Http\Request;
use Session;
use Auth;

class DrinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drinks = Drink::select('id', 'name', 'is_alcohol')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate();

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
        $drink->user_id = Auth::user()->id;

        if ($request->has('isAlcohol')) {
            $drink->is_alcohol = 1;
        }

        $saved = $drink->save();

        if ($saved) {
            Session::flash('alert', ['type' => 'alert-success', 'message' => 'Bebida cadastrada com sucesso']);
            return redirect()->route('drinks.index');
        }

        Session::flash('alert', ['alert-danger', 'Erro ao cadastrar']);

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
        $drink = Drink::select('id', 'name', 'is_alcohol')->where('id', $id)->where('user_id', Auth::user()->id)->first();

        if ($drink) {
            return response()->view('drinks.show', compact('drink'));
        }

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
        $drink = Drink::select('id', 'name', 'is_alcohol')->where('id', $id)->where('user_id', Auth::user()->id)->first();

        if ($drink) {
            return response()->view('drinks.edit', compact('drink'));
        }

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
        $drink = Drink::select('id', 'name', 'is_alcohol')->where('id', $id)->where('user_id', Auth::user()->id)->first();

        $drink->name = $request->name;

        if ($request->has('isAlcohol')) {
            $drink->is_alcohol = 1;
        } else {
            $drink->is_alcohol = 0;
        }

        $updated = $drink->update();

        if ($updated) {
            Session::flash('alert', ['type' => 'alert-success', 'message' => 'Bebida atualizada com sucesso']);

            return redirect()->route('drinks.index');
        }

        Session::flash('alert', ['type' => 'alert-danger','message' => 'Erro ao atualizar']);
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
        $drink = Drink::select('id', 'name', 'is_alcohol')->where('id', $id)->where('user_id', Auth::user()->id)->first();

        $deleted = $drink->delete();

        if ($deleted) {
            Session::flash('alert', ['type' => 'alert-success', 'message' => 'Bebida deletada com sucesso']);
            return redirect()->route('drinks.index');
        }

        Session::flash('alert', ['type' => 'alert-danger', 'message' => 'Erro ao excluir']);
        return redirect()->back();
    }
}
