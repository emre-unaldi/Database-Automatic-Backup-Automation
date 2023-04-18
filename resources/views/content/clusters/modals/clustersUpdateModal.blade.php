<!-- Cluster Update Modal -->
<div class="modal fade" id="clusterUpdateModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="clusterUpdateModalTitle">Cluster Update</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('clusters.update') }}" method="POST">
        @csrf
        <input type="hidden" name="u_clusters_id" id="u_clusters_id">
        <div class="modal-body">
          <div class="row g-2">
            <div class="col mb-2">
              <label for="u_ip" class="form-label">IP</label>
              <input type="text" id="u_ip" name="u_ip" class="form-control">
            </div>
            <div class="col mb-2">
              <label for="u_port" class="form-label">Port</label>
              <input type="text" id="u_port" name="u_port" class="form-control">
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-2">
              <label for="u_cluster" class="form-label">Cluster Name</label>
              <input type="text" id="u_cluster" name="u_cluster" class="form-control">
            </div>
            <div class="col mb-2">
              <label for="u_description" class="form-label">Description</label>
              <input type="text" id="u_description" name="u_description" class="form-control">
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-2">
              <label for="u_user" class="form-label">User</label>
              <input type="text" id="u_user" name="u_user" class="form-control">
            </div>
            <div class="form-password-toggle col mb-2">
              <label class="form-label" for="u_password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" class="form-control" id="u_password" name="u_password" aria-describedby="basic-default-password" />
                <span class="input-group-text cursor-pointer" id="u_password"><i class="bx bx-hide"></i></span>
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
<!-- Cluster Update Modal -->