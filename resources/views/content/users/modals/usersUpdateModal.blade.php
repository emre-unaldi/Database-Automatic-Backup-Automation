<!-- User Update Modal -->
<div class="modal fade" id="userUpdateModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userUpdateModalTitle">User Update</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('users.update') }}" method="POST">
        @csrf
        <input type="hidden" name="u_user_id" id="u_user_id">
        <div class="modal-body">
          <div class="row g-2">
            <div class="col mb-2">
              <label for="u_name" class="form-label">Name</label>
              <input type="text" id="u_name" name="u_name" class="form-control">
            </div>
            <div class="col mb-2">
              <label for="u_surname" class="form-label">Surname</label>
              <input type="text" id="u_surname" name="u_surname" class="form-control">
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-2">
              <label for="u_phone" class="form-label">Phone</label>
              <input type="text" id="u_phone" name="u_phone" class="form-control">
            </div>
            <div class="col mb-2">
              <label for="u_email" class="form-label">Email</label>
              <input type="text" id="u_email" name="u_email" class="form-control">
            </div>
          </div>
          <div class="row g-2">
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
<!-- User Update Modal -->