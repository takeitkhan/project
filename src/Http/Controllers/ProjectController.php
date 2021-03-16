<?php

namespace Tritiyo\Project\Http\Controllers;

use Tritiyo\Project\Models\Project;
use Tritiyo\Project\Repositories\Project\ProjectInterface;
use Tritiyo\Site\Models\Site;
use Tritiyo\Site\Repositories\SiteInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class ProjectController extends Controller
{
    /**
     * @var ProjectInterface
     */
    private $project;
    private $site;

    /**
     * RoutelistController constructor.
     * @param ProjectInterface $project
     */
    public function __construct(ProjectInterface $project, SiteInterface $site)
    {
        $this->project = $project;
        $this->site = $site;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = $this->project->getAll();
        return view('project::index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'code' => 'required',
                'budget' => 'required'
            ]
        );

        // process the login
        if ($validator->fails()) {
            return redirect('projects.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $attributes = [
                'name' => $request->name,
                'code' => $request->code,
                'type' => $request->type,
                'manager' => $request->manager,
                'customer' => $request->customer,
                'address' => $request->address,
                'vendor' => $request->vendor,
                'supplier' => $request->supplier,
                'location' => $request->location,
                'office' => $request->office,
                'start' => $request->start,
                'end' => $request->end,
                'budget' => $request->budget,
                'summary' => $request->summary,
                'budget_history' => $request->budget_history,
                'is_active' => 1
            ];

            try {
                $project = $this->project->create($attributes);
                return redirect(route('projects.index'))->with(['status' => 1, 'message' => 'Successfully created']);
            } catch (\Exception $e) {
                return view('project::create')->with(['status' => 0, 'message' => 'Error']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('project::show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('project::edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // store
        $attributes = [
            'name' => $request->name,
            'code' => $request->code,
            'type' => $request->type,
            'manager' => $request->manager,
            'customer' => $request->customer,
            'address' => $request->address,
            'vendor' => $request->vendor,
            'supplier' => $request->supplier,
            'location' => $request->location,
            'office' => $request->office,
            'start' => $request->start,
            'end' => $request->end,
            'budget' => $request->budget,
            'summary' => $request->summary,
            'budget_history' => $request->budget_history,
            'is_active' => 1
        ];

        try {
            $project = $this->project->update($project->id, $attributes);

            return back()
                ->with('message', 'Successfully saved')
                ->with('status', 1)
                ->with('project', $project);
        } catch (\Exception $e) {
            return view('project::edit', $project->id)->with(['status' => 0, 'message' => 'Error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->project->delete($id);
        return redirect()->back()->with(['status' => 1, 'message' => 'Successfully deleted']);
    }


    public function site($id){
        $projectId = $id;
        $sites = $this->site->getByAny('project_id', $id);
        return view('project::site', ['sites' => $sites, 'projectId' => $projectId]);
    }
}
