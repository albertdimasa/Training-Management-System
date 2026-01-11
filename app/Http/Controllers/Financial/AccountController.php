<?php

namespace App\Http\Controllers\Financial;

use App\Http\Controllers\Controller;
use App\Models\Financial\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::with('parent')->orderBy('account_code')->paginate(20);
        $parentAccounts = Account::where('is_header', true)->get();
        return view('financial.account.index', compact('accounts', 'parentAccounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'account_code' => 'required|string|unique:accounts,account_code',
            'account_name' => 'required|string|max:255',
            'account_type' => 'required|in:ASSET,LIABILITY,EQUITY,REVENUE,EXPENSE',
            'is_header' => 'boolean',
            'parent_id' => 'nullable|exists:accounts,id',
            'normal_side' => 'required|in:DEBIT,CREDIT',
        ]);

        $validated['is_header'] = (bool) $request->input('is_header', 0);

        Account::create($validated);

        return redirect()->route('financial.account')->with('success', 'Akun berhasil ditambahkan!');
    }

    public function update(Request $request, Account $account)
    {
        $validated = $request->validate([
            'account_code' => 'required|string|unique:accounts,account_code,' . $account->id,
            'account_name' => 'required|string|max:255',
            'account_type' => 'required|in:ASSET,LIABILITY,EQUITY,REVENUE,EXPENSE',
            'is_header' => 'boolean',
            'parent_id' => 'nullable|exists:accounts,id',
            'normal_side' => 'required|in:DEBIT,CREDIT',
        ]);

        $validated['is_header'] = (bool) $request->input('is_header', 0);

        $account->update($validated);

        return redirect()->route('financial.account')->with('success', 'Akun berhasil diperbarui!');
    }

    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('financial.account')->with('success', 'Akun berhasil dihapus!');
    }
}
