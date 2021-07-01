<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffPostRequest;
use App\Models\Staff;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $cities = DB::table('cities')->get();
        $staffs = Staff::all();
        return view('page.user.staffs.index', [
            'cities' => $cities,
            'staffs' => $staffs
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
     * @param StaffPostRequest $request
     * @return RedirectResponse
     */
    public function store(StaffPostRequest $request): RedirectResponse
    {
        Staff::create($request->validated());

        return redirect()->route('user.staffs.index');
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
     * @param int $staff
     * @return View
     */
    public function edit(int $staff): View
    {
        $staff = Staff::find($staff);
        $cities = DB::table('cities')->get();
        return view('page.user.staffs.edit', [
            'cities' => $cities,
            'staff' => $staff
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $staff
     * @return RedirectResponse
     */
    public function update(StaffPostRequest $request, int $staff): RedirectResponse
    {
        $staff = Staff::findOrFail($staff);
        $staff->update($request->all());

        return redirect()->route('user.staffs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $staff
     * @return RedirectResponse
     */
    public function destroy(int $staff): RedirectResponse
    {
        $staff = Staff::find($staff);
        if ($staff){
            $staff->delete();
        }

        return redirect()->route('user.staffs.index');
    }
}
