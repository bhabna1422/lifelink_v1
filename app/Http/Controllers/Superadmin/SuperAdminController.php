<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Accompany;
use App\Models\MealStaff;
use App\Models\Meal;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use DB;

use App\Models\Admin;

use Illuminate\Support\Facades\Hash;


class SuperAdminController extends Controller
{
    //
    public function superadminlogin(){
        return view("superadminlogin");
    }
    public function superadminauthenticate(Request $request)
    {
        
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        // $credentials = $request->only('name', 'password');
        if (Auth::guard('superadmins')->attempt($request->only('email', 'password'))) {
            // Authentication passed...
            // dd("hi");
            return redirect()->intended('/superadmin/dashboard');
            // return view("/superadmin/dashboard");
        }
       
        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']); // Redirect back with error message
    }
public function superadminlogout(Request $request)
{
    Auth::guard('superadmins')->logout(); // Use the 'superadmins' guard

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('superadminlogin'); // Redirect to superadmin login page
}

    public function dashboard(){
        return view('/superadmin/dashboard');
    }
    public function addadmin(){
        return view('/superadmin/addadmin');
    }
    public function saveAdmin(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8',
        ]);

        // Create a new admin
        $admin = new Admin();
        
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->password = Hash::make($request->input('password'));
        
        $admin->status = 'active'; // Set status to active

        // Save the admin
        $admin->save();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Admin added successfully!');
    }

    public function adminlist(){
        $adminlists = Admin::where('status', 'active')->get();
        return view('/superadmin/adminlist',compact('adminlists'));
    }
    //  public function doctorlist(){
    //     // Eager load the accompanies relationship and filter where the doctor's status is 'active'
    //     $doctorlists = User::with('accompanies')
    //                         ->where('status', 'active') // Add where clause for active status
    //                         ->get();
                            
    //     return view('superadmin.managedoctors', compact('doctorlists'));
    // }
    public function doctorlist()
{
    // Eager load the accompanies relationship and filter where the doctor's status is 'active'
    $doctorlists = User::with(['accompanies' => function ($query) {
        $query->where('status', 'active'); // Filter accompanying members to be active
    }])
    ->where('status', 'active') // Filter doctors to be active
    ->get();

    return view('superadmin.managedoctors', compact('doctorlists'));
}

public function listMeals()
{
    // Fetch all meals from the MealStaff table
    // $meals = Meal::select('unique_code', 'name', 'meal', 'date')
    //                   ->get()
    //                   ->groupBy('unique_code'); // Group meals by the unique_code
    // Fetch all records from MealStaff table without relationships
    $meals = Meal::get();
    // Pass the grouped meals to the view
    return view('superadmin.meals_list', compact('meals'));
}

// public function listAllDoctorsAndAccompanies()
// {
//     // Retrieve all doctors and their accompanies along with meal data
//     $doctorlists = User::with(['accompanies', 'meals' => function ($query) {
//         $query->select('unique_code'','ref_id', 'meal', 'date');
//     }])->get();

//     return view('superadmin.doctors_accompanies_list', compact('doctorlists'));
// }
// public function listAllDoctorsAndAccompanies()
// {
//     // Retrieve all doctors and their accompanies along with meal data
//     $doctorlists = User::with(['accompanies', 'meals' => function ($query) {
//         $query->select('unique_code','ref_id', 'meal', 'date');
//     }])->get();

//     return view('superadmin.doctors_accompanies_list', compact('doctorlists'));
// }

// public function listAllDoctorsAndAccompanies()
// {
//     // Retrieve all doctors with their meals and active accompaniments
//     $doctorlists = User::where('status', 'active') // Ensure the user is active
//         ->with(['meals', 'accompanies' => function ($query) {
//             $query->where('status', 'active') // Ensure the accompaniments are active
//                 ->with('meals'); // Load meals for each accompaniment
//         }])
//         ->get();

