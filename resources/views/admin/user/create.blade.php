<form action="{{ route('user.store') }}" method="post">
    @csrf
    <label>
        Name
        <input name="name">
    </label>
    <button>create</button>
</form>