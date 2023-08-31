<div>
    <ul>
    @foreach($songs as $song)
        <li>
            {{ $song->request }}
            {{ $song->requester }}
        </li>
    @endforeach
    </ul>
</div>