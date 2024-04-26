<div class="chat-header clearfix">
    @include('chat._header')
</div>
<div class="chat-history">
    @include('chat._chat')
</div>
<div class="chat-message clearfix">
    <form action="" id="submit_message" method="POST" class=" mb-0" enctype="multipart/form-data">

        @csrf
        {{-- @method('GET') --}}
        <input type="hidden" id="receiver_id" value="{{ $getReceiver->id }}" name="receiver_id">
        <textarea name="message" id="ClearMessage" class="form-control emojionearea" required></textarea>
        <div class="row">
            <div class="col-md-8 hidden-sm">
                <a href="javascript:void(0);" id="OpenFile" style="margin-top:10px;" class="btn btn-outline-primary"><i
                        class="fa fa-image"></i></a>
                <input type="file" name="file_name" id="file_name" style="display: none;">
                <span id="getFileName"></span>
            </div>
            <div class="col-md-4" style="text-align:right;">
                <button class="btn btn-primary" style="margin-top:10px;" type="submit">Send</button>
            </div>
        </div>
    </form>
</div>
