@extends('layouts.app')

<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.css"/>
<style>

</style>

@section('content')
    <div class="container">
        <!--- Success message --->
        @if(session()->has('success'))
            <div class="alert alert-success" style="color: green">
                {{ session()->get('success') }}
            </div>
            <br>
        @endif


        <!---- Error message --->
        @if(session()->has('error'))
            <div class="alert alert-danger" style="color: red">
                {{ session()->get('error') }}
            </div>
        @endif

        <form action="{{ route('developer-update-category') }}" method="POST">
            @csrf
            @method('POST')

            <div class="flex-wrap d-flex flex-row justify-content-between align-content-center gap-4">
                <label>
                    <input type="radio" name="type" value="create" checked>
                    <span>Create</span>
                </label>

                <div>
                    <label>
                        <input type="radio" name="type" value="update" >
                        <span>Update</span>
                    </label>
                    <label for="name" class="ml-4">
                        <span>Search name:</span>
                        <input type="text" name="search_name" class="form-control">
                    </label>
                </div>
            </div>
            <br>
            <br>


            <br>
            <div>
                <label for="name">
                    <span>New name:</span>
                    <input type="text" name="name" class="form-control">
                </label>
            </div>
            <br>
            <div>
                <label for="name">
                    <span>Code:</span>
                    <input type="text" name="code" class="form-control">
                </label>
            </div>
            <br>
            <!-- Create the editor container -->
            <textarea id="description" name="description"></textarea>
            <br>
            <div>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>

        <div>
            @isset($cat)
                <div>
                    <h3>Category name:</h3>
                    <div>{{$cat->name}}</div>
                </div>
                <br>
                <div>
                    <h3>Category description:</h3>
                    <div>{!! $cat->fulldescription !!}</div>
                </div>
                <br>
            @endisset
        </div>
    </div>
@endsection

@section('additional-js')
    <!-- Include the Quill library -->
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.0/"
            }
        }
    </script>
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph,
            Heading,
        } from 'ckeditor5';

        ClassicEditor
            .create(document.querySelector('#description'), {
                plugins: [Essentials, Bold, Italic, Font, Paragraph, Heading],
                toolbar: {
                    items: [
                        'heading',
                        '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',
                        '|', 'highlight', 'alignment',
                        '|', 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor',
                        '|', 'undo', 'redo'
                    ]
                },
                heading: {
                    options: [
                        {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                        {model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1'},
                        {model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2'},
                        {model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3'},
                        {model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4'},
                        {model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5'},
                        {model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6'},
                    ]
                }
            })
            .then( /* ... */)
            .catch( /* ... */);
    </script>
@endsection