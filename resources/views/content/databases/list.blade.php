@extends('layouts/contentNavbarLayout')
@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Databases</span>
</h4>
<!-- Databases Table -->
<div class="card p-2">
  <div class="table-responsive text-nowrap">
    <!-- Database Add Modal Open Button -->
    <div class="d-flex justify-content-end">
      <button type="button" class="btn btn-icon btn-success" data-bs-toggle="modal" data-bs-target="#databaseAddModal">
        <span class="tf-icons bx bx-plus-medical"></span>
      </button>
    </div>
    <!-- Database Add Modal Open Button -->
    <table id="databasesTable" class="table table-striped">
      <thead>
        <tr>
          <th>Cluster Name</th>
          <th>Database Name</th>
          <th>IP</th>
          <th>Port</th>
          <th>User</th>
          <th>Password</th>
          <th>Last Backup</th>
          <th>Period Hour</th>
          <th>Actions</th>
        </tr>
      </thead>
      <!-- Databases Table Rows -->
      <tbody class="table-border-bottom-0">
        @if(isset($databases[0]))
        @foreach($databases as $key => $database)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$database->c_name}}</strong></td>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$database->db_name}}</strong></td>
          <td><span class="badge bg-label-secondary me-1">{{$database->ip}}</span></td>
          <td><span class="badge bg-label-primary me-1">{{$database->port}}</span></td>
          <td>{{$database->user}}</td>
          <td>{{$database->password}}</td>
          <td>{{$database->last_backup}}</td>
          <td><span class="badge bg-label-warning me-1">{{$database->period_hour}}</span></td>
          <td class="d-flex justify-content-start">
            <!-- Databases Delete Button -->
            <form class="pe-2" action="{{ route('databases.delete', ['id'=>$database->id]) }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-icon btn-danger">
                <span class="tf-icons bx bx-trash"></span>
              </button>
            </form>
            <!-- Databases Delete Button -->
            <!-- Databases Update Modal Open Button -->
            <button type="button" class="btn btn-icon btn-primary" onclick="getDatabases('{{$database->id}}')" data-bs-toggle="modal" data-bs-target="#databaseUpdateModal">
              <span class="tf-icons bx bx-edit-alt"></span>
            </button>
            <!-- Databases Update Modal Open Button -->
          </td>
        </tr>
        @endforeach

        @else
        <tr>
          <td><b>Database Data Not Found !</b></td>
        </tr>
        @endif
      </tbody>
      <!-- Databases Table Rows -->
    </table>
  </div>
</div>
<!--/ Databases Table -->

<!-- Database Add Modal -->
@include('content/databases/modals/databasesCreateModal')
<!-- Database Add Modal -->

<!-- Database Update Modal -->
@include('content/databases/modals/databasesUpdateModal')
<!-- Database Update Modal -->

<script>
  $('#databasesTable').DataTable({
    dom: '<"top"lBf>rt<"bottom"ip><"clear">',
    buttons: [
      'excel', 'pdf', 'print'
    ]
  });

  const getDatabases = (id) => {
    const databases = <?php echo json_encode($databases);  ?>;
    const getDatabases = databases.find((item) => item?.id == id)
    const uc_name = document.getElementById('uc_name');
    const udb_name = document.getElementById('udb_name');
    const u_ip = document.getElementById('u_ip');
    const u_port = document.getElementById('u_port');
    const u_user = document.getElementById('u_user');
    const u_password = document.getElementById('u_password');
    const u_last_backup = document.getElementById('u_last_backup');
    const u_period_hour = document.getElementById('u_period_hour');
    const u_databases_id = document.getElementById('u_databases_id')

    uc_name.value = getDatabases.c_name
    udb_name.setAttribute('value', getDatabases.db_name)
    u_ip.setAttribute('value', getDatabases.ip)
    u_port.setAttribute('value', getDatabases.port)
    u_user.setAttribute('value', getDatabases.user)
    u_password.setAttribute('value', getDatabases.password)
    u_last_backup.setAttribute('value', getDatabases.last_backup)
    u_period_hour.setAttribute('value', getDatabases.period_hour)
    u_databases_id.setAttribute('value', id)
  }
</script>
@endsection