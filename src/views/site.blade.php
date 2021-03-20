@extends('layouts.app')

@section('title')
    Sites Of Project
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
            'spTitle' => 'Sites Of Project',
            'spSubTitle' => 'view all sites of current project',
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
                <div class="column is-3">
                    <div class="borderedCol">
                        <article class="media">
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <small>
                                            <strong>Code: </strong>
                                            <a href="{{ route('sites.show', $site->id) }}"
                                                target="_blank"
                                                title="View route">
                                                {{ $site->site_code }}
                                            </a>
                                        </small>                                        
                                        <br/>
                                        
                                        <strong>Location: </strong>                                        
                                                {{ $site->location }}                   
                                        <br/>
                                        <small>                                            
                                            <strong>Project: </strong> 
                                            @php $project = \Tritiyo\Project\Models\Project::where('id', $site->project_id)->first() @endphp
                                            <a href="{{ route('projects.show', $site->project_id) }}"                                                
                                                title="View route">
                                                {{  $project->name }}
                                            </a>
                                        </small>                                        
                                    </p>
                                    <nav class="level is-mobile">
                                        <div class="level-left">
                                            <a href="{{ route('sites.show', $site->id) }}"
                                                class="level-item"
                                                title="View user data">
                                                <span class="icon is-small"><i class="fas fa-eye"></i></span>
                                            </a>

                                            @if(auth()->user()->isAdmin(auth()->user()->id) || auth()->user()->isApprover(auth()->user()->id))
                                                <a href="{{ route('sites.edit', $site->id) }}"
                                                class="level-item"
                                                title="View all transaction">
                                                    <span class="icon is-info is-small"><i class="fas fa-edit"></i></span>
                                                </a>
                                            @endif

                                            {{-- {!! delete_data('sites.destroy',  $site->id) !!} --}}
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination_wrap pagination is-centered">
            {{ $sites->links('pagination::bootstrap-4') }}
        </div>
        @endif
    </article>
@endsection