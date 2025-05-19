<a href="#" data-route="{{ route("chat.messages", ["target_id" => $user->id]) }}" class="d-flex justify-content-between chat-user" data-id="{{ $user->id }}">
    <div class="d-flex flex-row">
    <div>
        <img
        src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
        alt="avatar" class="d-flex align-self-center me-3" width="60">
        <span class="badge bg-success badge-dot"></span>
    </div>

    @php
        $last_message_received = \App\Models\Message::where(function ($query) use ($user) {
                                                        $query->where('user_sender_id', auth()->id())
                                                              ->where('user_receiver_id', $user->id);
                                                    })->orWhere(function ($query) use ($user) {
                                                        $query->where('user_sender_id', $user->id)
                                                              ->where('user_receiver_id', auth()->id());
                                                    })
                                                    ->orderByDesc('created_at')
                                                    ->first();
    @endphp

    <div class="pt-1">
        <p class="fw-bold mb-0 text-info">{{ $user->name }}</p>
        <p class="small text-muted text-dark" id="last_message">{{ $last_message_received->message ?? "" }}</p>
    </div>
    </div>
    <div class="pt-1">
    <p class="small text-muted mb-1 text-dark" id="last_message_time">{{

        ($last_message_received ?
                            ($last_message_received->created_at->diffInMinutes(now()) < 2 ?
                            "Agora" : $last_message_received->created_at->format("H:i"))
                        : "")

    }}</p>
    {{-- <span class="badge bg-danger rounded-pill float-end">3</span> --}}
    </div>
</a>
