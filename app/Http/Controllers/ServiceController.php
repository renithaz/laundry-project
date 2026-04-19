<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Service";
        $services = Service::all();
        return view('service.index', compact('title', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Buat Service Baru";
        return view('service.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable'
        ]);

        Service::create($request->all());

        Alert::success('Sukses', 'Service berhasil dibuat');
        return redirect()->route('service.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Ubah Data Service";
        $service = Service::find($id);
        return view('service.edit', compact('title', 'service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'service_name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable'
        ]);

        $service = Service::find($id);
        $service->update($request->all());
        $service->save();

        Alert::success('Sukses', 'Service berhasil diperbarui');
        return redirect()->route('service.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::find($id);
        $service->delete();

        Alert::success('Sukses', 'Service berhasil dihapus');
        return redirect()->route('service.index');
    }
}
