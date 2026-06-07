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
use App\Models\Subscription;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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
            'plan_name' => ['required', Rule::unique('plans', 'plan_name')->whereNull('deleted_at')],
            'plan_description' => ['required'],
            'plan_price' => ['required', 'numeric', 'min:1'],
            'plan_discount' => ['nullable', 'numeric', 'min:0'],
            'plan_recommended' => ['required', 'boolean'],
            'plan_order' => ['required', 'integer', 'min:1'],
            'plan_type_id' => ['required', 'exists:plan_types,id', Rule::unique('plans', 'plan_type_id')->whereNull('deleted_at')],
            'is_active' => ['required', 'boolean'],
        ]);

        DB::transaction(function () use ($attributes) {
            if ((bool) $attributes['plan_recommended']) {
                Plan::where('plan_recommended', true)->update(['plan_recommended' => false]);
            }

            Plan::create($attributes);
        });

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
            'plan_name' => ['required', Rule::unique('plans', 'plan_name')->ignore($plan->id)->whereNull('deleted_at')],
            'plan_description' => ['required'],
            'plan_price' => ['required', 'numeric', 'min:1'],
            'plan_discount' => ['nullable', 'numeric', 'min:0'],
            'plan_recommended' => ['required', 'boolean'],
            'plan_order' => ['required', 'integer', 'min:1'],
            'plan_type_id' => ['required', 'exists:plan_types,id', Rule::unique('plans', 'plan_type_id')->ignore($plan->id)->whereNull('deleted_at')],
            'is_active' => ['required', 'boolean'],
        ]);

        DB::transaction(function () use ($attributes, $plan) {
            if ((bool) $attributes['plan_recommended']) {
                Plan::where('id', '!=', $plan->id)
                    ->where('plan_recommended', true)
                    ->update(['plan_recommended' => false]);
            }

            $plan->update($attributes);
        });

        return redirect()->route('admin.plans')->with('success-plan', 'სახეობა წარმატებით განახლდა');
    }


    public function destroyPlan(Plan $plan)
    {
        if (Subscription::withTrashed()->where('plan_id', $plan->id)->exists()) {
            return redirect()
                ->route('admin.plans')
                ->with('error-plan', 'ეს ფასი უკვე გამოყენებულია გამოწერის ისტორიაში. წაშლის ნაცვლად გაათიშეთ აქტიურობა.');
        }

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
        if (
            Plan::withTrashed()->where('plan_type_id', $planType->id)->exists()
            || Subscription::withTrashed()->where('plan_type_id', $planType->id)->exists()
        ) {
            return redirect()
                ->route('admin.plans')
                ->with('error-plan-type', 'ეს ტიპი დაკავშირებულია ფასებთან ან გამოწერის ისტორიასთან. ჯერ გამოიყენეთ ფასის გათიშვა.');
        }

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
        $users = User::with([
            'subscription.planType',
            'subscription.plan.planType',
            'subscriptions.planType',
            'subscriptions.plan.planType',
            'subscriptions.payments',
            'payments.subscription.planType',
            'payments.subscription.plan.planType',
        ])->latest()->paginate(15);

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
            $user->employers()->get()->each->delete();
            $user->payments()->delete();
            $user->employees()->get()->each->delete();
            
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
        $user = User::with([
            'subscriptions.planType',
            'subscriptions.plan.planType',
            'subscriptions.payments',
            'payments',
        ])->findOrFail($userId);
        $plans = Plan::with('planType')->get();
        $currentSubscription = $user->currentSubscriptionRecord();
        
        return view('admin.subscription-edit', [
            'user' => $user,
            'plans' => $plans,
            'currentSubscription' => $currentSubscription,
        ]);
    }

    public function updateSubscription(Request $request, $userId)
    {
        $user = User::with('subscriptions')->findOrFail($userId);
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)->whereNull('deleted_at'),
            ],
            'subscription_action' => ['required', Rule::in(['none', 'grant', 'stop'])],
            'plan_id' => ['nullable', 'required_if:subscription_action,grant', 'exists:plans,id'],
            'starts_at' => ['nullable', 'required_if:subscription_action,grant', 'date'],
            'ends_at' => 'nullable|date|after:starts_at',
        ], [
            'name.required' => 'სახელი და გვარი აუცილებელია',
            'email.required' => 'ელ-ფოსტა აუცილებელია',
            'email.email' => 'ელ-ფოსტის ფორმატი არასწორია',
            'email.unique' => 'ეს ელ-ფოსტა უკვე გამოყენებულია',
            'plan_id.required' => 'გამოწერის ტიპი აუცილებელია',
            'plan_id.exists' => 'არჩეული გამოწერის ტიპი არ არსებობს',
            'starts_at.required' => 'დაწყების თარიღი აუცილებელია',
            'starts_at.date' => 'დაწყების თარიღი არასწორი ფორმატია',
            'ends_at.date' => 'დასრულების თარიღი არასწორი ფორმატია',
            'ends_at.after' => 'დასრულების თარიღი უნდა იყოს დაწყების თარიღის შემდეგ',
        ]);

        DB::transaction(function () use ($request, $user) {
            $user->update([
                'name' => $request->name,
                'email' => Str::lower($request->email),
            ]);

            if ($request->subscription_action === 'stop') {
                $stopTime = now();

                $user->subscriptions()
                    ->where('is_active', true)
                    ->get()
                    ->each(function ($subscription) use ($stopTime) {
                        $subscription->is_active = false;

                        if (! $subscription->ends_at || $subscription->ends_at->greaterThan($stopTime)) {
                            $subscription->ends_at = $stopTime;
                        }

                        $subscription->save();
                    });

                return;
            }

            if ($request->subscription_action === 'grant') {
                $plan = Plan::with('planType')->findOrFail($request->plan_id);
                $startsAt = \Carbon\Carbon::parse($request->starts_at)->startOfDay();
                $endsAt = $request->ends_at
                    ? \Carbon\Carbon::parse($request->ends_at)->endOfDay()
                    : $startsAt->copy()->addDays($plan->planType->type_duration)->endOfDay();

                $user->subscriptions()
                    ->where('is_active', true)
                    ->get()
                    ->each(function ($subscription) use ($startsAt) {
                        $subscription->is_active = false;

                        if (! $subscription->ends_at || $subscription->ends_at->greaterThan($startsAt)) {
                            $subscription->ends_at = $startsAt->copy()->subSecond();
                        }

                        $subscription->save();
                    });

                $user->subscriptions()->create([
                    'plan_type_id' => $plan->plan_type_id,
                    'plan_id' => $plan->id,
                    'is_active' => true,
                    'recToken' => 'admin-' . $user->id . '-' . Str::uuid(),
                    'starts_at' => $startsAt,
                    'ends_at' => $endsAt,
                ]);
            }
        });

        return redirect()->route('admin.subscription.edit', $user->id)->with('success', 'მომხმარებლის მონაცემები განახლდა');
    }

    public function destroyUserSubscription($userId, Subscription $subscription)
    {
        $user = User::findOrFail($userId);

        abort_unless((int) $subscription->user_id === (int) $user->id, 404);

        DB::transaction(function () use ($subscription) {
            $subscription->payments()
                ->withTrashed()
                ->get()
                ->each(fn ($payment) => $payment->forceDelete());

            $subscription->forceDelete();
        });

        return redirect()
            ->route('admin.subscription.edit', $user->id)
            ->with('success', 'გამოწერის ისტორიის ჩანაწერი წაიშალა');
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
        $regulations = Regulation::query()
            ->orderBy('name')
            ->get();

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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'link' => ['required', 'url', 'max:2000'],
        ]);

        Regulation::create($validated + [
            'description' => null,
            'date_applied' => null,
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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'link' => ['required', 'url', 'max:2000'],
        ]);

        $regulation->update($validated + [
            'description' => null,
            'date_applied' => null,
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
                'description' => $request->input('description'),
                'free' => (bool) $request->boolean('free')
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
            'free' => (bool) $request->boolean('free')
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
