<!-- Cluster Add Modal -->
<div class="modal fade" id="clusterAddModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="clusterAddModalTitle">Cluster Add</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('clusters.create') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="row g-2">
            <div class="col mb-2">
              <label for="ip" class="form-label">IP</label>
              <input type="text" id="ip" name="ip" class="form-control" placeholder="...">
            </div>
            <div class="col mb-2">
              <label for="port" class="form-label">Port</label>
              <input type="text" id="port" name="port" class="form-control" placeholder="...">
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-2">
              <label for="cluster" class="form-label">Cluster Name</label>
              <input type="text" id="cluster" name="cluster" class="form-control" placeholder="...">
            </div>
            <div class="col mb-2">
              <label for="description" class="form-label">Description</label>
              <input type="text" id="description" name="description" class="form-control" placeholder="...">
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
                <input type="password" class="form-control" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password" />
                <span class="input-group-text cursor-pointer" id="password"><i class="bx bx-hide"></i></span>
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
<!-- Cluster Add Modal -->