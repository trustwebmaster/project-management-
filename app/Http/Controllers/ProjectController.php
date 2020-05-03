<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use App\ProjectUser;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::check()) {
            $projects = Project::where('user_id', Auth::user()->id)->get();

            return view('projects.index', ['projects' => $projects]);
        }
        return view('auth.login');
    }


    public function adduser(Request $request)
    {
        //add user to projects

        //take a project, add a user to it
        $project = Project::find($request->input('project_id'));



        if (Auth::user()->id == $project->user_id) {

            $user = User::where('email', $request->input('email'))->first(); //single record

            //check if user is already added to the project
            $projectUser = ProjectUser::where('user_id', $user->id)
                ->where('project_id', $project->id)
                ->first();

            if ($projectUser) {
                //if user already exists, exit
                return redirect()->route('projects.show', ['project' => $project->id])
                    ->with('success', $request->input('email') . ' is already a member of this project');
                //     return response()->json(['success' ,  $request->input('email').' is already a member of this project']);

            }


            if ($user && $project) {

                $project->users()->attach($user->id);

                return redirect()->route('projects.show', ['project' => $project->id])
                    ->with('success', $request->input('email') . ' has been added to this project');
            }
        }

        return redirect()->route('projects.show', ['project' => $project->id])
            ->with('errors',  'Error adding user to project');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id = null)
    {
        $companies = null;
        if (!$company_id) {
            $companies = Company::where('user_id', Auth::user()->id)->get();
        }

        return view('projects.create', ['company_id' => $company_id, 'companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Auth::check()) {
            $project = Project::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'company_id' => $request->input('company_id'),
                'user_id' => Auth::user()->id
            ]);


            if ($project) {
                return redirect()->route('projects.show', ['project' => $project->id])
                    ->with('success', 'project created successfully');
            }
        }

        return back()->withInput()->with('errors', 'Error creating new project');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // $project = Project::where('id', $project->id )->first();
        $project = Project::find($project->id);

        $comments = $project->comments;
        $items = \App\Product::with('used')->where('project_id', $project->id)->get();
        return view('projects.show', ['project' => $project, 'comments' => $comments, 'items' => $items]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
        $project = Project::find($project->id);

        return view('projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, project $project)
    {

        //save data

        $projectUpdate = Project::where('id', $project->id)
            ->update([
                'name' => $request->input('name'),
                'description' => $request->input('description')
            ]);

        if ($projectUpdate) {
            return redirect()->route('projects.show', ['project' => $project->id])
                ->with('success', 'project updated successfully');
        }
        //redirect
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //

        $findproject = Project::find($project->id);
        if ($findproject->delete()) {

            //redirect
            return redirect()->route('projects.index')
                ->with('success', 'project deleted successfully');
        }

        return back()->withInput()->with('error', 'project could not be deleted');
    }

    public function printPdf (Project $project) {
        $html = "<h1>$project->name</h1>";
        $html .= "<h2>Description</h2>";
        $html .= "<p>$project->description</p>";
        $html .= "<h2>Stock</h2>";

        $stock = \App\Product::where('project_id', $project->id)->get();

        if ($stock) {
            $html .= '<table><thead>';
            $html .= '<tr>';
            $html .= '<th>Item</th>';
            $html .= '<th>Initial qty</th>';
            $html .= '<th>Used qty</th>';
            $html .= '<th>Remaining qty</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            
            foreach( $stock as $item ) {
                logger( $item );
                $used = (int) $this->_calUsedStock( $item );
                $quantity = ( int ) $item->quantity;
                $html .= '<tr>';
                $html .= '<td>' . $item->product_name . '</td>';
                $html .= '<td>' . $quantity . '</td>';
                $html .= '<td>' . $used . '</td>';
                $html .= '<td>'. ( $quantity - $used ) .'</td>';
                $html .= '</tr>';
            }

            $html .= '</tbody>';
            $html .= '</table>';

            $mpdf = new \Mpdf\Mpdf();

            $mpdf->WriteHTML($html);

            // Output a PDF file directly to the browser
            return $mpdf->Output();
        }


    }

    private function _calUsedStock($item){
        $total = 0;
        $used = $item->used;

        foreach ( $used as $item ) {
            $total = $total + $item->quantity;
        }

        return $total;
    }

}
