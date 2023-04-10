@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Databases</span>
</h4>

<!-- Databases Rows -->
<div class="card">
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Cluster Id</th>
          <th>Name</th>
          <th>Last Backup</th>
          <th>Period Hour</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>46</strong></td>
          <td>Anadolu</td>
          <td><span class="badge bg-label-secondary me-1">06.04.2023 - 17:00</span></td>
          <td><span class="badge bg-label-primary me-1">24 Hour</span></td>
          <td>
            <button type="button" class="btn btn-icon btn-primary">
              <span class="tf-icons bx bx-edit-alt"></span>
            </button>
            <button type="button" class="btn btn-icon btn-danger">
              <span class="tf-icons bx bx-trash"></span>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<!--/ Databases Rows -->

@endsection
