@extends('layouts/contentNavbarLayout')
@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Databases</span>
</h4>

@if(session('status'))
  <div class="alert {{ session('status')['success'] ? 'alert-success' : 'alert-danger' }}">
    {{ session('status')['message'] }}
  </div>
@endif

<!-- Databases Table -->
<div class="card p-2">
  <div class="table-responsive text-nowrap">
    <div class="d-flex justify-content-end">
      <!-- FTP Backup Button -->
      <!--
      <form action="{{ route('ftp.upload') }}" method="POST">
        @csrf
        <button type="submit" name="submit" class="btn btn-icon btn-primary w-auto ps-2 pe-2">
          <span class="tf-icons bx bxs-data"></span>FTP Upload
        </button>
      </form>
      -->
      <!-- FTP Backup Button -->
      <!-- Database Add Modal Open Button -->
      <button type="button" class="btn btn-icon btn-success" data-bs-toggle="modal" data-bs-target="#databaseAddModal">
        <span class="tf-icons bx bx-plus-medical"></span>
      </button>
      <!-- Database Add Modal Open Button -->
    </div>
    <table id="databasesTable" class="table table-striped">
      <thead>
        <tr>
          <th>Cluster Name</th>
          <th>Database Name</th>
          <th>Db Fields</th>
          <th>Last Backup</th>
          <th>Period Hour</th>
          <th>Backup Max Count</th>
          <th>Actions</th>
        </tr>
      </thead>
      <!-- Databases Table Rows -->
      <tbody class="table-border-bottom-0">
        @if(isset($databases))
        @foreach($databases as $database)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$database->cluster ?  $database->cluster->cluster : $database->c_name}}</strong></td>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$database->db_name}}</strong></td>
          <td>
            <b>IP : </b><span class="badge bg-label-secondary me-1 font-weight-bold">{{$database->ip ? $database->ip : $database->cluster->ip}}</span><br>
            <b>Port : </b> <span class="badge bg-label-primary me-1">{{$database->port ? $database->port : $database->cluster->port}}</span><br>
            <b>User : </b>{{$database->user ? $database->user : $database->cluster->user}} <br>
            <div class="form-password-toggle">
              <div class="input-group input-group-merge d-flex align-items-center">
                <b class="me-2">Password : </b>
                <input readonly type="password" class="form-control border-0 bg-transparent" id="password" name="password" value="{{$database->c_name === 'No Clusters' ? $database->password : $database->cluster->password}}" />
                <span class="input-group-text cursor-pointer border-0 bg-transparent" id="password"><i class="bx bx-hide"></i></span>
              </div>
            </div>
          </td>
          <td>{{$database->last_backup ? $database->last_backup : 'Not Backup'}}</td>
          <td><span class="badge bg-label-warning me-1">{{$database->period_hour}}</span></td>
          <td><span class="badge bg-label-primary me-1">{{$database->backup_max_count}}</span></td>
          <td>
            <div class="row d-flex justify-content-center">
              <div class="col-md-12">
                <!-- Databases Delete Modal Open Button -->
                <button type="button" class="btn btn-icon btn-danger me-1" data-route="{{route('databases.delete', ['id'=> $database->id]) }}" data-bs-toggle="modal" data-bs-target="#databaseBackDropModal">
                  <span class="tf-icons bx bx-trash"></span>
                </button>
                <!-- Databases Delete Modal Open Button -->
                <!-- Databases Update Modal Open Button -->
                <button type="button" class="btn btn-icon btn-primary" onclick="getDatabases('{{$database->id}}')" data-bs-toggle="modal" data-bs-target="#databaseUpdateModal">
                  <span class="tf-icons bx bx-edit-alt"></span>
                </button>
                <!-- Databases Update Modal Open Button -->
              </div>
              <div class="col-md-12 pt-2">
                <!-- Databases Backup Button -->
                <form action="{{ route('databases.backup', ['id'=>$database->id, 'trigger'=>'manual']) }}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-icon btn-warning w-auto ps-2 pe-2">
                    <span class="tf-icons bx bxs-data"></span>Backup
                  </button>
                </form>
                <!-- Databases Backup Button -->
              </div>
            </div>
          </td>
        </tr>
        @endforeach
        @else
        <tr>
          <td><i>null</i></th>
          <td><i>null</i></th>
          <td><i>null</i></th>
          <td><i>null</i></th>
          <td><i>null</i></th>
          <td><i>null</i></th>
          <td><i>null</i></th>
        </tr>
        @endif
      </tbody>
      <!-- Databases Table Rows -->
    </table>
  </div>
</div>
<!--/ Databases Table -->

<!-- Clusters Select Filter -->
@php
$clusterFilter = [];
foreach($clusters as $item) {
if(!in_array($item->cluster, $clusterFilter)) {
array_push($clusterFilter, $item->cluster);
}
}
@endphp
<!-- Clusters Select Filter -->

<!-- Database Delete Modal -->
@include('content/databases/modals/databasesDeleteModal')
<!-- Database Delete Modal -->

<!-- Database Add Modal -->
@include('content/databases/modals/databasesCreateModal')
<!-- Database Add Modal -->

<!-- Database Update Modal -->
@include('content/databases/modals/databasesUpdateModal')
<!-- Database Update Modal -->

