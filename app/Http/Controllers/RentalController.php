<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarResource;
use App\Http\Resources\Rentalresource;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index(Car $car)
    {
        return $car->rentals;
    }


    public function store(Car $car,Request $request )
    {
        $rental = Rental::create(
            'plate_number' => ['string','max:9','unique:cars,plate_number'],
            'owner'=>['string','max:100'],
            'model'=>['string','max:50'],
            'make'=>['string','max:50'],
            'performance'=>['integer'],
        );

        // $rental = $car->rentals()->create($request->all());
        return new CarResource($rental);

    }

    public function show(Car $car, Rental $rental)
    {
        return new Rentalresource($rental);
    }

    public function update(Request $request, Car $car, Rental $rental)
    {
        $rental->update($request->all());
        return new CarResource($rental);
    }

    public function destroy(Car $car, Rental $rental)
    {
        $rental->delete();
        return response()->noContent();
    }

    public function rent(Car $car, Rental $rental)
    {
        $rental->rent();
        return new CarResource($rental);
    }
}
