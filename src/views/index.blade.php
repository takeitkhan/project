@extends('layouts.app')

@section('title')
    Projects
@endsection

@if(auth()->user()->isAdmin(auth()->user()->id) || auth()->user()->isApprover(auth()->user()->id))
    @php
        $addUrl = route('projects.create');
    @endphp
@else
    @php
        $addUrl = '#';
    @endphp
@endif
<section class="hero is-white borderBtmLight">
    <nav class="level">
        @include('component.title_set', [
            'spTitle' => 'Projects',
            'spSubTitle' => 'all projects here',
            'spShowTitleSet' => true
        ])

        @include('component.button_set', [
            'spShowButtonSet' => true,
            'spAddUrl' => null,
            'spAddUrl' => $addUrl,
            'spAllData' => route('projects.index'),
            'spSearchData' => route('projects.search'),
            'spTitle' => 'Projects',
        ])

        @include('component.filter_set', [
            'spShowFilterSet' => true,
            'spPlaceholder' => 'Search projects...',
            'spAddUrl' => route('projects.create'),
            'spAllData' => route('projects.index'),
            'spSearchData' => route('projects.search'),
            'spMessage' => $message = $message ?? NULl,
            'spStatus' => $status = $status ?? NULL
        ])
    </nav>
</section>

@section('column_left')
    <div class="columns is-multiline">
        @if(!empty($projects))
            @foreach($projects as $project)
                <div class="column is-3">
                    <div class="borderedCol">
                        <article class="media">
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <strong>
                                            <a href="{{ route('projects.show', $project->id) }}"
                                               title="View project">
                                                {{ $project->name }}
                                            </a>
                                        </strong>
                                        <br/>
                                        <small>
                                        <strong>
                                            Type: </strong> {{ $project->type }}
                                            <br/>
                                            <strong>Manager:</strong> 
                                            {{ \App\Models\User::where('id', $project->manager)->first()->name }}
                                            ({{ $project->manager }})
                                            <!-- <strong>Code: </strong> {{ $project->code }}, -->                                        
                                        </small>
                                        <br/>
                                        <small>
                                            
                                            <strong>Customer:</strong> {{ $project->customer }}
                                            <!-- <strong>Vendor:</strong> {{ $project->vendor }},
                                            <strong>Supplier:</strong> {{ $project->supplier }} -->
                                        </small>
                                        <br/>
                                        <small>
                                            <strong>Budget:</strong> BDT. {{ $project->budget }}                                                                               
                                        </small>
                                        <br/>
                                    </p>
                                </div>
                                <nav class="level is-mobile">
                                    <div class="level-left">
                                        <a href="{{ route('projects.show', $project->id) }}"
                                           class="level-item"
                                           title="View project">
                                            <span class="icon is-small"><i class="fas fa-eye"></i></span>
                                        </a>
                                        @if(auth()->user()->isAdmin(auth()->user()->id) || auth()->user()->isApprover(auth()->user()->id))
                                            <a href="{{ route('projects.edit', $project->id) }}"
                                               class="level-item"
                                               title="View all transaction">
                                                <span class="icon is-info is-small"><i class="fas fa-edit"></i></span>
                                            </a>
                                        @endif

                                        {{--                                        {!! delete_data('projects.destroy',  $project->id) !!}--}}
                                    </div>
                                </nav>
                            </div>
                        </article>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="pagination_wrap pagination is-centered">
        {{$projects->links('pagination::bootstrap-4')}}
    </div>
@endsection
