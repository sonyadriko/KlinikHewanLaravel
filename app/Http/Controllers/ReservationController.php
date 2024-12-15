<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hewan;
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
        $slotTypes = [
            'pemeriksaan_pagi', 'pemeriksaan_sore',
            'grooming_pagi', 'grooming_sore',
            'pet_hotel'
        ];

        // Fetch slot counts in a single query
        $slots = DB::table('reservasi')
            ->selectRaw('slot_reservasi, COUNT(*) as count')
            ->where('tanggal_reservasi', $tanggal_reservasi)
            ->whereIn('slot_reservasi', $slotTypes)
            ->groupBy('slot_reservasi')
            ->get()
            ->pluck('count', 'slot_reservasi')
            ->toArray();

        // Check if the slot is in the result, if not set it to 0
        $result = [];
        foreach ($slotTypes as $slotType) {
            $result[$slotType] = isset($slots[$slotType]) ? $slots[$slotType] : 0;
        }

        // Special handling for 'pet_hotel' as it has no specific time slot
        $result['pet_hotel'] = DB::table('reservasi')
            ->where('jenis_layanan', 'pet_hotel')
            ->whereIn('status', ['proses', 'pending'])
            ->count();

        return response()->json($result);
    }
}
