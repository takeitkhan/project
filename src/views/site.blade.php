@extends('layouts.app')

@section('title')
    Site Of Project
@endsection
<section class="hero is-white borderBtmLight">
    <nav class="level">
        @include('component.title_set', [
            'spTitle' => 'All site under this project',
            'spSubTitle' => 'view all site',
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
            <a href="{{ route('projects.show', $projectId) }}">
                <i class="fas fa-list"></i>&nbsp;  Project Data
            </a>
            <a href="javascript:void(0)" class="is-active">
                <i class="fas fa-list"></i>&nbsp; Site of project
            </a>
        </p>
        <br/>
        @if(!empty($sites))
        <div class="columns is-multiline">
            @foreach($sites as $site)
                <div class="column is-4">
                    <div class="borderedCol">
                        <article class="media">
                        <div class="media-content">
                                <div class="content">
                                    <p>
                                        <strong>
                                            <a href="{{ route('sites.show', $site->id) }}"
                                               title="View route">
                                               <strong>Location: </strong>  {{ $site->location }},
                                            </a>
                                        </strong>
                                        <br/>
                                        <small>
                                            <strong>Code: </strong> {{ $site->site_code }},
                                            <strong>Project: </strong> 
                                            @php $project = \Tritiyo\Project\Models\Project::where('id', $site->project_id)->first() @endphp
                                            {{  $project->name }}
                                        </small>
                                        <br/>
                                        <small>
                                            <strong>Budget:</strong> {{ $site->budget }}
                                        </small>
                                        <br/>
                                    </p>
                                </div>
                                <nav class="level is-mobile">
                                    <div class="level-left">
                                        <a href="{{ route('sites.show', $site->id) }}"
                                           class="level-item"
                                           title="View user data">
                                            <span class="icon is-small"><i class="fas fa-eye"></i></span>
                                        </a>
                                        <a href="{{ route('sites.edit', $site->id) }}"
                                           class="level-item"
                                           title="View all transaction">
                                            <span class="icon is-info is-small"><i class="fas fa-edit"></i></span>
                                        </a>                                        

                                        {!! delete_data('sites.destroy',  $site->id) !!}
                                    </div>
                                </nav>
                            </div>
                        </article>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </article>
@endsection