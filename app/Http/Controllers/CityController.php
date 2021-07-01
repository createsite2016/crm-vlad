<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityPostRequest;
use App\Models\City;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    /**
     * Отображение страницы с городами.
     *
     * @return View
     */
    public function index(): View
    {
        $cities = DB::table('cities')->get();
        return view('page.user.cities.index', compact('cities'));
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
     * Создание нового города.
     *
     * @param CityPostRequest $request
     * @return RedirectResponse
     */
    public function store(CityPostRequest $request): RedirectResponse
    {
        City::create($request->validated());

        return redirect()->route('user.cities.store');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
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
        $city = City::where('id', $id)->get()->first();
        return view('page.user.cities.edit', ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CityPostRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(CityPostRequest $request, int $id): RedirectResponse
    {
        $city = City::findOrFail($id);
        $city->name = $request->name;
        $city->update();

        return redirect()->route('user.cities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $city = City::find($id);
        if ($city){
            $city->delete();
        }

        return redirect()->route('user.cities.index');
    }
}
