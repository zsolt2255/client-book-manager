@extends('app')

@section('content')
    <div id='calendar'></div>
@endsection

@section('scripts')
    <script>
        const config = {
            routes: {
                index: "{{ route('calendars.index') }}",
                store: "{{ route('calendars.store') }}",
                destroy: "{{ route('calendars.destroy', ['calendar' => 'null']) }}"
            }
        };
    </script>
@endsection