//     return view('superadmin.doctors_accompanies_list', compact('doctorlists'));
// }
public function listAllDoctorsAndAccompanies()
{
    // Retrieve all doctors with their meals and active accompaniments
    $doctorlists = User::where('status', 'active') // Ensure the user is active
        ->with(['meals', 'accompanies' => function ($query) {
            $query->where('status', 'active') // Ensure the accompaniments are active
                ->with('meals'); // Load meals for each accompaniment
        }])
        ->get();

    return view('superadmin.doctors_accompanies_list', compact('doctorlists'));
}

// public function listAllDoctorsAndAccompanies()
// {
//     // Retrieve all users (doctors and faculty) with their meals and active accompaniments
//     $doctorlists = User::where('status', 'active') // Ensure the user is active
//         ->with(['meals' => function ($query) {
//             // Load meals for both doctor and faculty types
//             $query->whereIn('type', ['doctor', 'Faculty']);
//         }, 'accompanies' => function ($query) {
//             // Load accompaniments with meals for the accompany type
//             $query->where('status', 'active')
//                 ->with(['meals' => function ($mealQuery) {
//                     $mealQuery->where('type', 'accompany');
//                 }]);
//         }])
//         ->get();

//     // Pass the data to the view
//     return view('superadmin.doctors_accompanies_list', compact('doctorlists'));
// }

