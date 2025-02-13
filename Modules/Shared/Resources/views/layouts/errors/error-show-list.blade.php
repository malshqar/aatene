@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @forelse ($errors->all() as $error)
        <li class="text-dark">{{ $error }}</li>
        @empty

        @endforelse
    </ul>
</div>
@endif
