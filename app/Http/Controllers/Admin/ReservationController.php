<?php

namespace App\Http\Controllers\Admin;

use App\Models\Table;
use App\Enums\TableStatus;
use App\Models\Reservations;
use Illuminate\Http\Request;

use Carbon\Carbon; 
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservation = Reservations::all();
          return view('admin.reservation.index',compact('reservation'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = Table::where('status',TableStatus::Avaliable)->get();
        return view('admin.reservation.create',compact('tables'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationStoreRequest $request)
    {
            $table = Table::findOrFail($request->table_id);
            if($request->guest_number > $table->guest_number){
                return back()->with('warning','Please choose the table base on guests');
            }

            $request_time = Carbon::parse($request->res_date)->format('H'); // تحويل الوقت المطلوب إلى سلسلة نصية بتنسيق الوقت

               foreach ($table->reservation as $res) {
                // تحويل قيمة $res->res_date إلى سلسلة نصية بتنسيق الوقت
                 $resTime = Carbon::parse($res->res_date)->format('H');
                       if ($resTime === $request_time) {
                       return back()->with('warning', 'This table is reserved for this time.');
                }
              }

        Reservations::create($request->validated());

        return to_route('admin.reservation.index')->with('success', 'Resrervtion created successfuly.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservations $reservation)
    {
        $tables = Table::where('status',TableStatus::Avaliable)->get();
        return view('admin.reservation.edit', compact('reservation', 'tables'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(ReservationStoreRequest $request, Reservations $reservation)
    {
        $table = Table::findOrFail($request->table_id);
        if ($request->guest_number > $table->guest_number) {
            return back()->with('warning', 'Please choose the table base on guests.');
        }
        $request_time = Carbon::parse($request->res_date); // تحويل الوقت المطلوب إلى سلسلة نصية بتنسيق الوقت
        $reservations = $table->reservation()->where('id', '!=', $reservation->id)->get();
        foreach ($reservations as $res) {
         // تحويل قيمة $res->res_date إلى سلسلة نصية بتنسيق الوقت
          $resTime = Carbon::parse($res->res_date)->format('H');
                if ($resTime === $request_time) {
                return back()->with('warning', 'This table is reserved for this time.');
         }
       }

        $reservation->update($request->validated());
        return to_route('admin.reservation.index')->with('success', 'Reservation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservations $reservation)
    {
        $reservation->delete();

        return to_route('admin.reservation.index')->with('danger', 'Reservation deleted successfully.');
    }
}
