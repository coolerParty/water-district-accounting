<?php

namespace App\Http\Controllers;

use App\Models\AccountChart;
use App\Models\AnnualBudget;
use Illuminate\Http\Request;

class AnnualBudgetController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('annual-budget-show');

        $budgets = AnnualBudget::with('accountChart')->paginate(10);

        $accounts = AccountChart::select('id', 'code', 'name')->orderBy('code', 'ASC')->orderBy('name', 'ASC')->get();

        return view('annual-budget.index', compact('budgets', 'accounts'));
    }

    public function store(Request $request)
    {
        $this->authorize('annual-budget-create');

        $this->validate($request, [
            'amount'      => ['required', 'numeric'],
            'budget_year' => ['required', 'digits:4', 'integer','min:1900', 'max:2099'],
            'accountCode' => ['required', 'integer'],
        ]);

        $account = AnnualBudget::create([
            'accountchart_id' => $request->input('accountCode'),
            'budget_year'     => $request->input('budget_year'),
            'amount'          => $request->input('amount'),
        ]);

        return redirect()->route('annual-budget.index')
            ->with('create-success', 'Account "' . $account->accountChart->name . '" has been added to Annual Budget successfully.');
    }

    public function edit($id)
    {
        $this->authorize('annual-budget-edit');

        $budget = AnnualBudget::find($id);
        $accounts = AccountChart::select('id', 'code', 'name')->orderBy('code', 'ASC')->orderBy('name', 'ASC')->get();
        return view('annual-budget.edit', compact('budget','accounts'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('annual-budget-edit');

        $this->validate($request, [
            'amount'      => ['required', 'numeric'],
            'budget_year' => ['required', 'digits:4', 'integer','min:1900', 'max:2099'],
            'accountCode' => ['required', 'integer'],
        ]);

        $budget                  = AnnualBudget::find($id);
        $budget->amount          = $request->input('amount');
        $budget->budget_year     = $request->input('budget_year');
        $budget->accountchart_id = $request->input('accountCode');
        $budget->save();

        return redirect()->route('annual-budget.index')
            ->with('update-success', 'Account "' . $budget->accountChart->name  . '" has been updated successfully.');
    }

    public function destroy($id)
    {
        $this->authorize('annual-budget-delete');

        AnnualBudget::find($id)->delete();

        return redirect()->route('annual-budget.index')
            ->with('delete-success', 'Account has been removed successfully');
    }

}
