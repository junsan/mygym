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

                    <form action="{{ route('schedule.store') }}" method="post" class="max-w-lg">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label class="text-sm">Select type of class</label>
                                <select name="class_type_id" class="block mt-2 w-full border-gray-300 focus:ring-0 focus:border-gray-500">
                                    @foreach ($classTypes as $classType)
                                        <option value="{{ $classType->id }}">{{ $classType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="flex gap-6">
                                <div class="flex-1">
                                    <label class="text-sm">Date</label>
                                    <input type="date" name="date" class="block mt-2 w-full border-gray-300 focus:ring-0 focus:border-gray-500" min="{{ date('Y-m-d', strtotime('tomorrow')) }}">
                                </div>
                                <br>
                                <div class="flex-1">
                                    <label class="text-sm">Time</label>
                                    <select type="time" name="time" class="block mt-2 w-full border-gray-300 focus:ring-0 focus:border-gray-500">
                                        <option value="05:00:00">5 am</option>
                                        <option value="06:00:00">6 am</option>
                                        <option value="07:00:00">7 am</option>
                                        <option value="08:00:00">8 am</option>
                                        <option value="17:00:00">5 pm</option>
                                        <option value="18:00:00">6 pm</option>
                                        <option value="19:00:00">7 pm</option>
                                        <option value="20:00:00">8 pm</option>
                                    </select>
                                </div>
                                <br>
                                <div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
