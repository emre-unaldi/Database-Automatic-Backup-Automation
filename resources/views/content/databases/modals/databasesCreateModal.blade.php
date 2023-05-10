<!-- Database Add Modal -->
<div class="modal fade" id="databaseAddModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="databaseAddModalTitle">Database Add</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('databases.create') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="row g-2">
            <div class="col mb-2">
              <label for="c_name" class="form-label">Cluster Name</label>
              <select class="form-select" id="c_name" name="c_name" onchange="setClusterChangeHandle()" aria-label="Default select example">
                <option>No Clusters</option>
                  @foreach($clusterFilter as $cluster)
                    <option value="{{ $cluster }}">{{ $cluster }}</option>
                  @endforeach
              </select>
            </div>
            <div class="col mb-2">
              <label for="db_name" class="form-label">Database Name</label>
              <input type="text" id="db_name" name="db_name" class="form-control" placeholder="...">
            </div>
          </div>
          <div>
            <input type="hidden" id="selectedCluster" name="selectedCluster" class="form-control" value="false">
          </div>
          <div class="row g-2">
            <div class="col mb-2">
              <label for="ip" class="form-label">Ip</label>
              <input type="text" id="ip" name="ip" class="form-control" placeholder="...">
            </div>
            <div class="col mb-2">
              <label for="port" class="form-label">Port</label>
              <input type="text" id="port" name="port" class="form-control" placeholder="...">
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-2">
              <label for="user" class="form-label">User</label>
              <input type="text" id="user" name="user" class="form-control" placeholder="...">
            </div>
            <div class="form-password-toggle col mb-2">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" class="form-control getPassword" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password" />
                <span class="input-group-text cursor-pointer" id="password"><i class="bx bx-hide"></i></span>
              </div>
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-2">
              <label for="backup_max_count" class="form-label">Backup Max Count</label>
              <div class="input-group">
                <input type="number" id="backup_max_count" name="backup_max_count" class="form-control" placeholder=".." aria-describedby="backup_max_count" aria-label="backup_max_count" />
                <span class="input-group-text" id="backup_max_count">Records</span>
              </div>
            </div>
            <div class="col mb-2">
              <label for="period_hour" class="form-label">Period Hour</label>
              <div class="input-group">
                <input type="number" id="period_hour" name="period_hour" class="form-control" placeholder=".." aria-describedby="period_hour" aria-label="period_hour" />
                <span class="input-group-text" id="period_hour">Hour</span>
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