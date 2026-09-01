<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderByDesc('id')->paginate(20);

        return view('admin.team-members.index', [
            'title'   => 'Team Members',
            'members' => $members,
        ]);
    }

    public function create()
    {
        return view('admin.team-members.create', ['title' => 'Add Team Member']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'       => 'required|string|max:100',
            'last_name'        => 'required|string|max:100',
            'job_title'        => 'required|string|max:150',
            'bio'              => 'nullable|string|max:1000',
            'email'            => 'nullable|email|max:255|unique:team_members,email',
            'phone'            => 'nullable|string|max:30',
            'years_experience' => 'nullable|integer|min:0|max:99',
            'specialization'   => 'nullable|string|max:255',
            'is_active'        => 'nullable|boolean',
            'photo'            => 'nullable|image|max:2048|mimes:jpg,jpeg,png,gif,webp',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team-members', 'public');
        }

        $data['is_active'] = $request->boolean('is_active', true);

        TeamMember::create($data);

        return redirect()->route('admin.team-members.index')
            ->with('success', 'Team member created successfully.');
    }

    public function edit($id)
    {
        $member = TeamMember::findOrFail($id);

        return view('admin.team-members.edit', [
            'title'  => 'Edit Team Member',
            'member' => $member,
        ]);
    }

    public function update(Request $request, $id)
    {
        $member = TeamMember::findOrFail($id);

        $data = $request->validate([
            'first_name'       => 'required|string|max:100',
            'last_name'        => 'required|string|max:100',
            'job_title'        => 'required|string|max:150',
            'bio'              => 'nullable|string|max:1000',
            'email'            => 'nullable|email|max:255|unique:team_members,email,' . $member->id,
            'phone'            => 'nullable|string|max:30',
            'years_experience' => 'nullable|integer|min:0|max:99',
            'specialization'   => 'nullable|string|max:255',
            'is_active'        => 'nullable|boolean',
            'photo'            => 'nullable|image|max:2048|mimes:jpg,jpeg,png,gif,webp',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }
            $data['photo'] = $request->file('photo')->store('team-members', 'public');
        }

        $data['is_active'] = $request->boolean('is_active', true);

        $member->update($data);

        return redirect()->route('admin.team-members.index')
            ->with('success', 'Team member updated successfully.');
    }

    public function destroy($id)
    {
        $member = TeamMember::findOrFail($id);

        if ($member->fraudCases()->whereNotIn('status', ['closed'])->exists()) {
            return back()->with('error', 'Cannot delete a team member with active cases assigned. Reassign or close those cases first.');
        }

        if ($member->photo) {
            Storage::disk('public')->delete($member->photo);
        }

        $member->delete();

        return redirect()->route('admin.team-members.index')
            ->with('success', 'Team member deleted.');
    }
}
