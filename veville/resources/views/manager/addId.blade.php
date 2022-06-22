<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" hidden value="{{ $users[0]->id }}" name="user_id">
</form>
