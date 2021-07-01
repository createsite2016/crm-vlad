<?php

namespace App\Http\Controllers;

use App\Http\Requests\DevicePostRequest;
use App\Models\Device;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $staffs = DB::table('staff')->get();
        $devices = Device::all();
        return view('page.user.devices.index', [
            'staffs' => $staffs,
            'devices' => $devices
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(DevicePostRequest $request): RedirectResponse
    {
        Device::create($request->validated());

        return redirect()->route('user.devices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $device = Device::find($id);
        $staffs = DB::table('staff')->get();
        return view('page.user.device.edit', [
            'staffs' => $staffs,
            'device' => $device
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DevicePostRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(DevicePostRequest $request, int $id): RedirectResponse
    {
        $device = Device::findOrFail($id);
        $device->update($request->all());

        return redirect()->route('user.devices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $device = Device::find($id);
        if ($device){
            $device->delete();
        }

        return redirect()->route('user.devices.index');
    }
}
