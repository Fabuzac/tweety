<h3 class="has-text-weight-bold is-size-3 mb-4">Following</h3>

<ul>
    @foreach(auth()->user()->follows as $user)
    <li class="mb-4">
        <div class="">
            <a class="" href="{{ route('profile', $user) }}">
                <img src="{{ $user->avatar }}" alt="Friend profile picture" class="width-30 rounded-full p-1">

                {{ $user->name }}
            </a>
        </div>
    </li>
    @endforeach
</ul>