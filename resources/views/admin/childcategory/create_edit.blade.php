@extends('admin.layout.app')
@section('admin')
    <div class="card p-4 m-4">
        <div class="card-header">
            @if(isset($childcategories))
                <h6 class="mb-0">EDIT Child CATEGORY</h6>
            @else
                <h6 class="mb-0">ADD Child CATEGORY</h6>
            @endif
        </div>

        <div class="card-body">
            <form action="{{ isset($childcategories) ? route('child_categories.update', $childcategories->id) : route('child_categories.store') }}" method="POST">
                @csrf
                @if(isset($childcategories))
                    @method('PUT')
                @endif
                <div class="mb-3 row">
                    <label class="col-form-label col-lg-3">Child Category</label>
                    <div class="">
                        <select class="form-control select" name="category_id" id="category_id" data-minimum-results-for-search="Infinity">
                            <optgroup label="Category">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if(isset($childcategories) && $childcategories->category_id === $category->id)
                                            selected
                                        @endif
                                    >{{ $category->category_name }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <div class="error">
                            @error('category_id')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label class="col-form-label col-lg-3">Sub Category</label>
                    <div class="">
                        <select class="form-control select" name="subcategory_id" id="subcategory_id" data-minimum-results-for-search="Infinity">
                            <optgroup label="Category">
                                @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}"
                                        @if(isset($childcategories) && $childcategories->subcategory_id === $subcategory->id)
                                            selected
                                        @endif
                                    >{{ $subcategory->subcategory_name }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <div class="error">
                            @error('subcategory_id')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                

                <div class="mb-3">
                    <label class="form-label">Child Category Name</label>
                    <input type="text" name="child_category_name" class="form-control" placeholder="Child Category Name" value="{{ isset($childcategories) ? $childcategories->child_category_name : '' }}">
                    <div class="error">
                        @error('child_category_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Child Category Slug</label>
                    <input type="text" name="child_category_slug" class="form-control" placeholder="Child Category Slug" value="{{ isset($childcategories) ? $childcategories->child_category_slug : '' }}">
                    <div class="error">
                        @error('child_category_slug')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a type="reset" href="{{route('child_categories.index')}}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        @if(isset($childcategories))
                            Update <i class="ph-pencil-line ms-2"></i>
                        @else
                            Create <i class="ph-plus-circle-fill ms-2"></i>
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>



    @section('scripts')
    <script>
        // Function to update the subcategory options based on the selected category
        function updateSubcategories() {
            const selectedCategoryId = $('#category_id').val();
            const subcategoryDropdown = $('#subcategory_id');

            // Clear existing options
            subcategoryDropdown.find('option').remove();

            // Fetch subcategories based on the selected category via AJAX
            $.ajax({
                url: `/getSubcategories/${selectedCategoryId}`, // Replace this with the URL to fetch subcategories based on category
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    // Add new subcategory options
                    data.forEach(subcategory => {
                        const option = `<option value="${subcategory.id}">${subcategory.subcategory_name}</option>`;
                        subcategoryDropdown.append(option);
                    });
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        // Call the function initially to populate subcategories based on the default selected category (if any)
        updateSubcategories();

        // Attach onchange event to the category select dropdown
        $('#category_id').on('change', function () {
            updateSubcategories();
        });
    </script>
@endsection

@endsection
