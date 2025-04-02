@extends('base')

@section('title')
    Admin Post
@endsection

@section('container')
    <div class="container">
        <div class="row mt-2">
            <div class="col-md-2">
                <h2>Admin </h2>
            </div>
            <div class="col-md-10">
                <div class="create-btn d-flex justify-content-end my-2">
                    <a href="{{ route('admin.post.create')}}" class="btn btn-primary">Create Post</a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success')  }}
                    </div>
                @endif
                @include('paginate', ['datas' => $posts])
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td> {{ $post->id }} </td>
                                <td> {{ $post->title }} </td>
                                <td>
                                    <img src="
                                            @if (Str::startsWith($post->imageUrl, 'http'))
                                                {{ $post->imageUrl }}
                                            @else
                                                {{ Storage::url($post->imageUrl) }}
                                            @endif
                                            " class="img-fluid card" width="100%" height="200px" alt="">
                                </td>
                                <td> {{ $post->created_at->diffForHumans() }} </td>
                                <td>
                                    <a href="{{ route('admin.post.view', ['id' => $post->id]) }}"
                                        class="btn btn-primary">View</a>
                                    <a href="{{ route('admin.post.edit', ['id' => $post->id]) }}"
                                        class="btn btn-warning">Edit</a>
                                    <a href="#" data-title="{{ $post->title }}" data-id="{{ $post->id }}"
                                        class="btn btn-danger deleteBtn">delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </thead>
                </table>
                @include('paginate', ['datas' => $posts])
            </div>
        </div>
    </div>

    <div class="modal" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary confirm-delete" data-bs-dismiss="modal"
                        aria-label="close">Confirm</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const deleteBtns = document.querySelectorAll('.deleteBtn');
            const removePost = async (event) => {
                event.preventDefault();
                const { id, title } = event.target.dataset;
                const deleteModal = document.getElementById('deleteModal');
                const modalContent = document.querySelector('.modal-body');
                const confirmDelete = document.querySelector('.confirm-delete');

                modalContent.innerHTML = `Are you sure you want to delete this data: <strong>${title}</strong>?`;
                const modal = new bootstrap.Modal(deleteModal);
                modal.show();
                confirmDelete.onclick = async (event) => {

                    const csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;
                    try {
                        const response = await fetch("/admin/posts/delete/" + id, {
                            method: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': csrf_token,
                                'Content-Type': 'application/json'
                            }
                        });

                        if (response.ok) {

                            const result = await response.json();

                            if (result.isSuccess) {
                                modal.hide();
                                window.location.reload();
                            } else {

                                alert(result.message);
                            }
                        } else {

                            alert("Failed to delete the post.");
                        }
                    } catch (error) {

                        console.error('Error:', error);
                    }
                };
            };
            deleteBtns.forEach(deleteBtn => {
                deleteBtn.addEventListener('click', removePost);
            });
        });
    </script>
@endsection