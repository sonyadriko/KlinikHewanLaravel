<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hewan;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ReservationController extends Controller
{
    public function index(){
        $pets = Hewan::all();

        return view('patient.reservation.index', compact('pets'));
    }

    public function getAvailableSlots(Request $request)
    {
        $tanggal_reservasi = $request->input('tanggal_reservasi');
        $service_type = $request->input('service_type');

        // Define slot types
        $slotTypes = [];
        if ($service_type === 'pemeriksaan') {
            $slotTypes = ['pemeriksaan_pagi', 'pemeriksaan_sore'];
        } elseif ($service_type === 'grooming') {
            $slotTypes = ['grooming_pagi', 'grooming_sore'];
        } elseif ($service_type === 'pet_hotel') {
            $slotTypes = ['pet_hotel'];
        }


        // Fetch slot counts in a single query
        $slots = DB::table('reservations')
            ->selectRaw('reservation_slot, COUNT(*) as count')
            ->where('reservation_date', $tanggal_reservasi)
            ->whereIn('reservation_slot', $slotTypes)
            ->groupBy('reservation_slot')
            ->get()
            ->pluck('count', 'reservation_slot')
            ->toArray();

        // Check if the slot is in the result, if not set it to 0
        $result = [];
        foreach ($slotTypes as $slotType) {
            $result[$slotType] = isset($slots[$slotType]) ? $slots[$slotType] : 0;
        }

        // Special handling for 'pet_hotel' as it has no specific time slot
        $result['pet_hotel'] = DB::table('reservations')
            ->where('service_type', 'pet_hotel')
            ->whereIn('status', ['process', 'pending'])
            ->count();

        return response()->json($result);
    }

    public function store(Request $request) {
        // Input validation
        $validated = $request->validate([
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_slot' => 'required|string',
            'pet_id' => 'required|exists:hewans,id',
            'service_type' => 'required|string|in:consultation,grooming,pet_hotel',
        ]);

        $user_id = Auth::id();
        $status = 'pending';

        // Check slot availability
        $count = DB::table('reservations')
            ->where('reservation_date', $validated['reservation_date'])
            ->where('reservation_slot', $validated['reservation_slot'])
            ->where('service_type', $validated['service_type'])
            ->count();

        if ($count < 4) {
            // Slot is available, proceed with the reservation
            Reservation::create([
                'reservation_date' => $validated['reservation_date'],
                'reservation_slot' => $validated['reservation_slot'],
                'hewan_id' => $validated['pet_id'],
                'service_type' => $validated['service_type'],
                'user_id' => $user_id,
                'status' => $status,
            ]);

            // return response()->json([
            //     'status' => 'success',
            //     'message' => 'Reservation Successful!',
            // ]);
            return redirect()->route('patient.dashboard')->with('status', 'success')->with('message', 'Reservation Successful!');
        } else {
            // Slot is full
            return response()->json([
                'status' => 'error',
                'message' => 'The selected slot is full. Please choose another slot.',
            ]);
        }
    }
}