public function listAllstaffs()
{
    // Fetch all records from MealStaff table without relationships
    $staffs = MealStaff::get();

    // Pass the data to the view
    return view('superadmin.staffs', compact('staffs'));
}






    public function doctorregistration(){
        return view('/superadmin/doctorregistration');
    }

 
   public function saveDoctor(Request $request)
{
    // Validate required doctor fields
    $request->validate([
        'unique_code' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'contact_no' => 'required|string|max:10',
        'email' => 'required|email|max:255',
        'state' => 'required|string|max:255',
    ]);

    // Save doctor data in the users table
    $doctor = new User();
    $doctor->unique_code = $request->input('unique_code');
    $doctor->name = $request->input('name');
    $doctor->contact_no = $request->input('contact_no');
    $doctor->email = $request->input('email');
    $doctor->state = $request->input('state');
    $doctor->type = 'doctor';
    $doctor->ref_id = $doctor->unique_code;
    $doctor->status = 'active'; // Set status to 'active'
    $doctor->save();

    // Generate QR code for the doctor and save as SVG
    $doctorData = [
        'unique_code' => $doctor->unique_code,
        'name' => $doctor->name,
        'ref_id' => $doctor->unique_code,
        'type' => 'doctor'
    ];

    $doctorQrCode = QrCode::format('png')->size(300)->generate(json_encode($doctorData));
    $doctorQrPath = "qrcodes/{$doctor->unique_code}_doctor.png";
    file_put_contents(public_path($doctorQrPath), $doctorQrCode);

    $doctor->qr_code_path = $doctorQrPath;
    $doctor->save();

    // Save accompanying data only if both unique_code and accompany_name are provided
    if ($request->has('accompany_unique_code') && $request->has('accompany_name')) {
        foreach ($request->input('accompany_name') as $index => $accompanyName) {
            // Check if the accompany data at the index is valid (both fields filled)
            if (!empty($accompanyName) && !empty($request->input('accompany_unique_code')[$index])) {
                $accompany = new Accompany();
                $accompany->unique_code = $request->input('accompany_unique_code')[$index];
                $accompany->name = $accompanyName;
                $accompany->ref_id = $doctor->unique_code;
                $accompany->type = 'accompany';
                $accompany->status = 'active'; // Set status to 'active'
                $accompany->save();

                // Generate QR code for the accompany
                $accompanyData = [
                    'unique_code' => $accompany->unique_code,
                    'name' => $accompany->name,
                    'ref_id' => $accompany->ref_id,
                    'type' => 'accompany'
                ];

                $accompanyQrCode = QrCode::format('png')->size(300)->generate(json_encode($accompanyData));
                $accompanyQrPath = "qrcodes/{$accompany->unique_code}_accompany.png";
                file_put_contents(public_path($accompanyQrPath), $accompanyQrCode);

                $accompany->qr_code_path = $accompanyQrPath;
                $accompany->save();
            }
        }
    }

    return back()->with('success', 'Doctor and accompanying data saved successfully!');
}


    public function dltdoctor($id)
    {
        // Find the doctor by ID
        $doctor = User::find($id);
    
        if ($doctor) {
            // Deactivate the doctor in the users table
            $doctor->status = 'deactive';
            $doctor->save();
    
            // Fetch ref_id to deactivate accompanying records
            $ref_id = $doctor->ref_id;
    
            // Deactivate accompanying records in the accompany table
            DB::table('accompany')
                ->where('ref_id', $ref_id)
                ->update(['status' => 'deactive']);
    
            // Optionally, flash a success message
            return redirect()->back()->with('success', 'Doctor and accompanying records have been deactivated successfully.');
        }
    
        // If doctor does not exist, return an error
        return redirect()->back()->with('error', 'Doctor not found.');
    }


    
    // public function saveDoctor(Request $request)
    // {
    //     // Save doctor data in the users table
    //     $doctor = new User();
    //     $doctor->unique_code = $request->input('unique_code');
    //     $doctor->name = $request->input('name');
    //     $doctor->contact_no = $request->input('contact_no');
    //     $doctor->state = $request->input('state');
    //     $doctor->type = 'doctor';
    //     $doctor->ref_id = $doctor->unique_code;
    //     $doctor->save();
    
    //     // Generate QR code for the doctor
    //     $doctorData = "Unique Code: {$doctor->unique_code}, Name: {$doctor->name}, Ref ID: {$doctor->unique_code}, Type: {$doctor->type}";
    //     $doctorQrPath = public_path("qrcodes/{$doctor->unique_code}_doctor.png");
    //     QrCode::format('png')->size(300)->generate($doctorData, $doctorQrPath);
    
    //     // Save accompanying data
    //     if ($request->has('unique_code') && $request->has('name')) {
    //         foreach ($request->input('name') as $index => $accompanyName) {
    //             $accompany = new Accompany();
    //             $accompany->unique_code = $request->input('unique_code')[$index];
    //             $accompany->name = $accompanyName;
    //             $accompany->ref_id = $doctor->unique_code;
    //             $accompany->type = 'accompany';
    //             $accompany->save();
    
    //             // Generate QR code for the accompany
    //             $accompanyData = "Unique Code: {$accompany->unique_code}, Name: {$accompany->name}, Ref ID: {$accompany->ref_id}, Type: {$accompany->type}";
    //             $accompanyQrPath = public_path("qrcodes/{$accompany->unique_code}_accompany.png");
    //             QrCode::format('png')->size(300)->generate($accompanyData, $accompanyQrPath);
    //         }
    //     }
    
    //     return back()->with('success', 'Doctor and Accompany data saved successfully!');
    // }

        
    public function editadmin($id){
        // dd("hi");
        $adminlists = Admin::where('id', $id)->first();
        return view('/superadmin/editadmin',compact('adminlists'));
    }
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phonenumber' => 'required|digits:10',
            
        ]);

        $adminlists = Admin::find($id);
        $adminlists->name = $request->name;
        $adminlists->email = $request->email;
        $adminlists->phonenumber = $request->phonenumber;
        if ($adminlists->update()) {
            return redirect('/superadmin/adminlist')->with('success', 'Admin updated successfully.');

        } else {
            return redirect()->back()->with('error', 'Failed to Update.');
        }



    }
    
    public function dltadmin($id)
    {
    $affected = Admin::where('id', $id)
                        ->update(['status' => 'deleted']);

            return redirect()->back()->with('success', 'Data delete successfully.');

    }

 
}
