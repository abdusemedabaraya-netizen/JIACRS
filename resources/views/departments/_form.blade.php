@csrf
<div class="mb-3">
  <label class="form-label" for="name">Name</label>
  <input type="text" id="name" name="name" value="{{ old('name', $department->name ?? '') }}"
         class="form-control @error('name') is-invalid @enderror" required maxlength="255">
  @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
  <label class="form-label" for="description">Description</label>
  <textarea id="description" name="description" rows="3" maxlength="1000"
            class="form-control @error('description') is-invalid @enderror">{{ old('description', $department->description ?? '') }}</textarea>
  @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<button class="btn btn-primary">Save</button>
<a href="{{ route('departments.index') }}" class="btn btn-outline-secondary">Cancel</a>
