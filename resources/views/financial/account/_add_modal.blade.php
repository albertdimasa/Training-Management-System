<!-- Add Account Modal -->
<div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('financial.account.store') }}" method="POST" class="w-100">
                @csrf
                <div class="modal-header">
                    <h3 class="modal-title fs-5">Tambah Akun Baru</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kode Akun</label>
                            <input type="text" class="form-control" name="account_code" placeholder="1000" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Akun</label>
                            <input type="text" class="form-control" name="account_name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipe Akun</label>
                            <select class="form-select" name="account_type" required>
                                <option value="">Pilih Tipe</option>
                                <option value="ASSET">Asset</option>
                                <option value="LIABILITY">Liability</option>
                                <option value="EQUITY">Equity</option>
                                <option value="REVENUE">Revenue</option>
                                <option value="EXPENSE">Expense</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Parent Account</label>
                            <select class="form-select" name="parent_id">
                                <option value="">-- No Parent --</option>
                                @foreach ($parentAccounts as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->account_code }} -
                                        {{ $parent->account_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Normal Side</label>
                            <select class="form-select" name="normal_side" required>
                                <option value="">Pilih</option>
                                <option value="DEBIT">Debit</option>
                                <option value="CREDIT">Credit</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Header</label>
                            <select class="form-select" name="is_header">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