<script>
  // Datatable Actions
  $('#databasesTable').DataTable({
    dom: '<"top"lBf>rt<"bottom"ip><"clear">',
    buttons: [
      'pdf', 'print'
    ]
  });

  // Datatable Backup Succes Message Remove
  setTimeout(function() {
    $('.alert-success').remove();
  }, 5000);

  // Database Update
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
    const u_databases_id = document.getElementById('u_databases_id');
    const u_backup_max_count = document.getElementById('u_backup_max_count');
    const form = document.getElementById('databaseUpdateForm');
    const inputs = form.getElementsByTagName('input');

    if (getDatabases.cluster) {
      uc_name.value = getDatabases.cluster.cluster
      udb_name.setAttribute('value', getDatabases.db_name)
      u_ip.setAttribute('value', getDatabases.ip)
      u_port.setAttribute('value', getDatabases.port)
      u_user.setAttribute('value', getDatabases.user)
      u_password.setAttribute('value', getDatabases.password === null ? '' : getDatabases.password)
      u_period_hour.setAttribute('value', getDatabases.period_hour.split(' ')[0])
      u_backup_max_count.setAttribute('value', getDatabases.backup_max_count.split(' ')[0])
      u_databases_id.setAttribute('value', id)
    } else {
      uc_name.value = getDatabases.c_name
      udb_name.setAttribute('value', getDatabases.db_name)
      u_ip.setAttribute('value', getDatabases.ip)
      u_port.setAttribute('value', getDatabases.port)
      u_user.setAttribute('value', getDatabases.user)
      u_password.setAttribute('value', getDatabases.password === null ? '' : getDatabases.password)
      u_period_hour.setAttribute('value', getDatabases.period_hour.split(' ')[0])
      u_backup_max_count.setAttribute('value', getDatabases.backup_max_count.split(' ')[0])
      u_databases_id.setAttribute('value', id)
    }

    // If Modal Open Selected Clusters Get Data For Create and Update
    if (uc_name.value === "No Clusters") {

      u_ip.value = getDatabases.ip
      u_port.value = getDatabases.port
      u_user.value = getDatabases.user
      u_password.value = getDatabases.password

      u_ip.disabled = false
      u_port.disabled = false
      u_user.disabled = false
      u_password.disabled = false
    } else {
      setClusterChangeHandle()
    }
  }

  // Selected Clusters Get Data For Create and Update
  const setClusterChangeHandle = () => {
    const clusters = <?php echo json_encode($clusters); ?>;
    const c_name = document.getElementById('c_name');
    const uc_name = document.getElementById('uc_name');
    const ip = document.getElementById('ip');
    const u_ip = document.getElementById('u_ip');
    const port = document.getElementById('port');
    const u_port = document.getElementById('u_port');
    const user = document.getElementById('user');
    const u_user = document.getElementById('u_user');
    const getPassword = document.getElementsByClassName('getPassword')[0];
    const getUpdatePassword = document.getElementsByClassName('getUpdatePassword')[0];
    const selectedCluster = document.getElementById('selectedCluster');
    const empty = '';

    for (var i = 0; i < clusters.length; i++) {
      if (clusters[i].cluster === c_name.value || clusters[i].cluster === uc_name.value) {
        if (clusters[i].cluster === c_name.value) {
          ip.value = clusters[i].ip;
          port.value = clusters[i].port;
          user.value = clusters[i].user;
          getPassword.value = clusters[i].password;
          selectedCluster.value = true;
          ip.disabled = true;
          port.disabled = true;
          user.disabled = true;
          getPassword.disabled = true;
          break;
        }
        if (clusters[i].cluster === uc_name.value) {
          u_ip.value = clusters[i].ip;
          u_port.value = clusters[i].port;
          u_user.value = clusters[i].user;
          getUpdatePassword.value = clusters[i].password;
          selectedCluster.value = true;
          u_ip.disabled = true;
          u_port.disabled = true;
          u_user.disabled = true;
          getUpdatePassword.disabled = true;
          break;
        }
      } else {
        if (clusters[i].cluster !== c_name.value) {
          ip.value = empty;
          port.value = empty;
          user.value = empty;
          getPassword.value = empty;
          selectedCluster.value = false;
          ip.disabled = false;
          port.disabled = false;
          user.disabled = false;
          getPassword.disabled = false;
        }
        if (clusters[i].cluster !== uc_name.value) {
          u_ip.value = empty;
          u_port.value = empty;
          u_user.value = empty;
          getUpdatePassword.value = empty;
          selectedCluster.value = false;
          u_ip.disabled = false;
          u_port.disabled = false;
          u_user.disabled = false;
          getUpdatePassword.disabled = false;
        }
      }
    }
  }

  // elle yedek periyod düzenleme

  // Submit route parameter to database deletion form
  const databaseBackDropModal = document.getElementById('databaseBackDropModal');
  databaseBackDropModal.addEventListener('show.bs.modal', (event) => {
    const modalOpenButton = event.relatedTarget
    const databaseDeleteRoute = modalOpenButton.getAttribute('data-route')
    const databaseDeleteForm = databaseBackDropModal.querySelector('#databaseDeleteForm')
    databaseDeleteForm.action = databaseDeleteRoute
  })
</script>
@endsection