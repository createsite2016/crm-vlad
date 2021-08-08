<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CarController extends Controller
{
    public function index()
    {
        $users = User::all();
        $cars = Car::all();
        return view('page.user.cars.index', compact('cars', 'users'));
    }

    /**
     * Создание авто.
     *
     * @param CarRequest $request
     * @return RedirectResponse
     */
    public function store(CarRequest $request): RedirectResponse
    {
        Car::create($request->validated());
        return redirect()->route('user.cars.index');
    }

    /**
     * Изменение авто.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $car = Car::find($id);
        return view('page.user.cars.edit', compact('car'));
    }

    /**
     * Обновление информации автомобиля.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $car = Car::findOrFail($id);
        $car->update($request->all());

        return redirect()->route('user.cars.index');
    }

    /**
     * Выбрать активный автомобиль для пользователя
     * @param int $car_id
     * @return RedirectResponse
     */
    public function select(int $car_id): RedirectResponse
    {
        $user = User::find(\Auth::user()->id);
        $user->car_id = $car_id;
        $user->save();

        return redirect()->route('user.profile.index', 'cars');
    }
}
