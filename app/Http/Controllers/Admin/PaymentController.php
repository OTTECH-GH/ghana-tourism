<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Payment;
use App\Models\Payout;
use App\Models\Refund;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $payments = $query->latest()->paginate(20);
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');
        $totalCommissions = Commission::sum('amount');

        return view('admin.payments.index', compact('payments', 'totalRevenue', 'totalCommissions'));
    }

    public function refunds()
    {
        $refunds = Refund::with(['user', 'payment'])->latest()->paginate(20);
        return view('admin.payments.refunds', compact('refunds'));
    }

    public function payouts()
    {
        $payouts = Payout::with('user')->latest()->paginate(20);
        return view('admin.payments.payouts', compact('payouts'));
    }
}
