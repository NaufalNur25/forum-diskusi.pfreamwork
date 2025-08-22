<div class="flex items-start space-x-4">
    <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random&color=fff"
        alt="Avatar" class="flex-shrink-0 rounded-full h-12 w-12">
    <div class="w-full">
        <div class="bg-slate-100 rounded-lg p-3">
            <div class="flex justify-between items-center">
                <span class="font-semibold text-slate-800">{{ $comment->user->name }}</span>
                <small class="text-slate-500 text-xs">{{ $comment->created_at->diffForHumans() }}</small>
            </div>
            @if ($comment->comment)
                <p class="text-slate-700 mt-1">{{ $comment->comment }}</p>
            @endif
            @if ($comment->content)
                <div class="mt-2">
                    <a href="{{ asset('storage/' . $comment->content) }}" target="_blank">
                        <img src="{{ asset('storage/' . $comment->content) }}" class="rounded-lg max-w-xs"
                            alt="Gambar Komentar">
                    </a>
                </div>
            @endif
        </div>

        <div class="mt-1">
            <button type="button" onclick="toggleReplyForm('comment-{{ $comment->comment_id }}')"
                class="bg-transparent border-none p-0 text-xs text-blue-600 font-semibold hover:underline">Balas</button>
        </div>

        <div class="mt-3 hidden" id="reply-form-comment-{{ $comment->comment_id }}">
            <form action="{{ route('answers.store', $comment) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <textarea class="w-full border-slate-300 rounded-md shadow-sm text-sm" name="answer" rows="2"
                    placeholder="Tulis balasan..."></textarea>
                <div class="flex justify-between items-center mt-2">
                    <input type="file" name="content"
                        class="text-sm text-slate-500 file:mr-2 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <button type="submit"
                        class="bg-blue-600 text-white font-semibold px-3 py-1.5 text-sm rounded-lg shadow-sm hover:bg-blue-700">
                        Kirim Balasan
                    </button>
                </div>
            </form>
        </div>

        <div class="space-y-4 mt-4 border-l-2 border-slate-200 pl-4">
            @foreach ($comment->answers->sortBy('created_at') as $answer)
                <div class="flex items-start space-x-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($answer->user->name) }}&background=random&color=fff"
                        alt="Avatar" class="rounded-full h-10 w-10 flex-shrink-0">
                    <div class="w-full">
                        <div class="bg-slate-50 rounded-lg p-2">

                            <div class="text-xs text-slate-500 mb-1">
                                Membalas kepada <strong class="font-semibold text-slate-600">
                                    {{-- Jika ada parent answer, tampilkan nama authornya. Jika tidak, tampilkan nama author komentar utama. --}}
                                    {{ $answer->parent ? $answer->parent->user->name : $comment->user->name }}
                                </strong>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-slate-800 text-sm">{{ $answer->user->name }}</span>
                                <small
                                    class="text-slate-500 text-xs">{{ $answer->created_at->diffForHumans() }}</small>
                            </div>
                            @if ($answer->answer)
                                <p class="text-slate-700 mt-1 text-sm">{{ $answer->answer }}</p>
                            @endif
                            @if ($answer->content)
                                <div class="mt-2"><a href="{{ asset('storage/' . $answer->content) }}"
                                        target="_blank"><img src="{{ asset('storage/' . $answer->content) }}"
                                            class="rounded-lg max-w-xs" alt="Gambar Balasan"></a></div>
                            @endif
                        </div>

                        <div class="mt-1 text-xs">
                            <button type="button" onclick="toggleReplyForm('answer-{{ $answer->answer_id }}')"
                                class="bg-transparent border-none p-0 text-blue-600 font-semibold hover:underline">Balas</button>
                        </div>
                        <div class="mt-2 hidden" id="reply-form-answer-{{ $answer->answer_id }}">
                            <form action="{{ route('answers.store', $comment) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="parent_id" value="{{ $answer->answer_id }}">
                                <textarea class="w-full border-slate-300 rounded-md shadow-sm text-sm" name="answer" rows="2"
                                    placeholder="Balas {{ $answer->user->name }}..."></textarea>
                                <div class="flex justify-between items-center mt-2">
                                    <input type="file" name="content"
                                        class="text-sm text-slate-500 file:mr-2 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    <button type="submit"
                                        class="bg-blue-600 text-white font-semibold px-3 py-1.5 text-xs rounded-lg shadow-sm hover:bg-blue-700">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
