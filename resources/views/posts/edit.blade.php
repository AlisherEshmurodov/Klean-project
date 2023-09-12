<x-layouts.main_layout>

    <x-slot:title>
        Edit Post
    </x-slot:title>

    <x-page_header>
        <x-slot:h1>
            Edit Post #{{$post->id}}
        </x-slot:h1>
    </x-page_header>


    <div class="m-auto justify-content-center col-lg-3 col-md-6 mb-5">
        <div class="contact-form">
            <div id="success"></div>


            {{--                @if ($errors->any())--}}
            {{--                    <div class="alert alert-danger">--}}
            {{--                        <ul>--}}
            {{--                            @foreach ($errors->all() as $error)--}}
            {{--                                <li>{{ $error }}</li>--}}
            {{--                            @endforeach--}}
            {{--                        </ul>--}}
            {{--                    </div>--}}
            {{--                @endif--}}

            <form enctype="multipart/form-data" method="post"
                  action="{{ route('posts.update', ['post' => $post->id]) }}" name="sentMessage"
                  id="contactForm" novalidate="novalidate">
                @csrf
                @method('PUT')

                <div class="control-group mb-3">
                    <input name="title" type="text" class="form-control p-4 @error('title') is-invalid @enderror"
                           id="subject" placeholder="Title"
                           value="{{ $post->title }}"/>
                    @error('title')
                    <p class="ml-3 help-block text-danger">{{ $message }}</p>
                    {{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Category</label>
                    <select name="category_id" class="form-control" id="exampleFormControlSelect1">
                        <option value="">Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="ml-3 help-block text-danger">The category {{ substr($message, 16) }}</p>
                    {{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect2">Select Tags</label>
                    <select name="tags[]" class="form-control w-100" multiple aria-label="multiple select example">
                        {{--                        <option value="" disabled>Select Tags</option>--}}
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="control-group mb-3">
                    <textarea name="short_content" class="form-control p-4 @error('short_content') is-invalid @enderror"
                              rows="2.5" id="message" placeholder="Short content">{{ $post->short_content  }}</textarea>
                    @error('short_content')
                    <p class="ml-3 help-block text-danger">{{ $message }}</p>
                    {{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
                    @enderror
                </div>
                <div class="control-group mb-3">
                        <textarea name="contents" class="form-control p-4 @error('contents') is-invalid @enderror"
                                  rows="6" id="message" placeholder="Content">{{ $post->contents  }}</textarea>
                    @error('contents')
                    <p class="ml-3 help-block text-danger">{{ $message }}</p>
                    {{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
                    @enderror
                </div>
                <div class=" control-group mb-3">
                    <label for="avatar">Download your Photo</label><br>
                    <input name="photo" type="file" value="{{ $post->photo  }}"
                           class="form-control p-4 @error('photo') is-invalid @enderror" id="photo"
                           placeholder="Your File"/>
                    @error('photo')
                    <p class="ml-3 help-block text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div>

                    <a href="{{ route('posts.show', ['post' => $post->id]) }}"
                       class="btn btn-danger py-3 px-5">
                        <- Back
                    </a>
                    @canany('update', $post)
                        <button name="create_button" class=" btn btn-success py-3 px-5" type="submit"
                                id="sendMessageButton">Update
                        </button>
                    @endcanany

                </div>


                {{--<div class="control-group mb-3">
                    <input name="title" type="text" class="form-control p-4 @error('title') is-invalid @enderror"
                           id="subject" placeholder="Title"
                           value="{{ $post->title }}"/>
                    @error('title')
                    <p class="ml-3 help-block text-danger">{{ $message }}</p>
                    --}}{{--                        <div class="alert alert-danger">{{ $message }}</div>--}}{{--
                    @enderror
                </div>
                <div class="control-group mb-3">
                    <textarea name="short_content" class="form-control p-3 @error('short_content') is-invalid @enderror"
                              rows="2.5" id="message" placeholder="Short content">{{ $post->short_content }}</textarea>
                    @error('short_content')
                    <p class="ml-3 help-block text-danger">{{ $message }}</p>
                    --}}{{--                        <div class="alert alert-danger">{{ $message }}</div>--}}{{--
                    @enderror
                </div>
                <div class="control-group mb-3">
                        <textarea name="contents" class="form-control p-3 @error('contents') is-invalid @enderror"
                                  rows="6" id="message" placeholder="Content">{{ $post->contents }}</textarea>
                    @error('contents')
                    <p class="ml-3 help-block text-danger">{{ $message }}</p>
                    --}}{{--                        <div class="alert alert-danger">{{ $message }}</div>--}}{{--
                    @enderror
                </div>
                <div class=" control-group mb-3">
                    <label for="avatar">Download your Photo</label><br>
                    <input name="photo" type="file" value="{{ $post->photo }}"
                           class="form-control p-4 @error('photo') is-invalid @enderror" id="photo"
                           placeholder="Your File"/>
                    @error('photo')
                    <p class="ml-3 help-block text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div>

                    <a href="{{ route('posts.show', ['post' => $post->id]) }}"
                       class="btn btn-danger py-3 px-5">
                        <- Back
                    </a>
                    <button name="create_button" class=" btn btn-success py-3 px-5" type="submit"
                            id="sendMessageButton">Update
                    </button>

                </div>--}}
            </form>
        </div>
    </div>

</x-layouts.main_layout>
