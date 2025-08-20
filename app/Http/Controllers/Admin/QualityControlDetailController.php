<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\QualityControlModel;
use App\Models\Admin\QualityControlDetailModel;
use App\Models\Admin\QualityControlImageModel;
use Illuminate\Support\Facades\Storage;

class QualityControlDetailController extends Controller
{
    public function index(Request $request, $projectId)
    {
        $activeMenu = 'qc.project';
        $search = $request->input('search');

        $projectDetail = QualityControlDetailModel::when($search, function ($query, $search) {
            return $query->where('equipment_code', 'like', '%' . $search . '%')
                ->orWhere('production_number', 'like', '%' . $search . '%');
            })
            ->where('project_id', $projectId)
            ->orderBy('id', 'desc')
            ->paginate(10);
        $projectHeader = QualityControlModel::findOrFail($projectId);

        return view('admin.quality_control.project.project_detail.index', compact('activeMenu', 'projectDetail', 'projectHeader', 'search'));
    }

    public function create($projectId)
    {
        $projectHeader = QualityControlModel::findOrFail($projectId);

        $activeMenu = 'qc.project';
        return view('admin.quality_control.project.project_detail.create', compact('projectHeader', 'activeMenu'));
    }
    public function store(Request $request, $projectId)
    {
        $request->validate([
            'project_id' => 'required|integer|exists:project,id',
            'equipment_code' => 'required|string|max:50',
            'production_number' => 'required|string|max:50',
            'date' => 'required|date',
            'contractor_name' => 'required|string|max:50',
            'pipe_type' => 'required|string|max:50',
            'pipe_size' => 'required|string|max:25',
            'pipe_qty' => 'required|string|max:50',
            'pipe_length' => 'required|string|max:25',
            'jacketing_type' => 'required|integer',
            'jacketing_size' => 'required|integer',
            'jacket_od' => 'required|string|max:50',
            'density' => 'required|integer',
            'thickness_pu_1' => 'required|integer',
            'thickness_pu_2' => 'required|integer',
            'thickness_pu_3' => 'required|integer',
            'thickness_pu_4' => 'required|integer',
            'tolerance' => 'required|string|max:5',
        ]);

        $projectDetail = QualityControlDetailModel::create([
            'project_id' => $request->project_id,
            'equipment_code' => $request->equipment_code,
            'production_number' => $request->production_number,
            'date' => $request->date,
            'contractor_name' => $request->contractor_name,
            'pipe_type' => $request->pipe_type,
            'pipe_size' => $request->pipe_size,
            'pipe_qty' => $request->pipe_qty,
            'pipe_length' => $request->pipe_length,
            'jacketing_type' => $request->jacketing_type,
            'jacketing_size' => $request->jacketing_size,
            'jacket_od' => $request->jacket_od,
            'density' => $request->density,
            'thickness_pu_1' => $request->thickness_pu_1,
            'thickness_pu_2' => $request->thickness_pu_2,
            'thickness_pu_3' => $request->thickness_pu_3,
            'thickness_pu_4' => $request->thickness_pu_4,
            'tolerance' => $request->tolerance,
        ]);

        return redirect()->route('admin.qc.project.project_detail.index', $request->project_id)
                         ->with('success', 'Project detail created successfully!');
    }

    public function edit($projectId, $id)
    {
        $projectDetail = QualityControlDetailModel::findOrFail($id);
        $projectHeader = QualityControlModel::findOrFail($projectId);

        $activeMenu = 'qc.project';
        return view('admin.quality_control.project.project_detail.edit', compact('projectDetail', 'projectHeader', 'activeMenu'));
    }

    public function update(Request $request, $projectId, $id)
    {
        $request->validate([
            'project_id' => 'required|integer|exists:project,id',
            'equipment_code' => 'required|string|max:50',
            'production_number' => 'required|string|max:50',
            'date' => 'required|date',
            'contractor_name' => 'required|string|max:50',
            'pipe_type' => 'required|string|max:50',
            'pipe_size' => 'required|string|max:25',
            'pipe_qty' => 'required|string|max:50',
            'pipe_length' => 'required|string|max:25',
            'jacketing_type' => 'required|integer',
            'jacketing_size' => 'required|integer',
            'jacket_od' => 'required|string|max:50',
            'density' => 'required|integer',
            'thickness_pu_1' => 'required|integer',
            'thickness_pu_2' => 'required|integer',
            'thickness_pu_3' => 'required|integer',
            'thickness_pu_4' => 'required|integer',
        ]);

        $projectDetail = QualityControlDetailModel::findOrFail($id);

        $projectDetail->update([
            'project_id' => $request->project_id,
            'equipment_code' => $request->equipment_code,
            'production_number' => $request->production_number,
            'date' => $request->date,
            'contractor_name' => $request->contractor_name,
            'pipe_type' => $request->pipe_type,
            'pipe_size' => $request->pipe_size,
            'pipe_qty' => $request->pipe_qty,
            'pipe_length' => $request->pipe_length,
            'jacketing_type' => $request->jacketing_type,
            'jacketing_size' => $request->jacketing_size,
            'jacket_od' => $request->jacket_od,
            'density' => $request->density,
            'thickness_pu_1' => $request->thickness_pu_1,
            'thickness_pu_2' => $request->thickness_pu_2,
            'thickness_pu_3' => $request->thickness_pu_3,
            'thickness_pu_4' => $request->thickness_pu_4,
        ]);

        return redirect()->route('admin.qc.project.project_detail.index', $request->project_id)
                         ->with('success', 'Project detail updated successfully!');
    }

    public function destroy($projectId, $id)
    {
        $projectDetail = QualityControlDetailModel::findOrFail($id);

        $images = QualityControlImageModel::where('detail_id', $id)->get();

        if ($images->isNotEmpty()) {
            foreach ($images as $image) {
                if ($image->img && Storage::exists("public/uploads/quality_control_detail/{$image->img}")) {
                    Storage::delete("public/uploads/quality_control_detail/{$image->img}");
                }
            }

            QualityControlImageModel::where('detail_id', $id)->delete();

            $projectDetail->delete();

            return redirect()->route('admin.qc.project.project_detail.index', $projectId)
                            ->with('success', 'Project detail and its images deleted successfully.');
        }

        $projectDetail->delete();

        return redirect()->route('admin.qc.project.project_detail.index', $projectId)
                         ->with('success', 'Project detail deleted successfully.');
    }
}


