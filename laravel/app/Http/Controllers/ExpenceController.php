<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Membership;
use App\Models\Category;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\DeleteExpenseRequest;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $membership = Membership::where('user_id', $user->id)
            ->whereNull('left_at')
            ->with('colocation')
            ->first();

        if (!$membership) {
            return redirect()->route('user.dashboard')->with('error', 'Rejoignez une colocation d\'abord.');
        }

        $colocId = $membership->colocation_id;

        $members = Membership::where('colocation_id', $colocId)->whereNull('left_at')->with('user')->get();
        $expenses = Expense::where('colocation_id', $colocId)->with(['category', 'payer'])->orderBy('date', 'desc')->get();
        $categories = Category::where('colocation_id', $colocId)->get();

        $totalSpent = $expenses->sum('amount');
        $memberCount = $members->count();
        $share = $memberCount > 0 ? $totalSpent / $memberCount : 0;

        $balances = $members->map(function ($m) use ($expenses, $share) {
            $userPaid = $expenses->where('payer_id', $m->user_id)->sum('amount');
            return [
                'user_id' => $m->user_id,
                'name'    => $m->user->name,
                'paid'    => $userPaid,
                'balance' => $userPaid - $share,
            ];
        });

        return view('user.expenses', compact('expenses', 'categories', 'totalSpent', 'share', 'balances', 'membership'));
    }

    public function store(StoreExpenseRequest $request)
    {
        $membership = Membership::where('user_id', Auth::id())
            ->whereNull('left_at')
            ->firstOrFail();

        Expense::create([
            'title'         => $request->title,
            'amount'        => $request->amount,
            'date'          => $request->date,
            'categorie_id'  => $request->categorie_id,
            'colocation_id' => $membership->colocation_id,
            'payer_id'      => Auth::id(),
        ]);

        return back()->with('success', 'Dépense ajoutée avec succès.');
    }

    public function destroy(DeleteExpenseRequest $request, Expense $expense)
    {
        $expense->delete();
        return back()->with('success', 'Dépense supprimée.');
    }
}
