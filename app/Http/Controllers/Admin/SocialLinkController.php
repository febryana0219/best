<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SocialLinkModel;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLink = SocialLinkModel::orderBy('order_id')->get();
        $activeMenu = 'system.social_link';
        return view('admin.systems.social_link.index', compact('socialLink', 'activeMenu'));
    }

    public function create()
    {
        $activeMenu = 'system.social_link';
        return view('admin.systems.social_link.create', compact('activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'link' => 'required|string',
            'icon' => 'required|string',
        ]);

        $data = $request->all();
        $data['order_id'] = SocialLinkModel::max('order_id') + 1;

        SocialLinkModel::create($data);
        return redirect()->route('admin.system.social_link.index')->with('success', 'Social link created successfully.');
    }

    public function edit($id)
    {
        $socialLink = SocialLinkModel::findOrFail($id);
        $activeMenu = 'system.social_link';
        return view('admin.systems.social_link.edit', compact('socialLink', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'link' => 'required|string',
            'icon' => 'required|string',
        ]);

        $socialLink = SocialLinkModel::findOrFail($id);
        $socialLink->update($request->all());

        return redirect()->route('admin.system.social_link.index')
                         ->with('success', 'Social link updated successfully.');
    }

    public function order()
    {
        $socialLink = SocialLinkModel::orderBy('order_id')->get();
        $activeMenu = 'system.social_link';
        return view('admin.systems.social_link.order', compact('socialLink', 'activeMenu'));
    }

    public function updateOrder(Request $request)
    {
        $orderIds = $request->input('order');

        foreach ($orderIds as $order_id => $id) {
            SocialLinkModel::where('id', $id)->update(['order_id' => $order_id + 1]);
        }

        return redirect()->route('admin.system.social_link.order')->with('success', 'Order updated successfully.');
    }

    public function update_publish(Request $request, $id)
    {
        $request->validate([
            'publish' => 'required|boolean',
        ]);

        $socialLink = SocialLinkModel::findOrFail($id);

        if (!$socialLink) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $socialLink->publish = $request->publish ? 1 : 0;
        $socialLink->save();

        return response()->json(['message' => 'Publish status updated successfully.']);
    }

    public function destroy($id)
    {
        $socialLink = SocialLinkModel::findOrFail($id);
        $socialLink->delete();

        return redirect()->route('admin.system.social_link.index')
                         ->with('success', 'Social Link deleted successfully');
    }
}
