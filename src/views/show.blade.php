@extends('layouts.app')

@section('title')
    Single Project
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
            'spTitle' => 'Single Project',
            'spSubTitle' => 'view a Project',
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
            'spAddUrl' => route('projects.create'),
            'spAllData' => route('projects.index'),
            'spSearchData' => route('projects.search'),
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
            <div class="card-content">
                <div class="card-data">

                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" style="text-align: left;">
                        <tr>
                            <td colspan="4">
                                Project Information
                            </td>
                        </tr>

                        <tr>
                            <td colspan="4">
                                <table class="table is-bordered is-striped is-narrow is-fullwidth">
                                    <tr>
                                        <td>
                                            
                                            <div class="tag is-success has-text-white" style="font-size: 16px;">
                                                Total Running Site: {{ status_based_count($project->id, 'Running') }}
                                                
                                            </div>                                            
                                        </td>
                                        <td>
                                            <div class="tag is-link has-text-white" style="font-size: 16px;">
                                                Total Completed Site: {{ status_based_count($project->id, 'Completed') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="tag is-dark has-text-white" style="font-size: 16px;">
                                                Total Rejected Site: {{ status_based_count($project->id, 'Rejected') }}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="notification is-warning has-text-centered">                                    
                                    Budget <br/>
                                    <h1 class="title">                                        
                                        BDT. {{ $project->budget }}
                                    </h1>
                                  </div>
                            </td>
                            <td colspan="2">
                                <div class="notification is-link has-text-centered">
                                    Budget Used
                                    <h1 class="title">
                                        @php
                                            $multiple_tasks = \Tritiyo\Task\Models\Task::where('project_id', $project->id)->get();
                                            
                                            $total_requisition = [];
                                            foreach($multiple_tasks as $task) {
                                                #SELECT * FROM `tasks` WHERE project_id = 8
                                                $rm = new \Tritiyo\Task\Helpers\SiteHeadTotal('requisition_edited_by_accountant', $task->id);
                                                $total_requisition[] = $rm->getTotal();
                                            }                                            
                                        @endphp

                                        BDT. {{ array_sum($total_requisition) }}
                                    </h1>
                                  </div>
                            </td>
                        </tr>                        
                        <tr>
                            <td colspan="4">&nbsp;</td>
                        </tr>

                        @php
                            function status_based_count($project_id, $status) {
                                $total_sites = \Tritiyo\Site\Models\Site::where('project_id', $project_id)->where('completion_status', $status)->get();
                                //dd($total_sites);
                                return count($total_sites);
                                #SELECT * FROM sites WHERE project_id = 8 AND completion_status = 'Running'
                            }
                        @endphp

                        

                        <tr>
                            <td width="15%"><strong>Project Name:</strong></td>
                            <td>{{$project->name}}</td>
                            <td width="15%"><strong>Project Code:</strong></td>
                            <td>{{ $project->code }}</td>
                        </tr>


                        <tr>
                            <td><strong>Project Type:</strong></td>
                            <td>{{ $project->type }}</td>
                            <td><strong>Project Manager:</strong></td>
                            <td>
                                @php $projectManager = \App\Models\User::where('id', $project->manager)->first() @endphp
                                {{ !empty($projectManager) ? $projectManager->name : '' }}
                            </td>
                        </tr>

                        <tr>
                            <td><strong>Project customer:</strong></td>
                            <td>{{ $project->customer }}</td>
                            <td><strong>Project vendor:</strong></td>
                            <td>{{ $project->vendor }}</td>
                        </tr>

                        <tr>
                            <td><strong>Project supplier:</strong></td>
                            <td>{{ $project->supplier }}</td>
                            <td><strong></strong></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td><strong>Project address:</strong></td>
                            <td>{{ $project->address }}</td>
                            <td><strong>Project location:</strong></td>
                            <td>{{ $project->location }}</td>
                        </tr>

                        <tr>
                            <td><strong>Head Office:</strong></td>
                            <td>{{ $project->office }}</td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td><strong>Project start:</strong></td>
                            <td>{{ $project->start }}</td>
                            <td><strong>Approximate project end:</strong></td>
                            <td>{{ $project->end }}</td>
                        </tr>

                        <tr>
                            <td colspan="4">
                                {{ $project->summary }}
                            </td>
                        </tr>
                        
                    </table>
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
