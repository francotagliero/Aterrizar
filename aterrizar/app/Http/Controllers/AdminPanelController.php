<?php

namespace App\Http\Controllers;

use App\AdminPanel;
use App\Http\Requests\StoreAdminPanel;
use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $adminPanel = AdminPanel::find(1);

        return view('adminPanel.index')->with('adminPanel', $adminPanel);
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
    public function store(StoreAdminPanel $request)
    {
        $settings = AdminPanel::find(1);
        $settings->max_flight_duration = $request->max_flight_duration;
        $settings->percentage_stopover = $request->percentage_stopover / 100;
        $settings->max_gap = $request->max_gap;
        $settings->return_tax = $request->return_tax / 100;
        $settings->points_per_peso = $request->points_per_peso;
        $settings->pesos_per_point = $request->pesos_per_point;
        $settings->firstclass_factor = $request->firstclass_factor / 100;
        $settings->bussinessclass_factor = $request->bussinessclass_factor / 100;
        $settings->save();

        return back()->with('success', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdminPanel  $adminPanel
     * @return \Illuminate\Http\Response
     */
    public function show(AdminPanel $adminPanel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdminPanel  $adminPanel
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminPanel $adminPanel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminPanel  $adminPanel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminPanel $adminPanel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdminPanel  $adminPanel
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminPanel $adminPanel)
    {
        //
    }
}
