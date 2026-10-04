<div>
    <label for="title" class="block text-sm font-semibold text-slate-700 mb-1.5">Judul</label>
    <input type="text" id="title" name="title" value="{{ old('title', $post->title ?? '') }}"
           class="block w-full border-slate-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-400 ring-1 ring-red-200 @enderror">
    @error('title') <p class="text-red-600 text-sm mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p> @enderror
</div>

<div class="mt-5">
    <label for="body" class="block text-sm font-semibold text-slate-700 mb-1.5">Isi</label>
    <textarea id="body" name="body" rows="8"
              class="block w-full border-slate-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('body') border-red-400 ring-1 ring-red-200 @enderror">{{ old('body', $post->body ?? '') }}</textarea>
    @error('body') <p class="text-red-600 text-sm mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p> @enderror
</div>

<button type="submit" class="mt-7 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold shadow-sm shadow-indigo-200 transition">
    💾 Simpan
</button>
