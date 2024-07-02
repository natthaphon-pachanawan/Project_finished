<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarthelAdl;
use App\Models\Elderly;
use Illuminate\Support\Facades\Auth;

class ADLController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $adls = BarthelAdl::with('elderly')
            ->when($search, function ($query, $search) {
                return $query->where('Name_Elderly', 'LIKE', "%$search%");
            })->paginate(10);

        return view('staff.ADL.ShowADL', compact('adls'));
    }


    public function create()
    {
        $elderlies = Elderly::all();
        return view('staff.ADL.ADL', compact('elderlies'));
    }

    public function submitADL(Request $request)
    {
        // Validate the input
        $request->validate([
            'elderly_id' => 'required|integer',
            'feeding' => 'required|integer',
            'grooming' => 'required|integer',
            'transfer' => 'required|integer',
            'toilet_use' => 'required|integer',
            'mobility' => 'required|integer',
            'dressing' => 'required|integer',
            'stairs' => 'required|integer',
            'bathing' => 'required|integer',
            'bowels' => 'required|integer',
            'bladder' => 'required|integer',
        ]);

        // Calculate the total score
        $totalScore = $request->feeding + $request->grooming + $request->transfer + $request->toilet_use + $request->mobility + $request->dressing + $request->stairs + $request->bathing + $request->bowels + $request->bladder;

        // Determine the group based on the total score
        if ($totalScore >= 0 && $totalScore <= 4) {
            $group = 'กลุ่มติดสังคม';
        } elseif ($totalScore >= 5 && $totalScore <= 11) {
            $group = 'กลุ่มติดบ้าน';
        } else {
            $group = 'กลุ่มติดเตียง';
        }

        // Get elderly and user information
        $elderly = Elderly::find($request->elderly_id);
        $user = Auth::user();

        // Create a new ADL record
        BarthelAdl::create([
            'ID_Elderly' => $elderly->ID_Elderly,
            'Name_Elderly' => $elderly->Name_Elderly,
            'ID_User' => $user->ID_User,
            'Name_User' => $user->Name_User,
            'Score_ADL' => $totalScore,
            'Group_ADL' => $group,
            'Feeding' => $request->feeding,
            'Grooming' => $request->grooming,
            'Transfer' => $request->transfer,
            'Toilet_use' => $request->toilet_use,
            'Mobility' => $request->mobility,
            'Dressing' => $request->dressing,
            'Stairs' => $request->stairs,
            'Bathing' => $request->bathing,
            'Bowels' => $request->bowels,
            'Bladder' => $request->bladder,
        ]);

        return redirect()->back()->with('success', 'ADL Assessment submitted successfully!');
    }

    public function edit($id)
{
    $adl = BarthelAdl::findOrFail($id);
    $elderlies = Elderly::all();
    return view('staff.ADL.EditADL', compact('adl', 'elderlies'));
}

public function update(Request $request, $id)
{
    $adl = BarthelAdl::findOrFail($id);

    $request->validate([
        'elderly_id' => 'required|integer',
        'feeding' => 'required|integer',
        'grooming' => 'required|integer',
        'transfer' => 'required|integer',
        'toilet_use' => 'required|integer',
        'mobility' => 'required|integer',
        'dressing' => 'required|integer',
        'stairs' => 'required|integer',
        'bathing' => 'required|integer',
        'bowels' => 'required|integer',
        'bladder' => 'required|integer',
    ]);

    $totalScore = $request->feeding + $request->grooming + $request->transfer + $request->toilet_use + $request->mobility + $request->dressing + $request->stairs + $request->bathing + $request->bowels + $request->bladder;

    if ($totalScore >= 0 && $totalScore <= 4) {
        $group = 'กลุ่มติดสังคม';
    } elseif ($totalScore >= 5 && $totalScore <= 11) {
        $group = 'กลุ่มติดบ้าน';
    } else {
        $group = 'กลุ่มติดเตียง';
    }

    $adl->update([
        'ID_Elderly' => $request->elderly_id,
        'Name_Elderly' => Elderly::find($request->elderly_id)->Name_Elderly,
        'Score_ADL' => $totalScore,
        'Group_ADL' => $group,
        'Feeding' => $request->feeding,
        'Grooming' => $request->grooming,
        'Transfer' => $request->transfer,
        'Toilet_use' => $request->toilet_use,
        'Mobility' => $request->mobility,
        'Dressing' => $request->dressing,
        'Stairs' => $request->stairs,
        'Bathing' => $request->bathing,
        'Bowels' => $request->bowels,
        'Bladder' => $request->bladder,
    ]);

    return redirect()->route('adl.index')->with('success', 'ADL Assessment updated successfully!');
}

public function destroy($id)
{
    $adl = BarthelAdl::findOrFail($id);
    $adl->delete();

    return redirect()->route('adl.index')->with('success', 'ADL Assessment deleted successfully!');
}

}
