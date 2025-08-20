<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\CategoryProjectModel;
use App\Models\Admin\QualityControlModel;
use App\Models\Admin\ProjectImageModel;
use App\Models\Admin\QualityControlDetailModel;
use App\Models\Admin\QualityControlImageModel;
use App\Models\Admin\ClientWorkedModel;
use App\Models\Admin\BgModel;
use App\Models\Admin\ContentModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf;

class UserProjectController extends Controller
{
    public function index(Request $request, $categoryPermalink = null)
    {
        $activeMenu = 'project';
        $metaTitle = 'Project';
        $categories = CategoryProjectModel::select('name', 'permalink')->orderBy('order_id')->get();
        $projects = QualityControlModel::with('category')
            ->select('name', 'image', 'permalink', 'category_id')
            ->where('publish', 1);
        $bg = BgModel::select('image')->where('title', 'Project')->first();

        // Filter by category permalink
        if ($categoryPermalink) {
            $category = CategoryProjectModel::where('permalink', $categoryPermalink)->first();
            if ($category) {
                $projects = $projects->where('category_id', $category->id);
            }
        }

        // Apply search filter
        if ($request->input('search')) {
            $projects = $projects->where('name', 'like', '%' . $request->input('search') . '%');
        }

        // Sorting by name
        $sortOrder = $request->input('sort', 'asc'); // default sorting order is ascending
        $projects = $projects->orderBy('name', $sortOrder);

        // Paginate the results (12 per page)
        $projects = $projects->paginate(12)->appends($request->except('page'));

        $clients = ClientWorkedModel::select('name', 'img')
            ->where('publish', 1)
            ->orderBy('order_id', 'asc')
            ->get();

        $metaData = ContentModel::whereIn('name', ['home_meta_keyword', 'home_meta_description'])->pluck('value', 'name');

        $metaKeyword = $metaData['home_meta_keyword'] ?? null;
        $metaDescription = $metaData['home_meta_description'] ?? null;

        return view('user.projects.project', [
            'activeMenu' => $activeMenu,
            'metaTitle' => $metaTitle,
            'bg' => $bg,
            'metaKeyword' => $metaKeyword,
            'metaDescription' => $metaDescription,
            'categories' => $categories,
            'projects' => $projects,
            'categoryPermalink' => $categoryPermalink,
            'sortOrder' => $sortOrder,
            'clients' => $clients,
        ]);
    }

    public function detail($permalink)
    {
        $activeMenu = 'project';
        $metaTitle = 'Project Details';

        $projects = QualityControlModel::select('id', 'name', 'image', 'permalink', 'category_id', 'project_date', 'client', 'product', 'password_access', 'project_info')
            ->where('permalink', $permalink)
            ->firstOrFail();
        $imgDetails = ProjectImageModel::select('img', 'name')
            ->where('project_id', $projects->id)
            ->get();
        $bg = BgModel::select('image')->where('title', 'Project')->first();
        $metaData = ContentModel::whereIn('name', ['home_meta_keyword', 'home_meta_description'])
            ->pluck('value', 'name');

        $metaKeyword = $metaData['home_meta_keyword'] ?? null;
        $metaDescription = $metaData['home_meta_description'] ?? null;

        return view('user.projects.project_detail', [
            'activeMenu' => $activeMenu,
            'metaTitle' => $metaTitle,
            'bg' => $bg,
            'metaKeyword' => $metaKeyword,
            'metaDescription' => $metaDescription,
            'projects' => $projects,
            'imgDetails' => $imgDetails,
        ]);
    }


    public function _auth(Request $request)
    {
        $project = QualityControlModel::where('permalink', $request->permalink)->first();

        if ($project) {
            if (Hash::check($request->password, $project->password_access)) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Incorrect password. Please try again.']);
            }
        }

        return response()->json(['success' => false, 'message' => $request->permalink]);
    }


    public function show(Request $request, $permalink)
    {
        $activeMenu = 'project';
        $metaTitle = 'Project Details';
        $project = QualityControlModel::with('category')
            ->select('id', 'name', 'image', 'permalink', 'category_id')
            ->where('permalink', $permalink)
            ->firstOrFail();
        $projectDetails = QualityControlDetailModel::select('id', 'equipment_code', 'date', 'production_number')
            ->where('project_id', $project->id);

        if ($request->input('search')) {
            $searchTerm = $request->input('search');
            $projectDetails = $projectDetails->where('equipment_code', 'like', '%' . $searchTerm . '%')
                                                ->orWhere('production_number', 'like', '%' . $searchTerm . '%');
        }

        if ($request->input('year') && $request->input('year') !== 'all') {
            $projectDetails = $projectDetails->whereYear('date', $request->input('year'));
        }

        if ($request->input('month') && $request->input('month') !== 'all') {
            $projectDetails = $projectDetails->whereMonth('date', $request->input('month'));
        }

        $projectDetails = $projectDetails->paginate(20)->appends($request->except('page'));
        $bg = BgModel::select('image')->where('title', 'Project')->first();
        $metaData = ContentModel::whereIn('name', ['home_meta_keyword', 'home_meta_description'])
            ->pluck('value', 'name');

        $metaKeyword = $metaData['home_meta_keyword'] ?? null;
        $metaDescription = $metaData['home_meta_description'] ?? null;

        return view('user.projects.show', [
            'activeMenu' => $activeMenu,
            'metaTitle' => $metaTitle,
            'bg' => $bg,
            'metaKeyword' => $metaKeyword,
            'metaDescription' => $metaDescription,
            'project' => $project,
            'projectDetails' => $projectDetails,
        ]);
    }

    public function showDetails($encryptedId)
    {
        $activeMenu = 'project';
        $metaTitle = 'Project Details Form';
        $id = Crypt::decrypt($encryptedId);
        $detail = QualityControlDetailModel::with('projectHeader')->findOrFail($id);
        $project = $detail->projectHeader;
        $bg = BgModel::select('image')->where('title', 'Project')->first();
        $metaData = ContentModel::whereIn('name', ['home_meta_keyword', 'home_meta_description'])
            ->pluck('value', 'name');

        $metaKeyword = $metaData['home_meta_keyword'] ?? null;
        $metaDescription = $metaData['home_meta_description'] ?? null;

        // Paginate images (6 per page)
        $images = QualityControlImageModel::select('img')
            ->where('detail_id', $id)->paginate(6);

        return view('user.projects.form', [
            'activeMenu' => $activeMenu,
            'metaTitle' => $metaTitle,
            'bg' => $bg,
            'metaKeyword' => $metaKeyword,
            'metaDescription' => $metaDescription,
            'detail' => $detail,
            'project' => $project,
            'images' => $images,
        ]);
    }

    public function printPDF($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $detail = QualityControlDetailModel::with('projectHeader')->findOrFail($id);
        $project = $detail->projectHeader;

        // Path gambar watermark
        $watermarkPath = public_path('assets/user/images/pt_best_logo.png');

        $pdf = Pdf::loadView('user.projects.print', compact('project', 'detail', 'watermarkPath'));

        // Set orientation landscape
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('project_details_' . $detail->id . '_' . strtolower(str_replace(' ', '_', $project->name)) . '.pdf');
    }
}
