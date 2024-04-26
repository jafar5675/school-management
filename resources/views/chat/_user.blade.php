@foreach ($getChatUser as $user)
    <li class="clearfix getChatWindows @if (!empty($receiver_id)) @if ($receiver_id == $user['user_id']) @endif @endif"
        id="{{ $user['user_id'] }}">
        {{-- <a href="{{ url('chat?receiver_id=' . base64_encode($user['user_id'])) }}"> --}}
        <img src="{{ $user['profile_pic'] }}" alt="avatar">
        <div class="about">
            <div class="name">{{ $user['name'] }}
                @if (!empty($user['messagecount']))
                    <span id="ClearMessage{{ $user['user_id'] }}"
                        style="background:green;color:#fff;border-radius:5px;padding:1px 7px;">
                        {{ $user['messagecount'] }}
                    </span>
                @endif
            </div>
            <div class="status">
                @if (!empty($user['is_online']))
                    <i class="fa fa-circle online"></i>
                @else
                    <i class="fa fa-circle offline"></i>
                @endif
                {{ Carbon\Carbon::parse($user['created_date'])->diffForHumans() }}
            </div>
        </div>
        {{-- </a> --}}
    </li>
@endforeach
{{-- <li class="clearfix active">
    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
    <div class="about">
        <div class="name">Aiden Chavez</div>
        <div class="status"> <i class="fa fa-circle online"></i> online </div>
    </div>
</li> --}}
