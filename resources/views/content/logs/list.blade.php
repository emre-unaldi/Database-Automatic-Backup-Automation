@extends('layouts/contentNavbarLayout')
@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Backup Logs</span>
</h4>

<!-- Logs Table -->
<div class="card p-2">
    <div class="table-responsive text-nowrap">
        <!-- Logs Clear Open Modal Button -->
        <div class="d-flex justify-content-end mb-1" >
            <button type="button" class="btn btn-icon btn-danger ps-2 pe-2 pb-1" data-bs-toggle="modal" data-bs-target="#logsBackDropModal">
                <span class="tf-icons bx bx-trash"></span>
            </button>
        </div>
        <!-- Logs Clear Open Modal Button -->
        <table id="logsTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Cluster Name</th>
                    <th>Database Name</th>
                    <th>Log Message</th>
                    <th>Last Backup</th>
                </tr>
            </thead>
            <!-- Logs Table Rows -->
            <tbody class="table-border-bottom-0">
                @if(isset($logs[0]))
                @foreach($logs as $log)
                <tr>
                    <td><span class="badge bg-label-primary me-1"> <strong>{{$log->c_name}}</strong> </span> </td>
                    <td><span class="badge bg-label-warning me-1"> <strong>{{$log->db_name}}</strong> </span> </td>
                    <td><span class="badge {{ $log->status ? 'bg-label-success' : 'bg-label-danger' }} me-1"> <strong>{{$log->message}}</strong> </span> </td>
                    <td><span class="badge bg-label-secondary me-1"> <strong>{{$log->last_backup}}</strong> </span> </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td><i>null</i></th>
                    <td><i>null</i></th>
                    <td><i>null</i></th>
                    <td><i>null</i></th>
                </tr>
                @endif
            </tbody>
            <!-- Logs Table Rows -->
        </table>
    </div>
</div>
<!--/ Logs Table -->

<script>
    // Logs Actions
    $('#logsTable').DataTable({
        dom: '<"top"lBf>rt<"bottom"ip><"clear">',
        buttons: [
            'pdf', 'print'
        ]
    });
</script>
@endsection

<!-- Database Delete Modal -->
@include('content/logs/modals/logsDeleteModal')
<!-- Database Delete Modal -->
