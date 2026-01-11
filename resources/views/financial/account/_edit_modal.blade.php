<!-- Edit Account Modal -->
<div class="modal fade" id="editAccountModal{{ $account->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('financial.account.update', $account) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h3 class="modal-title fs-5">Edit Akun</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kode Akun</label>
                            <input type="text" class="form-control" name="account_code"
                                value="{{ $account->account_code }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Akun</label>
                            <input type="text" class="form-control" name="account_name"
                                value="{{ $account->account_name }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipe Akun</label>
                            <select class="form-select" name="account_type" required>
                                <option value="ASSET"
                                    {{ $account->account_type?->value == 'ASSET' ? 'selected' : '' }}>Asset</option>
                                <option value="LIABILITY"
                                    {{ $account->account_type?->value == 'LIABILITY' ? 'selected' : '' }}>Liability
                                </option>
                                <option value="EQUITY"
                                    {{ $account->account_type?->value == 'EQUITY' ? 'selected' : '' }}>Equity</option>
                                <option value="REVENUE"
                                    {{ $account->account_type?->value == 'REVENUE' ? 'selected' : '' }}>Revenue</option>
                                <option value="EXPENSE"
                                    {{ $account->account_type?->value == 'EXPENSE' ? 'selected' : '' }}>Expense</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Parent Account</label>
                            <select class="form-select" name="parent_id">
                                <option value="">-- No Parent --</option>
                                @foreach ($parentAccounts as $parent)
                                    <option value="{{ $parent->id }}"
                                        {{ $account->parent_id == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->account_code }} - {{ $parent->account_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Normal Side</label>
                            <select class="form-select" name="normal_side" required>
                                <option value="DEBIT"
                                    {{ $account->normal_side?->value == 'DEBIT' ? 'selected' : '' }}>Debit</option>
                                <option value="CREDIT"
                                    {{ $account->normal_side?->value == 'CREDIT' ? 'selected' : '' }}>Credit</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Is Header?</label>
                            <select class="form-select" name="is_header">
                                <option value="1" {{ $account->is_header ? 'selected' : '' }}>Ya</option>
                                <option value="0" {{ !$account->is_header ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
