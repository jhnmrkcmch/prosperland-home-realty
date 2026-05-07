@extends('layouts.adminLayout')

@section('title', 'Dashboard')

@section('hideMainNavbar', true)
@section('hideFooter', true)

@section('content')
<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Accounts</h1>
        <button class="btn btn-primary btn-sm" id="addAccount-btn">
            <i class="bi bi-plus-lg me-1"></i> Add Account
        </button>
    </div>

    <table id="data-table" class="table table-dark table-hover table-bordered">
        <thead></thead>
        <tbody></tbody>
    </table>
</div>

<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="addAccount" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addForm">
                @csrf
                <div class="modal-body">
                    <div id="add-errors" class="alert alert-danger d-none"></div>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Age</label>
                            <input type="number" class="form-control" name="age" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Role</label>
                            <select class="form-select" name="role" required>
                                <option value="user">User</option>
                                <option value="editor">Editor</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Account</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="exampleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Account Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="edit-errors" class="alert alert-danger d-none"></div>
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">ID</label>
                            <input type="text" class="form-control" id="accID" readonly>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Role</label>
                            <select class="form-select" id="edit-role">
                                <option value="user">User</option>
                                <option value="editor">Editor</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit-name">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit-email">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Age</label>
                            <input type="number" class="form-control" id="edit-age">
                        </div>
                        <div class="col-12">
                            <label class="form-label">New Password (Leave blank to keep current)</label>
                            <input type="password" class="form-control" id="edit-password">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="update">Update Changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this account?
                <input type="hidden" id="id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abort</button>
                <button type="button" class="btn btn-danger" id="delete">Proceed</button>
            </div>
        </div>
    </div>
</div>

<script>
function reload() {
    fetch("{{ route('accounts.data') }}")
        .then(res => res.json())
        .then(data => {
            const table = document.getElementById('data-table');
            const thead = table.querySelector('thead');
            const tbody = table.querySelector('tbody');

            thead.innerHTML = `
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>`;
            
            tbody.innerHTML = '';

            data.forEach(user => {
                const row = tbody.insertRow();
                row.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.age}</td>
                    <td><span class="badge bg-secondary">${user.role}</span></td>
                    <td class="text-center">
                        <button class="btn btn-success btn-sm me-1" onclick='editUser(${JSON.stringify(user)})'>
                            <i class="bi bi-pen"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(${user.id})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                `;
            });
        });
}

reload();

// Open Add Modal
document.getElementById('addAccount-btn').addEventListener('click', () => {
    new bootstrap.Modal(document.getElementById('addAccount')).show();
});

// Submit Add Form
document.getElementById('addForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const errorDiv = document.getElementById('add-errors');
    errorDiv.classList.add('d-none'); // Hide previous errors

    fetch('/accounts', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        body: new FormData(this)
    })
    .then(async res => {
        const data = await res.json();
        if (!res.ok) {
            // This is where validation errors are handled
            if (res.status === 422) {
                let errorHtml = '<ul class="mb-0">';
                Object.values(data.errors).forEach(err => {
                    errorHtml += `<li>${err}</li>`;
                });
                errorHtml += '</ul>';
                errorDiv.innerHTML = errorHtml;
                errorDiv.classList.remove('d-none');
            }
            throw new Error('Validation Failed');
        }
        return data;
    })
    .then(() => {
        this.reset();
        reload();
        bootstrap.Modal.getInstance(document.getElementById('addAccount')).hide();
    })
    .catch(err => console.log(err));
});

// Edit Logic
function editUser(user) {
    document.getElementById('accID').value = user.id;
    document.getElementById('edit-name').value = user.name || '';
    document.getElementById('edit-email').value = user.email || '';
    document.getElementById('edit-age').value = user.age || '';
    document.getElementById('edit-role').value = user.role || 'user';
    document.getElementById('edit-password').value = '';

    new bootstrap.Modal(document.getElementById('exampleModal')).show();
}

// Update Logic
document.getElementById('update').addEventListener('click', () => {
    const id = document.getElementById('accID').value;
    const errorDiv = document.getElementById('edit-errors');
    errorDiv.classList.add('d-none');

    const formData = new FormData();
    formData.append('name', document.getElementById('edit-name').value);
    formData.append('email', document.getElementById('edit-email').value);
    formData.append('age', document.getElementById('edit-age').value);
    formData.append('password', document.getElementById('edit-password').value);
    formData.append('role', document.getElementById('edit-role').value);
    formData.append('_method', 'PUT');

    fetch(`/accounts/${id}`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        body: formData
    })
    .then(async res => {
        const data = await res.json();
        if (!res.ok) {
            if (res.status === 422) {
                let errorHtml = '<ul class="mb-0">';
                Object.values(data.errors).forEach(err => {
                    errorHtml += `<li>${err}</li>`;
                });
                errorHtml += '</ul>';
                errorDiv.innerHTML = errorHtml;
                errorDiv.classList.remove('d-none');
            }
            throw new Error('Update Failed');
        }
        return data;
    })
    .then(() => {
        bootstrap.Modal.getInstance(document.getElementById('exampleModal')).hide();
        reload();
    })
    .catch(err => console.log(err));
});
// Delete Logic
function confirmDelete(id) {
    document.getElementById('id').value = id;
    new bootstrap.Modal(document.getElementById('staticBackdrop')).show();
}

document.getElementById('delete').addEventListener('click', () => {
    const id = document.getElementById('id').value;
    fetch(`/accounts/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    })
    .then(() => {
        bootstrap.Modal.getInstance(document.getElementById('staticBackdrop')).hide();
        reload();
    });
});


</script>

@endsection