<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::firstOrCreate(
            [],
            [
                'title' => 'Default Title',
                'description' => 'Default Description'
            ]
        );

        $teamMembers = TeamMember::all(); // Ambil semua anggota tim
        return view('admin.about_us_admin', compact('aboutUs', 'teamMembers'));
    }

     public function edit()
    {
        $aboutUs = AboutUs::firstOrCreate(
            [],
            [
                'title' => 'Default Title',
                'description' => 'Default Description'
            ]
        );

        return view('admin.about_us_edit', compact('aboutUs'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $aboutUs = AboutUs::firstOrCreate([]);
        $aboutUs->title = $request->title;
        $aboutUs->description = $request->description;

        foreach (['image1', 'image2', 'image3'] as $img) {
            if ($request->hasFile($img)) {
                if (!empty($aboutUs->$img) && file_exists(public_path($aboutUs->$img))) {
                    unlink(public_path($aboutUs->$img));
                }

                $image = $request->file($img);
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('about_us_images'), $imageName);

                $aboutUs->$img = 'about_us_images/' . $imageName;
            }
        }

        $aboutUs->save();

        return redirect()->route('admin.about_us_admin')->with('success', 'About Us berhasil diperbarui!');
    }

    public function show()
    {
        $aboutUs = AboutUs::first();
        $teamMembers = TeamMember::all(); // Ambil semua anggota tim

        $descriptionPoints = [];
        if ($aboutUs && $aboutUs->description) {
            $descriptionPoints = array_filter(array_map('trim', explode("\n", $aboutUs->description)));
        }

        return view('about_us', compact('aboutUs', 'descriptionPoints', 'teamMembers'));
    }
    

  // CRUD Team Members
  public function createTeamMember()
  {
      return view('admin.about_us_team_member_create');
  }

  public function storeTeamMember(Request $request)
  {
      $request->validate([
          'name' => 'required|string|max:255',
          'position' => 'required|string|max:255',
          'description' => 'nullable|string',
          'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      ]);

      $teamMember = new TeamMember();
      $teamMember->name = $request->name;
      $teamMember->position = $request->position;
      $teamMember->description = $request->description;

      if ($request->hasFile('image')) {
          $image = $request->file('image');
          $imageName = time() . '_' . $image->getClientOriginalName();
          $image->move(public_path('team_members_images'), $imageName);
          $teamMember->image = 'team_members_images/' . $imageName;
      }

      $teamMember->save();
      return redirect()->route('admin.about_us_admin')->with('success', 'Team Member berhasil ditambahkan!');
  }

  public function editTeamMember($id)
  {
      $member = TeamMember::findOrFail($id);
      return view('admin.team_members_edit', compact('member'));
  }

  public function updateTeamMember(Request $request, $id)
  {
      $request->validate([
          'name' => 'required|string|max:255',
          'position' => 'required|string|max:255',
          'description' => 'nullable|string',
          'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      ]);

      $teamMember = TeamMember::findOrFail($id);
      $teamMember->name = $request->name;
      $teamMember->position = $request->position;
      $teamMember->description = $request->description;

      if ($request->hasFile('image')) {
          if (!empty($teamMember->image) && file_exists(public_path($teamMember->image))) {
              unlink(public_path($teamMember->image));
          }

          $image = $request->file('image');
          $imageName = time() . '_' . $image->getClientOriginalName();
          $image->move(public_path('team_members_images'), $imageName);
          $teamMember->image = 'team_members_images/' . $imageName;
      }

      $teamMember->save();
      return redirect()->route('admin.about_us_admin', ['id' => $id])->with('success', 'Team Member berhasil diperbarui!');
  }


  public function destroyTeamMember($id)
  {
      $teamMember = TeamMember::findOrFail($id);

      if (!empty($teamMember->image) && file_exists(public_path($teamMember->image))) {
          unlink(public_path($teamMember->image));
      }

      $teamMember->delete();
      return redirect()->route('admin.about_us_admin')->with('success', 'Team Member berhasil dihapus!');
  }

}
