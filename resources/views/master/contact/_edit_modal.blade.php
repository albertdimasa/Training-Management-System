<!-- Edit Contact Modal -->
<div class="modal fade" id="editContactModal{{ $contact->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('master.contact.update', $contact) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h3 class="modal-title fs-5">Edit Contact</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Client</label>
                            <select class="form-select" name="client_id" required>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}"
                                        {{ $contact->client_id == $client->id ? 'selected' : '' }}>
                                        {{ $client->client_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Contact</label>
                            <input type="text" class="form-control" name="contact_name"
                                value="{{ $contact->contact_name }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $contact->email }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $contact->phone }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jabatan</label>
                            <input type="text" class="form-control" name="role_title"
                                value="{{ $contact->role_title }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Primary Contact</label>
                            <select class="form-select" name="is_primary">
                                <option value="1" {{ $contact->is_primary ? 'selected' : '' }}>Ya</option>
                                <option value="0" {{ !$contact->is_primary ? 'selected' : '' }}>Tidak</option>
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
