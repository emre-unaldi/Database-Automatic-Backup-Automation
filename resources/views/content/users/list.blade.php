@extends('layouts/contentNavbarLayout')
@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Users</span>
</h4>
<!-- Users Table -->
<div class="card">
  <!-- User Add Modal Open Button -->
  <div class="d-flex justify-content-end pt-3 pe-3">
    <button type="button" class="btn btn-icon btn-success" data-bs-toggle="modal" data-bs-target="#userAddModal">
      <span class="tf-icons bx bx-plus-medical"></span>
    </button>
  </div>
  <!-- User Add Modal Open Button -->
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Surname</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Password</th>
          <th>Actions</th>
        </tr>
      </thead>
      <!-- Users Table Rows -->
      <tbody class="table-border-bottom-0">
        @if(isset($users[0]))
        @foreach($users as $key => $user)
        <tr>
          <td>{{$user->name}}</td>
          <td>{{$user->surname}}</td>
          <td>{{$user->phone}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->password}}</td>
          <td class="d-flex justify-content-start">
            <!-- User Delete Button -->
            <form class="pe-2" action="{{ route('users.delete', ['id'=>$user->id]) }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-icon btn-danger">
                <span class="tf-icons bx bx-trash"></span>
              </button>
            </form>
            <!-- User Delete Button -->
            <!-- User Update Modal Open Button -->
            <button type="button" class="btn btn-icon btn-primary" onclick="getUsers('{{$user->id}}')" data-bs-toggle="modal" data-bs-target="#userUpdateModal">
              <span class="tf-icons bx bx-edit-alt"></span>
            </button>
            <!-- User Update Modal Open Button -->
          </td>
        </tr>
        @endforeach
        @else
        <tr>
          <td><b>User Data Not Found !</b></td>
        </tr>
        @endif
      </tbody>
      <!-- Users Table Rows -->
    </table>
  </div>
</div>
<!--/ Users Table -->

<!-- User Add Modal -->
@include('content/users/modals/usersCreateModal')
<!-- User Add Modal -->

<!-- User Update Modal -->
@include('content/users/modals/usersUpdateModal')
<!-- User Update Modal -->

<script>
  const getUsers = (id) => {
    const users = <?php echo json_encode($users);  ?>;
    const getUser = users.find((item) => item?.id == id)
    const u_name = document.getElementById('u_name');
    const u_surname = document.getElementById('u_surname');
    const u_phone = document.getElementById('u_phone');
    const u_email = document.getElementById('u_email');
    const u_password = document.getElementById('u_password');
    const u_user_id = document.getElementById('u_user_id')

    u_name.setAttribute('value', getUser.name)
    u_surname.setAttribute('value', getUser.surname)
    u_phone.setAttribute('value', getUser.phone)
    u_email.setAttribute('value', getUser.email)
    u_password.setAttribute('value', getUser.password)
    u_user_id.setAttribute('value', id)
  }
</script>
@endsection