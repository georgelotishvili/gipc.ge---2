<?php

namespace App\Http\Controllers;

use App\Actions\Abecert\DeleteImageAction;
use App\Actions\Abecert\SaveImageAction;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Test;
use App\Models\User;
use App\Models\Group;
use App\Models\Pricing;
use App\Models\Plan;
use App\Models\PlanType;
use App\Models\PlanOption;
use App\Models\Regulation;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::count();
        $tests = Test::count();
        $questions = Question::count();
        $average_score = Test::avg('score');

        return view('admin.index', [
            'users' => $users,
            'tests' => $tests,
            'questions' => $questions,
            'average_score' => $average_score,
        ]);
    }


    public function plans()
    {
        $planTypes = PlanType::all();
        $plans = Plan::all();
        $planOptions = PlanOption::with('plans')->get();

        return view('admin.plans.index', [
            'planTypes' => $planTypes,
            'plans' => $plans,
            'planOptions' => $planOptions
        ]);
    }

    public function createPlan()
    {
        $planTypes = PlanType::all();

        return view('admin.plans.create', [
            'planTypes' => $planTypes
        ]);
    }

    public function storePlan(Request $request)
    {
        $attributes = $request->validate([
            'plan_name' => 'required|unique:plans,plan_name',
            'plan_description' => 'required',
            'plan_price' => 'required|numeric',
            'plan_discount' => 'numeric|nullable',
            'plan_recommended' => 'required|boolean',
            'plan_order' => 'required|numeric',
            'plan_type_id' => 'required|exists:plan_types,id|unique:plans,plan_type_id',
            'is_active' => 'required|boolean',
        ]);


        Plan::create($attributes);

        return redirect()->route('admin.plans')->with('success-plan', 'სახეობა წარმატებით დამატებულია');
    }

    public function editPlan(Plan $plan)
    {
        $planTypes = PlanType::all();

        return view('admin.plans.edit', [
            'plan' => $plan,
            'planTypes' => $planTypes
        ]);
    }

    public function updatePlan(Request $request, Plan $plan)
    {
        $attributes = $request->validate([
            'plan_name' => 'required|unique:plans,plan_name,' . $plan->id,
            'plan_description' => 'required',
            'plan_price' => 'required|numeric',
            'plan_discount' => 'numeric|nullable',
            'plan_recommended' => 'required|boolean',
            'plan_order' => 'required|numeric',
            'plan_type_id' => 'required|exists:plan_types,id|unique:plans,plan_type_id,' . $plan->id,
            'is_active' => 'required|boolean',
        ]);

        $plan->update($attributes);

        return redirect()->route('admin.plans')->with('success-plan', 'სახეობა წარმატებით განახლდა');
    }


    public function destroyPlan(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('admin.plans')->with('success-plan', 'სახეობა წარმატებით წაიშალა');
    }


    public function createPlanType()
    {
        return view('admin.planTypes.create');
    }

    public function storePlanType(Request $request)
    {
        $attributes = $request->validate([
            'type_name' => 'required|unique:plan_types,type_name',
            'type_duration' => 'required|integer|min:1',
            'is_free' => 'required|boolean',
        ]);

        PlanType::create($attributes);

        return redirect()->route('admin.plans')->with('success-plan-type', 'სახეობა წარმატებით დამატებულია');
    }

    public function editPlanType(PlanType $planType)
    {
        return view('admin.planTypes.edit', [
            'planType' => $planType
        ]);
    }

    public function updatePlanType(Request $request, PlanType $planType)
    {
        $attributes = $request->validate([
            'type_name' => 'required|unique:plan_types,type_name,' . $planType->id,
            'type_duration' => 'required|integer|min:1',
            'is_free' => 'required|boolean',
        ]);

        $planType->update($attributes);

        return redirect()->route('admin.plans')->with('success-plan-type', 'სახეობა წარმატებით განახლდა');
    }


    public function destroyPlanType(PlanType $planType)
    {
        $planType->delete();
        return redirect()->route('admin.plans')->with('success-plan-type', 'სახეობა წარმატებით წაიშალა');
    }

    public function createPlanOption()
    {
        $plans = Plan::all();

        return view('admin.planOptions.create', [
            'plans' => $plans
        ]);
    }

    public function storePlanOption(Request $request)
    {
        $attributes = $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'option_description' => 'required',
            'is_included' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        PlanOption::create($attributes);

        return redirect()->route('admin.plans')->with('success-plan-option', 'პარამეტრი წარმატებით დამატებულია');
    }

    public function editPlanOption(PlanOption $planOption)
    {
        $plans = Plan::all();

        return view('admin.planOptions.edit', [
            'planOption' => $planOption,
            'plans' => $plans
        ]);
    }

    public function updatePlanOption(Request $request, PlanOption $planOption)
    {
        $attributes = $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'option_description' => 'required',
            'is_included' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        $planOption->update($attributes);

        return redirect()->route('admin.plans')->with('success-plan-option', 'პარამეტრი წარმატებით განახლდა');
    }


    public function destroyPlanOption(PlanOption $planOption)
    {
        $planOption->delete();
        return redirect()->route('admin.plans')->with('success-plan-option', 'პარამეტრი წარმატებით წაიშალა');
    }


    public function questions()
    {
        $questions = Question::with(['answers'])->orderBy('id')->filterByGroup(request('g'))->paginate(30)->withQueryString();
        $groups = Group::all();

        return view('admin.questions.questions', [
            'questions' => $questions,
            'groups' => $groups

        ]);
    }

    public function create()
    {
        $groups = Group::all();

        return view('admin.questions.create', [
            'groups' => $groups
        ]);
    }

    public function store(Request $request)
    {
        $question = Question::create([
            'text' => $request->input('text'),
        ]);

        foreach ($request->input('answers') as $index => $answer) {
            Answer::create([
                'text' => $answer['text'],
                'is_true' => $request->input('is_true') == $index,
                'question_id' => $question->id,
            ]);
        }

        $question->groups()->attach($request->input('group'));

        return redirect()->route('admin.questions');
    }

    public function edit(Question $question)
    {
        $groups = Group::all();
        return view('admin.questions.edit', [
            'question' => $question,
            'groups' => $groups
        ]);
    }

    public function update(Request $request, Question $question)
    {
        $question->update([
            'text' => $request->input('text')
        ]);

        // Delete existing answers
        $question->answers()->delete();

        // Create new answers
        foreach ($request->input('answers') as $index => $answer) {
            Answer::create([
                'text' => $answer['text'],
                'is_true' => $request->input('correct_answer') == $index,
                'question_id' => $question->id,
            ]);

        }

        $question->groups()->detach();
        $question->groups()->attach($request->input('group'));

        return redirect()->route('admin.questions');
    }

    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users', [
            'users' => $users
        ]);
    }

    public function deleteUser($userId)
    {
        try {
            DB::beginTransaction();
            
            $user = User::findOrFail($userId);
            
            // Delete related data first
            $user->examRequests()->delete();
            $user->tokens()->delete();
            $user->employers()->delete();
            $user->payments()->delete();
            $user->employees()->delete();
            $user->certificates()->delete();
            $user->comments()->delete();
            $user->ratings()->delete();
            
            // Delete profile image if exists
            if ($user->image()->exists()) {
                $user->image()->delete();
            }
            
            // Delete subscription if exists
            if ($user->subscription()->exists()) {
                $user->subscription()->delete();
            }
            
            // Force delete the user
            $user->forceDelete();
            
            DB::commit();
            
            return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.users')->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }

    public function editSubscription($userId)
    {
        $user = User::findOrFail($userId);
        $plans = Plan::with('planType')->get();
        
        return view('admin.subscription-edit', [
            'user' => $user,
            'plans' => $plans
        ]);
    }

    public function updateSubscription(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        
        $request->validate([
            'is_active' => 'required|boolean',
            'plan_id' => 'required|exists:plans,id',
            'starts_at' => 'required|date',
            'ends_at' => 'nullable|date|after:starts_at',
        ], [
            'plan_id.required' => 'გამოწერის ტიპი აუცილებელია',
            'plan_id.exists' => 'არჩეული გამოწერის ტიპი არ არსებობს',
            'starts_at.required' => 'დაწყების თარიღი აუცილებელია',
            'starts_at.date' => 'დაწყების თარიღი არასწორი ფორმატია',
            'ends_at.date' => 'დასრულების თარიღი არასწორი ფორმატია',
            'ends_at.after' => 'დასრულების თარიღი უნდა იყოს დაწყების თარიღის შემდეგ',
        ]);

        $plan = Plan::findOrFail($request->plan_id);
        
        $data = [
            'plan_type_id' => $plan->plan_type_id,
            'plan_id' => $plan->id,
            'is_active' => (bool) $request->is_active,
            'starts_at' => \Carbon\Carbon::parse($request->starts_at)->startOfDay(),
            'ends_at' => $request->ends_at ? \Carbon\Carbon::parse($request->ends_at)->endOfDay() : \Carbon\Carbon::now()->addDays($plan->planType->type_duration),
            'recToken' => md5(time() . $user->id),
        ];

        $user->createOrUpdateSubscription($data);

        return redirect()->route('admin.users')->with('success', 'Subscription updated successfully!');
    }

    public function codes()
    {
        $groups = Group::all();
        return view('admin.codes.codes', [
            'groups' => $groups
        ]);
    }

    public function destroyGroup(Group $group)
    {
        if ($group->questions()->exists()) {
            return redirect()->back()->with('error', 'კანონმდებლობაში არსებობს კითხვები, გთხოვთ წაშალოთ კანონმდებლობის კითხვები მისი წაშლის წინ.');
        }
        $group->delete();
        return redirect()->back()->with('success', 'დადგენილება წარმატებით წაიშალა');
    }

    public function editGroup(Group $group)
    {
        return view('admin.codes.edit', [
            'group' => $group
        ]);
    }

    public function updateGroup(Request $request, Group $group)
    {
        $group->update([
            'name' => $request->input('name'),
            'title' => $request->input('title'),
            'question_count_in_exam' => $request->input('question_count_in_exam')
        ]);
        return redirect()->route('admin.codes')->with('success', 'დადგენილება წარმატებით განახლდა');
    }

    public function createGroup()
    {
        return view('admin.codes.create');
    }

    public function storeGroup(Request $request)
    {
        Group::create([
            'name' => $request->input('name'),
            'title' => $request->input('title'),
            'question_count_in_exam' => $request->input('question_count_in_exam')
        ]);
        return redirect()->route('admin.codes')->with('success', 'დადგენილება წარმატებით დამატებულია');
    }

    public function regulations()
    {
        $regulations = Regulation::all();
        return view('admin.regulations.regulations', [
            'regulations' => $regulations
        ]);
    }

    public function createRegulation()
    {
        return view('admin.regulations.create');
    }

    public function storeRegulation(Request $request)
    {
        Regulation::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'link' => $request->input('link'),
            'date_applied' => $request->input('date_applied')
        ]);
        return redirect()->route('admin.regulations.regulations')->with('success', 'დადგენილება წარმატებით დამატებულია');
    }

    public function editRegulation(Regulation $regulation)
    {
        return view('admin.regulations.edit', [
            'regulation' => $regulation
        ]);
    }

    public function updateRegulation(Request $request, Regulation $regulation)
    {
        $regulation->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'link' => $request->input('link'),
            'date_applied' => $request->input('date_applied')
        ]);
        return redirect()->route('admin.regulations.regulations')->with('success', 'დადგენილება წარმატებით განახლდა');
    }

    public function destroyRegulation(Regulation $regulation)
    {
        $regulation->delete();
        return redirect()->back()->with('success', 'დადგენილება წარმატებით წაიშალა');
    }

    public function destroy($question)
    {
        if ($question === 'bulk') {
            $questionIds = request('selected_questions', []);
            Question::whereIn('id', $questionIds)->each(function ($question) {
                $question->answers()->delete();
                $question->delete();
            });
        } else {
            $question = Question::findOrFail($question);
            $question->answers()->delete();
            $question->delete();
        }

        return redirect()->back();
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function courses()
    {
        $courses = Course::all();
        return view('admin.courses', compact('courses'));
    }

    public function createCourse()
    {
        return view('admin.courses.create');
    }

    public function storeCourse(Request $request)
    {
        DB::beginTransaction();
        try {
            $course = Course::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);

            if ($request->hasFile('image')) {
                $image = SaveImageAction::execute($request->file('image'));

                $course->image()->save($image);
            }
            DB::commit();
            return redirect()->route('admin.courses')->with('success', 'კურსი წარმატებით დამატებულია');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'დაფიქსირდა შეცდომა');
        }
    }

    public function editCourse(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function updateCourse(Request $request, Course $course)
    {
        DB::beginTransaction();
        try {
            $course->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($course->image()->exists()) {
                    Storage::disk('public')->delete($course->image()->first()->path);
                    $course->image()->delete();
                }

                // Save new image
                $image = SaveImageAction::execute($request->file('image'));
                $course->image()->save($image);
                $course->save();
            }

            DB::commit();
            return redirect()->route('admin.courses')->with('success', 'კურსი წარმატებით განახლდა');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->back()->with('error', 'დაფიქსირდა შეცდომა');
        }
    }

    public function destroyCourse(Course $course)
    {
        DB::beginTransaction();
        try {
            $course->delete();

            if ($course->image()->exists()) {
                $image = $course->image()->first();
                if ($image) {
                    $deleteImage = new DeleteImageAction();
                    $deleteImage->execute($image);
                }
            }

            DB::commit();
            return redirect()->route('admin.courses')->with('success', 'კურსი წარმატებით წაიშალა');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'დაფიქსირდა შეცდომა');
        }
    }

    public function chapters(Course $course)
    {
        return view('admin.courses.chapters', compact('course'));
    }

    public function createChapter(Course $course)
    {
        return view('admin.courses.chapters.create', compact('course'));
    }

    public function storeChapter(Request $request, Course $course)
    {
        DB::beginTransaction();
        try {
            $chapter = Chapter::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'course_id' => $course->id
            ]);

            if ($request->hasFile('image')) {
                $saveImage = new SaveImageAction();
                $image = $saveImage->execute($request->file('image'));

                $chapter->image()->save($image);
            }
            DB::commit();
            return redirect()->route('admin.courses.chapters', $course)->with('success', 'თავი წარმატებით დამატებულია');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'დაფიქსირდა შეცდომა');
        }
    }

    public function editChapter(Course $course, Chapter $chapter)
    {
        return view('admin.courses.chapters.edit', compact('course', 'chapter'));
    }

    public function updateChapter(Request $request, Course $course, Chapter $chapter)
    {
        DB::beginTransaction();
        try {
            $chapter->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($chapter->image()->exists()) {
                    Storage::disk('public')->delete($chapter->image()->first()->path);
                    $chapter->image()->delete();
                }

                // Save new image
                $image = SaveImageAction::execute($request->file('image'));
                $chapter->image()->save($image);
                $chapter->save();
            }

            DB::commit();
            return redirect()->route('admin.courses.chapters', $course)->with('success', 'თავი წარმატებით განახლდა');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'დაფიქსირდა შეცდომა');
        }
    }

    public function destroyChapter(Course $course, Chapter $chapter)
    {
        $chapter->videos()->delete();
        $chapter->delete();
        return redirect()->back();
    }

    public function createVideo(Request $request, Course $course, Chapter $chapter)
    {
        $highestWeight = $chapter->videos()->max('weight') ?? 0;
        $nextWeight = $highestWeight + 1;
        
        return view('admin.courses.chapters.videos.create', compact('course', 'chapter', 'nextWeight'));
    }

    public function storeVideo(Request $request, Course $course, Chapter $chapter)
    {
        Log::info($request->all());
        try {
            Log::info('inside try');
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://video.bunnycdn.com/library/382670/videos', [
                'headers' => [
                    'AccessKey' => '389ab102-2f80-4aff-9fed5d887804-31ef-4caf',
                    'accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'title' => $request->input('name')
                ]
            ]);

            $body = json_decode($response->getBody(), true);
            $videoId = $body['guid']; // This is your video ID

            $videoPath = $request->file('video')->getRealPath();
            $videoData = fopen($videoPath, 'r'); // open file for reading

            $video = $chapter->videos()->create([
                'name' => $request->input('name'),
                'course_id' => $course->id,
                'video_id' => $videoId,
                'video_url' => "https://video.bunnycdn.com/library/382670/videos/$videoId",
                'library_id' => 382670,
                'weight' => $request->input('weight'),
                'description' => $request->input('description')
            ]);

            Log::info('video created' . $video);

            $response = $client->request('PUT', "https://video.bunnycdn.com/library/382670/videos/$videoId", [
                'headers' => [
                    'AccessKey' => '389ab102-2f80-4aff-9fed5d887804-31ef-4caf',
                    'Content-Type' => 'application/octet-stream',
                ],
                'body' => $videoData
            ]);

            Log::info('video uploaded Status: ' . $response->getStatusCode());

            if ($request->hasFile('thumbnail')) {
                try {
                    $image = SaveImageAction::execute($request->file('thumbnail'));
                    $video->image()->save($image);
                } catch (\Exception $e) {
                    Log::error('Error saving thumbnail: ' . $e->getMessage());
                }
            }

            $response = $client->request('GET', 'https://video.bunnycdn.com/library/382670/videos/9d566441-ae03-4b17-ac16-30fd0a2fcdaf', [
                'headers' => [
                    'AccessKey' => '389ab102-2f80-4aff-9fed5d887804-31ef-4caf',
                    'accept' => 'application/json',
                ],
            ]);

            // Convert the response body to a JSON object
            $responseData = json_decode($response->getBody(), true);

            $video->duration = $responseData['length'];
            $video->save();

            return redirect()->route('admin.courses.chapters.videos', [$course, $chapter])->with('success', 'ვიდეო წარმატებით დაემატა');
        } catch (\Exception $e) {
            Log::error('Error uploading video: ' . $e->getMessage());
            return redirect()->back()->with('error', 'ვიდეოს ატვირთვა ვერ მოხერხდა: ' . $e->getMessage());
        }
    }

    public function editVideo(Course $course, Chapter $chapter, Video $video)
    {
        return view('admin.courses.chapters.videos.edit', compact('course', 'chapter', 'video'));
    }

    public function updateVideo(Request $request, Course $course, Chapter $chapter, Video $video)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $video->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->back()->with('success', 'ვიდეო წარმატებით განახლდა');
        return redirect()->back();
    }

    public function showVideo(Course $course, Chapter $chapter, Video $video)
    {
        return view('admin.courses.chapters.videos.show', compact('course', 'chapter', 'video'));
    }

    public function destroyVideo(Course $course, Chapter $chapter, Video $video)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('DELETE', $video->video_url, [
                'headers' => [
                    'accept' => 'application/json',
                    'AccessKey' => '389ab102-2f80-4aff-9fed5d887804-31ef-4caf',
                ],
            ]);
            Log::info('video deleted Status: ' . $response->getStatusCode());
        } catch (\Exception $e) {
            Log::error('video deletion error: ' . $e->getMessage());
        }

        $video->delete();
        return redirect()->back();
    }

    public function videos(Course $course, Chapter $chapter)
    {
        return view('admin.courses.chapters.videos', compact('course', 'chapter'));
    }

}
