@foreach ($object->notes()->protect(auth()->user())->orderBy('created_at', 'desc')->get() as $note)
    <div class="direct-chat-msg" id="note-{{ $note->id }}">
        <div class="direct-chat-info clearfix">
            <span class="direct-chat-name float-left">{{ $note->user->name }}</span>
            <span class="direct-chat-scope float-right">
                @if (!auth()->user()->client_id)
                    <a href="javascript:void(0)" class="delete-note" data-note-id="{{ $note->id }}">@lang('bt.trash')</a>
                @endif
            </span>
            @if (isset($showPrivateCheckbox) and $showPrivateCheckbox == true)
                <span class="direct-chat-scope float-right">
                @if ($note->private)
                    <span class="badge badge-danger">@lang('bt.private')</span>
                @else
                    <span class="badge badge-success">@lang('bt.public')</span>
                @endif
            </span>
            @endif
            <span class="direct-chat-timestamp float-right">
                {{ $note->formatted_created_at }}
            </span>
        </div>
        <img class="direct-chat-img" src="{{ profileImageUrl($note->user) }}" alt="message user image">
        <div class="direct-chat-text">
            {!! $note->formatted_note !!}
        </div>
    </div>
@endforeach
