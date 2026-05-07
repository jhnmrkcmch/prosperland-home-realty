<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Property Management List</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Property ID</th>
                            <th scope="col">Type</th>
                            <th scope="col">Commission</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <tr>
                            <td>1</td>
                            <td class="fw-bold text-uppercase">PROP-78921</td>
                            <td><span class="badge bg-info text-dark">Residential</span></td>
                            <td>5.00%</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary">Edit</button>
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td class="fw-bold text-uppercase">COMM-44512</td>
                            <td><span class="badge bg-success">Commercial</span></td>
                            <td>3.50%</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary">Edit</button>
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>