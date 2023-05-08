<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Answers;
use App\Models\Applications;
use App\Models\Comments;
use App\Models\JobPostQuestions;
use App\Models\JobPosts;
use App\Models\Choices;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Storage;


class ApplicateController extends Controller
{


    public function ApplicationsList()
    {
        $savedapplications = Applications::orderBy('id','asc')->with('applicatecategorys', 'comments')->get();

        $breadcrumbs = [
            ['link' => "/", 'name' => "Ana Sayfa"], ['name' => "Başvurular"]
        ];
        return view('/content/Applications/ApplicateList', compact('savedapplications'), [
            'breadcrumbs' => $breadcrumbs
        ]);
    }


    public function ProfilePage($id)
    {
        $job_post_id = Applications::select('job_post_id')->where('id', $id)->pluck('job_post_id')->first();

        $application = Applications::findOrFail($id);
        $job_post_id = $application->job_post_id;

        $questions = JobPostQuestions::where(function($query) use ($id, $job_post_id){
                $query->where('application_id', $id)
                    ->where('job_post_id', $job_post_id)
                    ->orWhere(function($query) use ($job_post_id){
                        $query->whereNull('application_id')
                            ->where('job_post_id', $job_post_id);
                    });
            })->with(['answer' => function($query) use ($id) {
                $query->where('applications_id', $id);
            }])->orderBy('question_order', 'asc')->get();

        $inspectapplicant = Applications::with('comments', 'applicatecategorys')->findOrFail($id);

        $breadcrumbs = [
            ['link' => "/", 'name' => "Ana Sayfa"], ['link' => "/applications/list", 'name' => "Başvurular"], ['name' => "Başvuruyu İncele"]
        ];
        return view('/content/Applications/Profile', compact('inspectapplicant', 'questions'), [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function downloadCV($id)
    {
        $inspectapplicant = Answers::findOrFail($id);
        $cvName = $inspectapplicant->answer;
        $cvPath = storage_path('app/public' . $cvName);

        return response()->download($cvPath);
    }


    public function FormsList()
    {
        $forms = JobPosts::orderBy('id','asc')->withCount('questions', 'applications')->with('applications')->get();
        $date = JobPosts::with('applications')->latest()->get();

        $breadcrumbs = [
            ['link' => "/", 'name' => "Ana Sayfa"], ['name' => "Formlar"]
        ];
        return view('/content/Applications/FormList', compact('forms', 'date' ), [
            'breadcrumbs' => $breadcrumbs
        ]);
    }


    public function CreateForm()
    {

        $breadcrumbs = [
            ['link' => "/", 'name' => "Ana Sayfa"], ['link' => "/applications/form-list", 'name' => "Formlar"], ['name' => "Form Oluştur"]
        ];
        return view('/content/Applications/CreateForm', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }


    public function InspectForm($id)
    {
        $form = JobPosts::where('id',$id)->with('questions', 'applications',)->first();

        $breadcrumbs = [
            ['link' => "/", 'name' => "Ana Sayfa"], ['link' => "/applications/form-list", 'name' => "Formlar"], ['name' => "Formu İncele"]
        ];
        return view('/content/Applications/InspectForm', compact('form'), [
            'breadcrumbs' => $breadcrumbs
        ]);
    }


    public function formquestions ($category_slug)
    {
        $category_id = JobPosts::select('id')->where('slug', $category_slug)->pluck('id')->first();
        $questions = JobPostQuestions::where('job_post_id', $category_id)->where('type', 1)->with('questionChoices')->orderBy('question_order', 'asc')->get();

        $deneme = JobPosts::where('id', $category_id)->get();

        return view('content.form.form', compact('questions', 'deneme'));
    }


    public function SaveForm(Request $request)
    {
        $request->validate([
            'category_name' => 'required|max:190',
            'city' => 'required|array',
             'city.*' => 'in:İstanbul,Ankara,Kayseri,Kocaeli', // sadece bu şehirlerden biri seçilebilir
         ]);

        $city = implode(',', $request->input('city'));

        $savejob = new JobPosts();
        $savejob->category_name = $request->category_name;

        $explanation = $request->explanation ? $request->explanation : 'Açıklama Yok';

        $savejob->explanation = $explanation;
        $savejob->city = $city;

        if ($request->has('slug')) {
            $savejob->slug = Str::slug($request->slug);
        }else{
            $savejob->slug = Str::slug($request->category_name);
        }

        $savejob->save();



        $formQuestionData = json_decode($request->input('formQuestionData'), true);
        foreach ($formQuestionData as $questionData) {

            // JobPostQuestion modeline kaydet
            $jobPostQuestion = new JobPostQuestions;
            $jobPostQuestion->job_post_id = $savejob->id;
            $jobPostQuestion->category = $questionData["category"];
            $jobPostQuestion->question = $questionData["question"];
            $jobPostQuestion->question_order = $questionData["order"];
            $jobPostQuestion->required_status = $questionData["req"];
            $jobPostQuestion->type = 1;
            $jobPostQuestion->save();

            // Choices modeline kaydet
            if($questionData["category"] == 7 && (empty($questionData["options"]) || is_null($questionData["options"]))){ // options alanının var olup olmadığını kontrol eder
                $choice = new Choices;
                $choice->question_id = $jobPostQuestion->id;
                $choice->choice = "Seçenek Yok";
                $choice->save();
            } else if(isset($questionData["options"])){
                foreach ($questionData["options"] as $option) {
                    $choice = new Choices;
                    $choice->question_id = $jobPostQuestion->id;
                    $choice->choice = $option;
                    $choice->save();
                }
            }
        }
        return redirect('/applications/form-list');
    }


    public function saveNewQuestion(Request $request , $id)
    {
        $request->validate([
            'question' => 'required',
        ]);

        $savenewquestion = new JobPostQuestions();
        $savenewquestion->job_post_id = $id;
        $savenewquestion->type = 1;
        $savenewquestion->category = $request->category;


        if ($request->category==1) {
            $savenewquestion->question = $request->question;
            $savenewquestion->question_order = $request->order;
            $savenewquestion->required_status = 1;

            $savenewquestion->save();
        }
        if ($request->category==2) {
            $savenewquestion->question = $request->question;
            $savenewquestion->question_order = $request->order;
            $savenewquestion->required_status = 1;

            $savenewquestion->save();
        }
        if ($request->category==3) {
            $savenewquestion->question = $request->question;
            $savenewquestion->question_order = $request->order;
            $savenewquestion->required_status = 1;

            $savenewquestion->save();
        }
        if ($request->category==4) {
            $savenewquestion->question = $request->question;
            $savenewquestion->question_order = $request->order;
            $savenewquestion->required_status = 1;

            $savenewquestion->save();
        }
        if ($request->category==5) {
            $savenewquestion->question = $request->question;
            $savenewquestion->question_order = $request->order;
            $savenewquestion->required_status = 1;

            $savenewquestion->save();
        }
        if ($request->category==6) {
            $savenewquestion->question = $request->question;
            $savenewquestion->question_order = 5;
            $savenewquestion->required_status = 1;

            $savenewquestion->save();
        }
        if ($request->category==7) {
            $savenewquestion->question = $request->question;
            $savenewquestion->question_order = $request->order;
            $savenewquestion->required_status = 1;

            $savenewquestion->save();

            foreach ($request->input('choices') as $choice_text) {
                $choice = new Choices;
                $choice->question_id = $savenewquestion->id;
                $choice->choice = $choice_text;
                $choice->save();
            }
        }


        return back();
    }


    public function UpdateQuestion(Request $request , $id )
    {
        $request->validate([
            'question' => 'required',
        ]);

        $updatequestion = JobPostQuestions::find($id);
        $updatequestion->question = $request->question;

        $updatequestion->save();
        return back();
    }


    public function DestroyQuestion($id)
    {
        $destroyquestion = JobPostQuestions::find($id);
        $destroyquestion->delete();

        return back();
    }


    public function DestroyApplicant($id)
    {
        $destroyquestion = Applications::find($id);
        $destroyquestion->delete();

        return redirect('/applications/list');
    }


    public function DestroyForm($id)
    {
        $destroyform = JobPosts::find($id);
        $destroyform->delete();

        return redirect('/applications/form-list');
    }

    public function applicationsave(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:25',
            'city' => 'required|max:255',
        ], [
            'name.required' => 'İsim alanı zorunludur.',
            'name.max' => 'İsim en fazla :max karakter olabilir.',
            'city.required' => 'Şehir alanı zorunludur.',
            'city.max' => 'Şehir en fazla :max karakter olabilir.',
        ]);


        $applicatesave = new Applications();
        $applicatesave->name = $request->name;
        $applicatesave->city = $request->city;
        $applicatesave->job_post_id = $id;

        $applicatesave->save();

        $saveid = $applicatesave->id;

        if (!empty($request->question)) {
            foreach($request->question as $question=>$answer) {
                $question = JobPostQuestions::firstOrCreate(
                    ['question' =>  $question],
                    [
                        'job_post_id' => $id,
                        'application_id' => $saveid,
                        'type' => 2,
                        'category' => 0,
                        'question_order' => 100,
                        'required_status' => 2,
                    ]
                );

                if ($answer === '' || is_null($answer)) {
                    $answer = 'Bu soruya cevap verilmemiştir';
                }

                Answers::create([
                    'question_id' => $question->id,
                    'answer' => $answer,
                    'applications_id' => $saveid
                ]);
            }
        }

        if (!empty($request->filequestion)) {
            foreach($request->filequestion as $filequestion => $file) {
                if(empty($file) || is_null($file)) {
                    $path = 'Bu soruya cevap verilmemiştir';

                    Answers::create([
                        'question_id' => $filequestion,
                        'answer' => $path,
                        'applications_id' => $saveid
                    ]);
                }else {
                    $filename = date('Y-m-d_H-m-i') . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('/form-files', $filename);

                    Answers::create([
                        'question_id' => $filequestion,
                        'answer' => '/' . $path,
                        'applications_id' => $saveid
                    ]);
                }
            }
        }

        return redirect('/application-success');
    }

    public function Success()
    {
        return view('/content/form/success');
    }


    public function newComment(Request $request , $id)
    {
        $request->validate([
            'comment' => 'required',
            'comment_category' => 'required',
        ]);

        $newComment = new Comments();
        $newComment->author = $request->author;
        $newComment->comment = $request->comment;
        $newComment->comment_category = $request->comment_category;
        $newComment->application_id = $id;

        $newComment->save();

        return back();
    }


    public function newStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'status_exp' => 'required',
        ]);

        $newStatus = new Comments();
        $newStatus->author = $request->author;
        $newStatus->status = $request->status;
        $newStatus->status_exp = $request->status_exp;
        $newStatus->application_id = $id;

        $newStatus->save();

        return back();
    }

    public function UpdateForm(Request $request , $id )
    {
        $city = implode(',', $request->input('city'));


        $updateform = JobPosts::find($id);
        $updateform->category_name = $request->category_name;
        $updateform->explanation = $request->explanation;
        $updateform->city = $city;

        $updateform->save();
        return back();
    }
}
