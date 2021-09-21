<div class="statbar">
    <h3>Top User</h3>
    @foreach($users as $user)
    <div class="d-flex mb-2">
        <img src="/img/profile-user.png" class="profile-pic mr-2" alt="">
        <div class="username text-primary mr-5">{{$user->name}}</div>
        <div class="d-flex align-items-center"><div class="mr-2">{{$user->reputation}}</div> <img src="/img/up-arrow.png" style="width: 1rem; height: 1rem;" alt=""></div>
    </div>
    @endforeach
</div>