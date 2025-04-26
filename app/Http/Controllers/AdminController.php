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

        foreach($request->input('answers') as $index => $answer) {
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
        foreach($request->input('answers') as $index => $answer) {
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

    public function codes()
    {
        $groups = Group::all();
        return view('admin.codes.codes', [
            'groups' => $groups
        ]);
    }

    public function destroyGroup(Group $group)
    {
        if($group->questions()->exists()) 
        {
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
        if($question === 'bulk') {   
            $questionIds = request('selected_questions', []);
            Question::whereIn('id', $questionIds)->each(function($question) {
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
        return redirect()->back();
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
            
            if ($course->image) {
                $deleteImage = new DeleteImageAction();
                $deleteImage->execute($course->image);
            }

            DB::commit();
            return redirect()->route('admin.courses')->with('success', 'კურსი წარმატებით წაიშალა');
        }
        catch (\Exception $e)
        {
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
        }
        catch (\Exception $e)
        {
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
        return view('admin.courses.chapters.videos.create', compact('course', 'chapter'));
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
                'library_id' => 382670
            ]);

            Log::info('video created'. $video);

            $response = $client->request('PUT', "https://video.bunnycdn.com/library/382670/videos/$videoId", [
                'headers' => [
                    'AccessKey' => '389ab102-2f80-4aff-9fed5d887804-31ef-4caf',
                    'Content-Type' => 'application/octet-stream',
                ],
                'body' => $videoData
            ]);

            Log::info('video uploaded Status: '. $response->getStatusCode());

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
            // dd($video);

            // echo $response->getStatusCode(); // Should be 200
        } 
        catch (\Exception $e)
        {
            throw $e;
            return redirect()->back()->with('error', 'ვიდეოს ატვირთვა ვერ მოხერხდა: ' . $e->getMessage());
        }
    }

    public function editVideo(Course $course, Chapter $chapter, Video $video)
    {
        return view('admin.courses.chapters.videos.edit', compact('course', 'chapter', 'video'));
    }

    public function updateVideo(Request $request, Course $course, Chapter $chapter, Video $video)
    {
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
