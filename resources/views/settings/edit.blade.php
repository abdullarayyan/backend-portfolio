@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Site Settings</h1>

        {{-- ✅ عرض الفيديو --}}
        @if($setting->video)
            <div class="media-preview">
                <h5>الفيديو الحالي:</h5>
                <video width="300" controls>
                    <source src="{{ asset('storage/' . $setting->video) }}" type="video/mp4">
                    المتصفح لا يدعم الفيديو.
                </video>
                <form method="POST" action="{{ route('settings.deleteMedia') }}">
                    @csrf
                    <input type="hidden" name="type" value="video">
                    <button class="btn btn-danger btn-sm mt-2">🗑 حذف الفيديو</button>
                </form>
            </div>
        @endif

        {{-- ✅ عرض الصوت --}}
        @if($setting->audio)
            <div class="media-preview mt-4">
                <h5>الصوت الحالي:</h5>
                <audio controls>
                    <source src="{{ asset('storage/' . $setting->audio) }}" type="audio/mpeg">
                    المتصفح لا يدعم الصوت.
                </audio>
                <form method="POST" action="{{ route('settings.deleteMedia') }}">
                    @csrf
                    <input type="hidden" name="type" value="audio">
                    <button class="btn btn-danger btn-sm mt-2">🗑 حذف الصوت</button>
                </form>
            </div>
        @endif

        {{-- ✅ نموذج رفع جديد --}}
        <hr class="my-4">
        <form id="upload-form">
            @csrf
            <div class="form-group mb-3">
                <label>فيديو جديد:</label>
                <input type="file" name="video" id="video" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>صوت جديد:</label>
                <input type="file" name="audio" id="audio" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">رفع</button>
        </form>

        <div id="message" class="mt-3 text-success"></div>

        {{-- ✅ سكربت رفع مجزأ --}}
        <script>
            async function uploadFileChunked(file, type) {
                const chunkSize = 2 * 1024 * 1024;
                const totalChunks = Math.ceil(file.size / chunkSize);
                const uploadId = Date.now() + '_' + type;

                for (let i = 0; i < totalChunks; i++) {
                    const start = i * chunkSize;
                    const end = Math.min(start + chunkSize, file.size);
                    const chunk = file.slice(start, end);

                    const formData = new FormData();
                    formData.append('chunk', chunk);
                    formData.append('chunk_number', i + 1);
                    formData.append('total_chunks', totalChunks);
                    formData.append('upload_id', uploadId);
                    formData.append('file_name', file.name);
                    formData.append('type', type);
                    formData.append('_token', '{{ csrf_token() }}');

                    const response = await fetch("{{ route('upload.chunk') }}", {
                        method: "POST",
                        body: formData
                    });

                    if (!response.ok) {
                        document.getElementById('message').innerText = `❌ فشل رفع جزء ${i + 1} من ${type}`;
                        return null;
                    }
                }

                return uploadId + '__' + file.name;
            }

            document.getElementById('upload-form').addEventListener('submit', async function(e) {
                e.preventDefault();

                const video = document.getElementById('video').files[0];
                const audio = document.getElementById('audio').files[0];
                let videoFinal = null;
                let audioFinal = null;

                if (video) {
                    videoFinal = await uploadFileChunked(video, 'video');
                }

                if (audio) {
                    audioFinal = await uploadFileChunked(audio, 'audio');
                }

                const form = new FormData();
                form.append('_token', '{{ csrf_token() }}');
                if (videoFinal) form.append('video', videoFinal);
                if (audioFinal) form.append('audio', audioFinal);

                const response = await fetch('{{ route("settings.update") }}', {
                    method: 'POST',
                    body: form
                });

                if (response.ok) {
                    document.getElementById('message').innerText = '✅ تم التحديث بنجاح';
                    setTimeout(() => location.reload(), 1000); // إعادة تحميل الصفحة
                } else {
                    document.getElementById('message').innerText = '❌ فشل التحديث';
                }
            });
        </script>

        <style>
            .media-preview {
                border: 1px solid #ccc;
                padding: 10px;
                border-radius: 10px;
                background-color: #f9f9f9;
                width: fit-content;
            }
        </style>
    </div>
@endsection
