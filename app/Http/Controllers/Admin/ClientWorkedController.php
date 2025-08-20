<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ClientWorkedModel;
use Illuminate\Support\Facades\Storage;

class ClientWorkedController extends Controller
{
    public function index()
    {
        $activeMenu = 'homepage.client_worked';
        $client_worked = ClientWorkedModel::orderBy('order_id', 'asc')->get();
        return view('admin.home_page.client_worked.index', compact('client_worked', 'activeMenu'));
    }

    public function create()
    {
        $activeMenu = 'homepage.client_worked';
        return view('admin.home_page.client_worked.create', compact('activeMenu'));
    }

    public function store(Request $request)
    {
        $currentDateTime = now()->format('Ymd-His');

        $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'required|file|max:10240|mimes:jpeg,jpg,png,gif', // Max 10MB
        ]);

        $imgFileName = '';

        if ($request->hasFile('img')) {
            $imgFile = $request->file('img');
            $imgFileName = 'CW-' . $currentDateTime . '.' . $imgFile->getClientOriginalExtension();

            $imgFile->storeAs('public/uploads/client_worked', $imgFileName);
        } else {
            return redirect()->back()->withErrors(['img' => 'Image is required.']);
        }

        ClientWorkedModel::create([
            'name' => $request->name,
            'img' => $imgFileName,
            'order_id' => ClientWorkedModel::max('order_id') + 1,
        ]);

        return redirect()->route('admin.homepage.client_worked.index')
                         ->with('success', 'Client worked created successfully.');
    }


    public function edit($id)
    {
        $activeMenu = 'homepage.client_worked';
        $client_worked = ClientWorkedModel::findOrFail($id);
        return view('admin.home_page.client_worked.edit', compact('client_worked', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $clientworked = ClientWorkedModel::findOrFail($id);

        $currentDateTime = now()->format('Ymd-His');

        $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'nullable|file|max:10240|mimes:jpeg,jpg,png,gif', // Max 10MB
        ]);

        if ($request->hasFile('img')) {
            $imgFile = $request->file('img');
            $imgFileName = 'CW-' . $currentDateTime . '.' . $imgFile->getClientOriginalExtension();

            $imgFile->storeAs('public/uploads/client_worked', $imgFileName);

            if ($clientworked->img) {
                Storage::delete("public/uploads/client_worked/{$clientworked->img}");
            }

            $clientworked->img = $imgFileName;
        }

        $clientworked->name = $request->name;

        $clientworked->save();

        return redirect()->route('admin.homepage.client_worked.index')
                         ->with('success', 'Client worked updated successfully.');
    }


    public function order()
    {
        $activeMenu = 'homepage.client_worked';
        $client_worked = ClientWorkedModel::orderBy('order_id')->get();
        return view('admin.home_page.client_worked.order', compact('client_worked', 'activeMenu'));
    }

    public function updateOrder(Request $request)
    {
        $orderIds = $request->input('order');

        foreach ($orderIds as $order_id => $id) {
            ClientWorkedModel::where('id', $id)->update(['order_id' => $order_id + 1]);
        }

        return redirect()->route('admin.homepage.client_worked.order')->with('success', 'Order updated successfully.');
    }

    public function update_publish(Request $request, $id)
    {
        $request->validate([
            'publish' => 'required|boolean',
        ]);

        $client_worked = ClientWorkedModel::findOrFail($id);

        if (!$client_worked) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $client_worked->publish = $request->publish ? 1 : 0;
        $client_worked->save();

        return response()->json(['message' => 'Publish status updated successfully.']);
    }

    public function destroy($id)
    {
        $clientworked = ClientWorkedModel::findOrFail($id);

        $imgFilePath = 'uploads/client_worked/' . $clientworked->img;
        $portraitFilePath = 'uploads/client_worked/' . $clientworked->img_portrait;

        if ($clientworked->img && Storage::disk('public')->exists($imgFilePath)) {
            Storage::disk('public')->delete($imgFilePath);
        }

        if ($clientworked->img_portrait && Storage::disk('public')->exists($portraitFilePath)) {
            Storage::disk('public')->delete($portraitFilePath);
        }

        $clientworked->delete();

        return redirect()->route('admin.homepage.client_worked.index')
                         ->with('success', 'Client worked deleted successfully.');
    }
}
