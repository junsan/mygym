@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Schedule a Class') }}</div>

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
                            </div>
                            <div class="text-right flex-shrink-0">
                            <p class="text-lg font-bold">{{ $class->date_time->format('g:i a') }}</p>
                            <p class="text-sm">{{ $class->date_time->format('jS M') }}</p>
                            </div>
                        </div>
                        @can('delete', $class)
                        <div class="mt-1 text-right">
                            <form method="post" action="{{ route('schedule.destroy', $class) }}">
                            @csrf
                            @method('DELETE')
                            <button btn="btn btn-danger" class="px-3 py-1">Cancel</button>
                            </form>
                        </div>
                        @endcan
                        <br>
                    </div>
                    @empty
                    <div>
                        <p>You don't have any upcoming classes</p>
                        <a class="inline-block mt-6 underline text-sm" href="{{ route('schedule.create') }}">
                            Schedule now
                        </a>
                    </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
