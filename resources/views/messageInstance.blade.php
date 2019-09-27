

@foreach($messages as $message)
    @if($message->sender_id == auth()->id() )
        <li>
            <div class="replay d-flex align-items-center ">
                <div class="text col-lg-7">
                    <p class="info">{{ $message->content }} </p>
                    <p class="date pl-3">{{ $message->created_at->format('Y-m-d') }}</p>
                </div>
            </div>
        </li>
    @else
        <li>
            <div class="send d-flex align-items-center ">
                <div class="text col-lg-7 text-right">
                    <p class="info">{{ $message->content }}</p>
                    <p class="date text-right pr-3">{{ $message->created_at->format('Y-m-d') }}</p>
                </div>
            </div>
        </li>
    @endif
@endforeach