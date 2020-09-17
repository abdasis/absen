<?php

namespace App\Http\Controllers;

use App\Models\Sift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sifts = Sift::all();
        return view('pages.sift.index')->withSifts($sifts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.sift.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sift = new Sift();
        $sift->name = $request->get('nama');
        $sift->masuk = $request->get('masuk');
        $sift->keluar = $request->get('keluar');
        $sift->save();
        Session::flash('status', 'Data berhasil disimpan');
        return redirect()->route('sift.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sift  $sift
     * @return \Illuminate\Http\Response
     */
    public function show(Sift $sift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sift  $sift
     * @return \Illuminate\Http\Response
     */
    public function edit(Sift $sift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sift  $sift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sift $sift)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sift  $sift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sift $sift)
    {
        //
    }
}
