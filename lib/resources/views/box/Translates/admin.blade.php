<div class="container">
    <h1>Package view :: You have {{ count($users) }} user(s)</h1>
    <div class="col-md-8">
        <ul class="list-group">
                <li class="list-group-item">
                    {{ $users["first_name"].' '.$users["last_name"] }}&nbsp;|&nbsp;<a href="mailto:{{ $users["email"] }}">{{ $users["email"] }}</a>
                </li>
        </ul>
    </div>
</div>