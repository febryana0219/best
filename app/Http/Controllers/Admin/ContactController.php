<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ContactMessageModel;
use App\Models\Admin\ContactMapModel;
use App\Models\Admin\ContentModel;

class ContactController extends Controller
{
    public function message_index(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort_field', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');

        $messages = ContactMessageModel::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                         ->orWhere('email', 'like', '%' . $search . '%')
                         ->orWhere('subject', 'like', '%' . $search . '%')
                         ->orWhere('message', 'like', '%' . $search . '%');
        })
        ->orderBy($sortField, $sortDirection)
        ->paginate(10);

        $activeMenu = 'contact.message';
        return view('admin.contacts.message.index', compact('messages', 'activeMenu', 'search', 'sortField', 'sortDirection'));
    }

    public function address_index()
    {
        $contactAddress = ContactMapModel::all();

        $activeMenu = 'contact.address';
        return view('admin.contacts.address.index', compact('contactAddress', 'activeMenu'));
    }

    public function address_edit($id)
    {
        $contactAddress = ContactMapModel::findOrFail($id);

        $activeMenu = 'contact.address';
        return view('admin.contacts.address.edit', compact('contactAddress', 'activeMenu'));
    }

    public function address_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'longitude' => 'required|max:50',
            'latitude' => 'required|max:50',
            'publish' => 'required|integer',
        ]);

        $contactAddress = ContactMapModel::findOrFail($id);
        $contactAddress->update($request->all());

        return redirect()->route('admin.contact.address.index')
                         ->with('success', 'Contact address updated successfully.');
    }

    public function address_update_publish(Request $request, $id)
    {
        $request->validate([
            'publish' => 'required|boolean',
        ]);

        $contactAddress = ContactMapModel::findOrFail($id);

        if (!$contactAddress) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $contactAddress->publish = $request->publish ? 1 : 0;
        $contactAddress->save();

        return response()->json(['message' => 'Publish status updated successfully.']);
    }

    public function whatsapp()
    {
        $whatsapp = ContentModel::where('name', 'contact_whatsapp')->first();

        $activeMenu = 'contact.whatsapp';
        return view('admin.contacts.whatsapp.edit', compact('whatsapp', 'activeMenu'));
    }

    public function whatsapp_update(Request $request)
    {
        $request->validate([
            'contact_whatsapp' => 'required|string',
        ]);

        $whatsapp = ContentModel::where('name', 'contact_whatsapp')->first();
        if ($whatsapp) {
            $whatsapp->value = $request->input('contact_whatsapp');
            $whatsapp->save();
        }

        return redirect()->route('admin.contact.whatsapp.index')->with('success', 'Contact whatsapp updated successfully!');
    }
}
