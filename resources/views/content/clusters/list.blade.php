@extends('layouts/contentNavbarLayout')
@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Clusters</span>
</h4>
<!-- Clusters Table -->
<div class="card p-2">
  <div class="table-responsive text-nowrap">
  <!-- Cluster Add Modal Open Button -->
  <div class="d-flex justify-content-end">
    <button type="button" class="btn btn-icon btn-success" data-bs-toggle="modal" data-bs-target="#clusterAddModal">
      <span class="tf-icons bx bx-plus-medical"></span>
    </button>
  </div>
  <!-- Cluster Add Modal Open Button -->
    <table id="clustersTable" class="table table-striped">
      <thead>
        <tr>
          <th>Cluster Name</th>
          <th>IP</th>
          <th>Port</th>
          <th>User</th>
          <th>Password</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <!-- Clusters Table Rows -->
      <tbody class="table-border-bottom-0">
        @if(isset($clusters[0]))
        @foreach($clusters as $key=>$cluster)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$cluster->cluster}}</strong></td>
          <td><span class="badge bg-label-secondary me-1">{{$cluster->ip}}</span></td>
          <td><span class="badge bg-label-primary me-1">{{$cluster->port}}</span></td>
          <td>{{$cluster->user}}</td>
          <td>{{$cluster->password}}</td>
          <td>{{$cluster->description}}</td>
          <td class="d-flex justify-content-start">
            <!-- Clusters Delete Button -->
            <form class="pe-2" action="{{ route('clusters.delete', ['id'=>$cluster->id]) }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-icon btn-danger">
                <span class="tf-icons bx bx-trash"></span>
              </button>
            </form>
            <!-- Clusters Delete Button -->
            <!-- Cluster Update Modal Open Button -->
            <button type="button" class="btn btn-icon btn-primary" onclick="getClusters('{{$cluster->id}}')" data-bs-toggle="modal" data-bs-target="#clusterUpdateModal">
              <span class="tf-icons bx bx-edit-alt"></span>
            </button>
            <!-- Cluster Update Modal Open Button -->
          </td>
        </tr>
        @endforeach
        @else
        <tr>
          <td><b>Cluster Data Not Found !</b></td>
        </tr>
        @endif
      </tbody>
      <!-- Clusters Table Rows -->
    </table>
  </div>
</div>
<!--/ Clusters Table -->

<!-- Cluster Add Modal -->
@include('content/clusters/modals/clustersCreateModal')
<!-- Cluster Add Modal -->

<!-- Cluster Update Modal -->
@include('content/clusters/modals/clustersUpdateModal')
<!-- Cluster Update Modal -->

<script>
  $('#clustersTable').DataTable({
    dom: '<"top"lBf>rt<"bottom"ip><"clear">',
    buttons: [
      'excel', 'pdf', 'print'
    ]
  });

  const getClusters = (id) => {
    const clusters = <?php echo json_encode($clusters);  ?>;
    const getClusters = clusters.find((item) => item?.id == id)
    const u_ip = document.getElementById('u_ip');
    const u_port = document.getElementById('u_port');
    const u_cluster = document.getElementById('u_cluster');
    const u_description = document.getElementById('u_description');
    const u_user = document.getElementById('u_user');
    const u_password = document.getElementById('u_password');
    const u_clusters_id = document.getElementById('u_clusters_id')

    u_ip.setAttribute('value', getClusters.ip)
    u_port.setAttribute('value', getClusters.port)
    u_cluster.setAttribute('value', getClusters.cluster)
    u_description.setAttribute('value', getClusters.description)
    u_user.setAttribute('value', getClusters.user)
    u_password.setAttribute('value', getClusters.password)
    u_clusters_id.setAttribute('value', id)
  }
</script>
@endsection