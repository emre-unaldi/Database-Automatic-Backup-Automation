<!-- User Add Modal -->
<div class="modal fade" id="userAddModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userAddModalTitle">User Add</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('users.create') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="row g-2">
            <div class="col mb-2">
              <label for="name" class="form-label">Name</label>
              <input type="text" id="name" name="name" class="form-control" placeholder="...">
            </div>
            <div class="col mb-2">
              <label for="surname" class="form-label">Surname</label>
              <input type="text" id="surname" name="surname" class="form-control" placeholder="...">
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-2">
              <label for="phone" class="form-label">Phone</label>
              <input type="text" id="phone" name="phone" class="form-control" placeholder="...">
            </div>
            <div class="col mb-2">
              <label for="email" class="form-label">Email</label>
              <input type="text" id="email" name="email" class="form-control" placeholder="...">
            </div>
          </div>
          <div class="row g-2">
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
<!-- User Add Modal -->