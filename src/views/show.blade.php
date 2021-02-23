@extends('layouts.app')

@section('title')
    Single Project
@endsection

<section class="hero is-white borderBtmLight">
    <nav class="level">
        @include('component.title_set', [
            'spTitle' => 'Single Project',
            'spSubTitle' => 'view a Project',
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
    <article class="panel is-primary">

        <p class="panel-tabs">
            <a href="javascript:void(0" class="is-active">
                <i class="fas fa-list"></i>&nbsp;  Project Data
            </a>
            <a href="{{ route('projects.site', $project->id) }}">
                <i class="fas fa-list"></i>&nbsp; Site of project
            </a>
        </p>

        <div class="card tile is-child">
            <header class="card-header">
               
            </header>
            <div class="card-content">
                <div class="card-data">
                    <div class="columns">
                        <div class="column is-2">Project Name</div>
                        <div class="column is-1">:</div>
                        <div class="column">
                        {{$project->name}}
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column is-2">Project Code</div>
                        <div class="column is-1">:</div>
                        <div class="column">{{ $project->code }}</div>
                    </div>
                    <div class="columns">
                        <div class="column is-2">Project Type</div>
                        <div class="column is-1">:</div>
                        <div class="column">{{ $project->type }}</div>
                    </div>
                    <div class="columns">
                        <div class="column is-2">Project Manager</div>
                        <div class="column is-1">:</div>
                        <div class="column">
                            @php $projectManager = \App\Models\User::where('id', $project->manager)->first() @endphp
                            {{ !empty($projectManager) ? $projectManager->name : '' }}
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column is-2">Project customer</div>
                        <div class="column is-1">:</div>
                        <div class="column">{{ $project->customer }}</div>
                    </div>
                    <div class="columns">
                        <div class="column is-2">Project vendor</div>
                        <div class="column is-1">:</div>
                        <div class="column">{{ $project->vendor }}</div>
                    </div>
                    <div class="columns">
                        <div class="column is-2">Project supplier</div>
                        <div class="column is-1">:</div>
                        <div class="column">{{ $project->supplier }}</div>
                    </div>
                    <div class="columns">
                        <div class="column is-2">Project address</div>
                        <div class="column is-1">:</div>
                        <div class="column">{{ $project->address }}</div>
                    </div>
                    <div class="columns">
                        <div class="column is-2">Project location</div>
                        <div class="column is-1">:</div>
                        <div class="column">{{ $project->location }}</div>
                    </div>
                    <div class="columns">
                        <div class="column is-2">Head Office</div>
                        <div class="column is-1">:</div>
                        <div class="column">{{ $project->office }}</div>
                    </div>
                    <div class="columns">
                        <div class="column is-2">Project start</div>
                        <div class="column is-1">:</div>
                        <div class="column">{{ $project->start }}</div>
                    </div>
                    <div class="columns">
                        <div class="column is-2">Approximate project end</div>
                        <div class="column is-1">:</div>
                        <div class="column">{{ $project->end }}</div>
                    </div>
                    <div class="columns">
                        <div class="column is-2">Project approximate budget</div>
                        <div class="column is-1">:</div>
                        <div class="column">{{ $project->budget }}</div>
                    </div>
                    <div class="columns">
                        <div class="column is-9">
                            <div class="field">Project summary</div>
                            <div class="control">{{ $project->summary }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('column_right')
   
@endsection
@section('cusjs')
    <style type="text/css">
        .table.is-fullwidth {
            width: 100%;
            font-size: 15px;
            text-align: center;
        }
    </style>
@endsection
