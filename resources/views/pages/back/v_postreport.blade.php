@extends('layouts.back.app')

@section('content')
<div class="app-content-area pt-0 ">
    <div class="bg-primary pt-12 pb-21 "></div>
    <div class="container-fluid mt-n22 ">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div class="mb-2 mb-lg-0">
                        <h3 class="mb-0  text-white">{{ $page }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- row  -->
        <div class="row ">
            <div class="col-xl-12 col-12 mb-5">
                <!-- card  -->
                <div class="card">

                    <!-- card header  -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0">List of Post Report data.</h4>
                        </div>

                        <div>
                            <button class="btn btn-secondary btn-sm rounded-0" id="add-btn" data-modaltitle="Add">
                                Add <i class="bi bi-plus-square fs-4 ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- table  -->
                    <div class="card-body p-0">
                        @component('components.datatable', ['tableId' => 'dynamic-postreport-table'])
                        @endcomponent
                    </div>

                </div>

                @component('components.modal', [
                'modalId' => 'postreportModal',
                'size' => 'modal-lg',
                'title' => 'Add or Edit Menu',
                'confirmText' => 'Save',
                'confirmButtonId' => 'savePostReport'
                ])

                <x-form formId="postreport-form" actionUrl="" method="">

                    <x-select name="type" id="type" label="Report Type" :options="[
                        'Garbage' => 'Report Garbage', 
                        'Recycled' => 'Sell Recycled Item'
                        ]" :selected="old('type')" placeholder="Select an report type" />

                 
                        <div id="garbage_container" class="d-none">

                        <x-input type="file" name="photo" id="photo" label="Photo:" />
                        <x-select name="address" id="address" label="Address" :selected="old('address')" placeholder="Select an address" />
                        <x-textarea name="description" id="description" label="Description" placeholder="Enter report description" :value="old('description')" rows="5" />

                    </div>

                    <div id="recycled_container" class="d-none">

                        <x-input type="file" name="photo" id="re_photo" label="Photo:" />
                        <x-textarea name="description" id="re_description" label="Description" placeholder="Enter report description" :value="old('description')" rows="5" />

                    </div>

                </x-form>

                @endcomponent

            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="{{ route('secure.js', ['filename' => 'postreport']) }}"></script>
@endpush