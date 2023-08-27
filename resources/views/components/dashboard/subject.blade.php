@if($subject)
    @switch(get_class($subject))
        @case("App\Models\Application")
            <a href="{{ route('dashboard.applications.show', ['id' => $subject->id]) }}">{{ $subject->user->name }}</a>
            @break

        @case("App\Models\ATC")
            <a href="{{ route('dashboard.atcs.show', ['cid' => $subject->user->cid]) }}">{{ $subject->user->name }}</a>
            @break

        @case("App\Models\Category")
            <a href="{{ route('dashboard.categories.show', ['id' => $subject->id]) }}">{{ $subject->name }}</a>
            @break

        @case("App\Models\Document")
            <a href="{{ route('dashboard.documents.show', ['id' => $subject->id]) }}">{{ $subject->name }}</a>
            @break

        @case("App\Models\Event")
            <a href="{{ route('dashboard.events.edit', ['slug' => $subject->slug]) }}">{{ $subject->name }}</a>
            @break

        @case("App\Models\Instructor")
            <a href="{{ route('dashboard.instructors.audit', ['id' => $subject->id]) }}">{{ $subject->user->name }}</a>
            @break

        @case("App\Models\Staff")
            <a href="{{ route('dashboard.staff.show', ['id' => $subject->id]) }}">{{ $subject->position }}</a>
            @break

        @case("App\Models\Team")
            <a href="{{ route('dashboard.teams.show', ['id' => $subject->id]) }}">{{ $subject->name }}</a>
            @break

        @case("App\Models\TrainingNote")
            <a href="{{ route('dashboard.trainingNotes.show', ['id' => $subject->id]) }}">{{ $subject->student->user->name }}</a>
            @break

        @case("App\Models\TrainingSession")
            <a href="{{ route('dashboard.trainingSessions.show', ['id' => $subject->id]) }}">{{ $subject->title }}</a>
            @break

        @case("App\Models\User")
            <a href="{{ route('dashboard.users.show', ['cid' => $subject->cid]) }}">{{ $subject->name }}</a>
            @break

        @default
            TODO
    @endswitch
@else
    System
@endif