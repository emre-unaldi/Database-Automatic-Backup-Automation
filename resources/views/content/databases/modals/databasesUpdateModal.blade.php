<!-- Database Add Modal -->
<div class="modal fade" id="databaseUpdateModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="databaseUpdateModalTitle">Database Add</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('databases.update') }}" id="databaseUpdateForm" method="POST">
        @csrf
        <input type="hidden" name="u_databases_id" id="u_databases_id">
        <div class="modal-body">
          <div class="row g-2">
            <div class="col mb-2">
              <label for="uc_name" class="form-label">Cluster Name</label>
              <select class="form-select" id="uc_name" name="uc_name" onchange="setClusterChangeHandle()" aria-label="Default select example">
                <option>No Clusters</option>
                @foreach($clusterFilter as $cluster)
                <option>{{ $cluster }}</option>
                @endforeach
              </select>
            </div>
            <div class="col mb-2">
              <label for="udb_name" class="form-label">Database Name</label>
              <input type="text" id="udb_name" name="udb_name" class="form-control" placeholder="...">
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-2">
              <label for="u_ip" class="form-label">IP</label>
              <input type="text" id="u_ip" name="u_ip" class="form-control" placeholder="...">
            </div>
            <div class="col mb-2">
              <label for="u_port" class="form-label">Port</label>
              <input type="number" id="u_port" name="u_port" class="form-control" placeholder="...">
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-2">
              <label for="user" class="form-label">User</label>
              <input type="text" id="u_user" name="u_user" class="form-control" placeholder="...">
            </div>
            <div class="form-password-toggle col mb-2">
              <label class="form-label" for="u_password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" class="form-control getUpdatePassword" id="u_password" name="u_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password" />
                <span class="input-group-text cursor-pointer" id="u_password"><i class="bx bx-hide"></i></span>
              </div>
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-2">
              <label for="u_backup_max_count" class="form-label">Backup Max Count</label>
              <div class="input-group">
                <input type="number" id="u_backup_max_count" name="u_backup_max_count" class="form-control" placeholder=".." aria-describedby="u_backup_max_count" aria-label="u_backup_max_count" />
                <span class="input-group-text" id="u_backup_max_count">Records</span>
              </div>
            </div>
            <div class="col mb-2">
              <label for="u_period_hour" class="form-label">Period Hour</label>
              <div class="input-group">
                <input type="number" id="u_period_hour" name="u_period_hour" class="form-control" placeholder=".." aria-describedby="u_period_hour" aria-label="u_period_hour" />
                <span class="input-group-text" id="u_period_hour">Hour</span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Database Add Modal -->