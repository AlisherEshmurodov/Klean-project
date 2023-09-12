<x-layouts.main_layout>

    <x-slot:title>
        Notifications
    </x-slot:title>

    <x-page_header>
        <x-slot:h1>
            Notifications
        </x-slot:h1>
    </x-page_header>

    <!-- Blog Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-end mb-4">
                {{--                {{ $notifications -> links() }}--}}
                <div class="col-lg-6">
                    <h1 class="section-title mb-3">Notifications </h1>
                    <a class="btn btn-sm ml-5 btn-primary py-2"
                       href="{{ route('readall') }}">Read All</a>
                </div>

            </div>
            <div class="row justify-content-center">
                @foreach($notifications as $notification)
                    @if(is_null($notification->read_at))
                        <div class="border mb-5  p-4 rounded ml-5" style="width: 40%">
                            <div class="position-relative mb-4">
                                <div class="blog-date bg-danger">
                                    <h4 class="text-white font-weight-bold mb-n1">New</h4>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <p class="px-2 py-1 rounded text-danger font-weight-medium">{{ $notification->data['created_at']}}</p>
                            </div>
                            <h5 class=" font-weight-medium mb-2">{{$notification->data['title']}}</h5>
                            <p class="mb-4">User id: {{$notification->data['id']}}</p>
                            <a class="btn btn-sm btn-success py-2"
                               href="{{ route('notifications.read', ['notification' => $notification->id]) }}">Read
                                Done</a>
                        </div>
                    @endif
                @endforeach
            </div>

            {{ $notifications -> links() }}
            {{--                <div class="col-12">--}}
            {{--                    <nav aria-label="Page navigation">--}}
            {{--                        <ul class="pagination pagination-lg justify-content-center mb-0">--}}
            {{--                            <li class="page-item disabled">--}}
            {{--                                <a class="page-link" href="#" aria-label="Previous">--}}
            {{--                                    <span aria-hidden="true">&laquo;</span>--}}
            {{--                                    <span class="sr-only">Previous</span>--}}
            {{--                                </a>--}}
            {{--                            </li>--}}
            {{--                            <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
            {{--                            <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
            {{--                            <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
            {{--                            <li class="page-item">--}}
            {{--                                <a class="page-link" href="#" aria-label="Next">--}}
            {{--                                    <span aria-hidden="true">&raquo;</span>--}}
            {{--                                    <span class="sr-only">Next</span>--}}
            {{--                                </a>--}}
            {{--                            </li>--}}
            {{--                        </ul>--}}
            {{--                    </nav>--}}
            {{--                </div>--}}
        </div>
    </div>
    <!-- Blog End -->


</x-layouts.main_layout>
