@extends('layouts.app')

@section('title')
    Projects
@endsection

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
            'spAddUrl' => route('projects.create'),
            'spAllData' => route('projects.index'),
            'spSearchData' => route('projects.search'),
        ])

        @include('component.filter_set', [
            'spShowFilterSet' => true,
            'spPlaceholder' => 'Search projects...',
            'spMessage' => $message = $message ?? NULl,
            'spStatus' => $status = $status ?? NULL
        ])
    </nav>
</section>

@section('column_left')
    <div class="columns is-multiline">
        @if(!empty($projects))
            @foreach($projects as $project)
                <div class="column is-4">
                    <div class="borderedCol">
                        <article class="media">
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <strong>
                                            <a href="{{ route('projects.show', $project->id) }}"
                                               title="View route">
                                                {{ $project->name }}
                                            </a>
                                        </strong>
                                        <small>
                                            <strong>Code: </strong> {{ $project->code }},
                                            <strong>Type: </strong> {{ $project->type }}
                                        </small>
                                        <br/>
                                        <small>
                                            <strong>Manager:</strong> {{ $project->manager }},
                                            <strong>Customer:</strong> {{ $project->customer }},
                                            <strong>Vendor:</strong> {{ $project->vendor }},
                                            <strong>Supplier:</strong> {{ $project->supplier }}
                                        </small>
                                        <br/>
                                        <small>
                                            <strong>Budget:</strong> {{ $project->budget }},
                                            <strong>Start:</strong> {{ $project->start }},
                                            <strong>End:</strong> {{ $project->end }}
                                        </small>
                                        <br/>
                                    </p>
                                </div>
                                <nav class="level is-mobile">
                                    <div class="level-left">
                                        <a href="#"
                                           class="level-item"
                                           title="View user data">
                                            <span class="icon is-small"><i class="fas fa-eye"></i></span>
                                        </a>
                                        <a href="{{ route('projects.edit', $project->id) }}"
                                           class="level-item"
                                           title="View all transaction">
                                            <span class="icon is-info is-small"><i class="fas fa-edit"></i></span>
                                        </a>
                                        <a class="level-item" title="Delete user" href="javascript:void(0)"
                                           onclick="confirm('Are you sure?')">
                                            <span class="icon is-small is-red"><i class="fas fa-times"></i></span>
                                        </a>
                                    </div>
                                </nav>
                            </div>
                        </article>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
