@extends('layouts.admin')

@section('title', 'Edit Department')
@section('page_title', 'Edit Department')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('departments.index') }}">Departments</a></li>
  <li class="breadcrumb-item active" aria-current="page">Edit</li>
@endsection

@section('content')
  <div class="card mb-4">
    <div class="card-header">
      <h3 class="card-title">{{ $department->name }}</h3>
    </div>
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('departments.update', $department) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
          <input type="text" name="name" id="name" value="{{ old('name', $department->name) }}"
                 class="form-control @error('name') is-invalid @enderror" required maxlength="255">
          @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea name="description" id="description" rows="4"
                    class="form-control @error('description') is-invalid @enderror" maxlength="1000">{{ old('description', $department->description) }}</textarea>
          @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Save Changes
          </button>
          <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>
@endsection