<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Colocation;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $colocation = $user->colocations()
            ->wherePivot('left_at', null)
            ->first();

        $hasColocation = false;
        if ($colocation !== null) {
            $hasColocation = true;
        }

        $latestExpenses = collect();
        $membersBalances = collect();
        $totalExpenses = 0;
        $individualShare = 0;
        $colocationName = null;

        if ($colocation !== null) {
            $colocationName = $colocation->name;

            $totalExpenses = $colocation->expenses()->sum('amount');

            $membersCount = $colocation->users()->count();

            if ($membersCount > 0) {
                $individualShare = $totalExpenses / $membersCount;
            } else {
                $individualShare = 0;
            }

            $latestExpenses = $colocation->expenses()
                ->with(['user', 'category'])
                ->latest()
                ->take(5)
                ->get();

            $membersBalances = $colocation->users->map(function ($member) use ($colocation, $individualShare) {

                $amountPaidByMember = $member->expenses()
                    ->where('colocation_id', $colocation->id)
                    ->sum('amount');

                $balance = $amountPaidByMember - $individualShare;

                return [
                    'name'    => $member->name,
                    'paid'    => $amountPaidByMember,
                    'balance' => $balance,
                ];
            });
        }

        return view('dashboard', [
            'hasColocation'   => $hasColocation,
            'colocationName'  => $colocationName,
            'totalExpenses'   => $totalExpenses,
            'individualShare' => $individualShare,
            'membersBalances' => $membersBalances,
            'latestExpenses'  => $latestExpenses
        ]);
    }
}
