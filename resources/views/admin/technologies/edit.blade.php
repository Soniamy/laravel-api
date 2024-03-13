@extends('layouts.app')

@section('page-title', $technology->title.' Edit')

@section('main-content')
   <h1>
    {{ $technology->title }} Modifica
</h1>

<div class="row">
    <div class="col py-4">
        <div class="mb-4">
            <a href="{{ route('admin.tecnologies.index') }}" class="btn btn-primary">
                Torna alle tecnologie
            </a>
        </div>

        <form action="{{ route('admin.tecnologies.update', ['technology' => $technology->id]) }}" method="POST">
            @csrf

            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Titolo <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $technology->title) }}" placeholder="Inserisci il titolo..." maxlength="255" required>
            </div>

            <div>
                <button type="submit" class="btn btn-warning w-100">
                    Aggiorna
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
