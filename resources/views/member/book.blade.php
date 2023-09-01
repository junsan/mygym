@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Book a Class') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @forelse ($scheduledClasses as $class)
                    <div class="py-6">
                        <div class="flex gap-6 justify-between">
                            <div>
                                <p class="text-2xl font-bold text-purple-700">{{ $class->classType->name }}</p>
                                <span class="text-slate-600 text-sm">{{ $class->classType->minutes }} minutes</span>
                                <h6>{{ $class->instructor->name }}</h6>
                                <p class="text-slate-600 text-sm">{{ $class->classType->description }}</p>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <p class="text-lg font-bold">{{ $class->date_time->format('g:i a') }}</p>
                                <p class="text-sm">{{ $class->date_time->format('jS M') }}</p>
                            </div>
                        </div>
                        <div class="mt-1 text-right">
                            <form method="post" action="{{ route('booking.destroy') }}">
                                @csrf
                                <button btn="btn btn-danger" class="px-3 py-1">Book</button>
                            </form>
                        </div>
                        <br>
                    </div>
                    @empty
                    <div>
                        <p>We don't have any upcoming classes</p>
                    </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
