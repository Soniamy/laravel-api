@extends('layouts.app')

@section('page-title',$post->title.' Edit')

@section('main-content')
   <h1>
    {{ $post->title }} Edit
</h1>

<div class="row">
    <div class="col py-4">
        <div class="mb-4">
            <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">
                Torna ai Post
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mb-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
         <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="POST">
            @csrf

            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Titolo <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" placeholder="Inserisci il titolo..." maxlength="255" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Categoria</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option
                        {{ old('category_id', $post->category_id) == null ? 'selected' : '' }}
                        value="">
                        Seleziona una categoria...
                    </option>
                    @foreach ($categories as $category)
                        <option
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}
                            value="{{ $category->id }}">
                            {{ $category->title }}
                        </option>
                    @endforeach
                      </select>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Contenuto <span class="text-danger">*</span></label>
                <textarea class="form-control" id="content" name="content" rows="3" placeholder="Inserisci il contenuto..." maxlength="10000" required>{{ old('content', $post->content) }}</textarea>
            </div>
             <div class="mb-3">
                <label class="form-label">Tecnologie</label>

                <div>
                    @foreach ($technologies as $technology)
                        <div class="form-check form-check-inline">
                            <input
                                @if ($errors->any())
                                    {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}
                               @elseif ($post->technologies && $post->technologies->contains($technology->id))
                                checked
                                @endif
                                class="form-check-input"
                                type="checkbox"
                                id="technology-{{ $technology->id }}"
                                name="technologies[]"
                                value="{{ $technology->id }}">
                            <label class="form-check-label" for="technology-{{ $technology->id }}">{{ $technology->title }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
            <div>
                <button type="submit" class="btn btn-warning w-100">
                    Aggiorna
                </button>
            </div>

        </form>
    </div>
</div>
@endsection