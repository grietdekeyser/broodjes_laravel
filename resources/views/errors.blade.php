@if ($errors->any())
    <br>
    <div class="text-danger">
        <dl>
            @foreach ($errors->all() as $error)
                <dd>{{ $error }}</dd>
            @endforeach
        </ul>
    </div>
@endif
