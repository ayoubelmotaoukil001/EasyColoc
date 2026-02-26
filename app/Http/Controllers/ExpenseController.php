<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreExpenseRequest ;
use App\Models\Expense ;
use App\Models\Category ;

class ExpenseController extends Controller
{
    public function store(Request $request)
{
    $user = auth()->user();
    $colocation = $user->colocations()->wherePivot('left_at', null)->first();

    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'entry_date' => 'required|date',
    ]);

    \App\Models\Expense::create([
        'title' => $validatedData['title'],
        'amount' => $validatedData['amount'],
        'category_id' => $validatedData['category_id'],
        'user_id' => $user->id,
        'colocation_id' => $colocation->id,
        'entry_date' => $validatedData['entry_date'],
    ]);

    return redirect()->route('dashboard');
}
    public function create()
    {
        $categories = Category::all() ;
        return view('expenses.create' , compact('categories')) ;
    }
}
