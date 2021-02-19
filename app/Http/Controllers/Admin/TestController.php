<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateTestFormRequest;
use App\Http\Requests\StoreUpdateQuestionFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Question;
use App\Models\QuestionChoice;

class TestController extends Controller
{
    private $model;

    public function __construct(Test $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = $this->model->orderBy('id', 'DESC')->paginate(10);

        return view('admin.tests.index', compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTestFormRequest $request)
    {
        $data = $request->all();
        
        $this->model->create($data);

        return redirect()->route('tests.index')
            ->withSuccess('Teste cadastrada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = $this->model->findOrFail($id);

        if (!$test) {
            return redirect()->back()
                ->withWarning('Teste não encontrada na base de dados');
        }

        return view('admin.tests.show', compact('test'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $test = $this->model->findOrFail($id);

        if (!$test) {
            return redirect()->back()
                ->withWarning('Teste não encontrada na base de dados');
        }

        return view('admin.tests.edit', compact('test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTestFormRequest $request, $id)
    {
        $test = $this->model->findOrFail($id);

        if (!$test) {
            return redirect()->back()
                ->withWarning('Teste não encontrada na base de dados');
        }

        $data = $request->all();

        $test->update($data);

        return redirect()->route('tests.index')
            ->withSuccess('Teste atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test = $this->model->findOrFail($id);

        if (!$test) {
            return redirect()->back()
                ->withWarning('Teste não encontrada na base de dados');
        }

        $test->delete();

        return redirect()->route('tests.index')
            ->withSuccess('Teste deletada com sucesso');
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $tests = $this->model
            ->where(function ($query) use ($filters) {
                if (isset($filters['title'])) {
                    $query->where(
                        'title', 'LIKE', "%{$filters['title']}%"
                    );
                }
            })
            ->orderBy('id', 'DESC')
            ->paginate();

        return view('admin.tests.index', compact('tests', 'filters'));
    }

    public function createQuestion($test_id)
    {
        $test = $this->model->findOrFail($test_id);

        if (!$test) {
            return redirect()->back()
                ->withWarning('Teste não encontrada na base de dados');
        }

        return view('admin.tests.question.create', compact('test'));
    }

    public function storeQuestion(StoreUpdateQuestionFormRequest $request, Question $questionModel, QuestionChoice $questionChoiceModel, $test_id)
    {
        $test = $this->model->findOrFail($test_id);

        if (!$test) {
            return redirect()->back()
                ->withWarning('Teste não encontrada na base de dados');
        }

        $questionData = $request->only(['title','enunciated','order']);
        $questionData['test_id'] = $test->id;

        $choiceTitle = $request->choiceTitle ?? [];
        $choiceOrder = $request->choiceOrder ?? [];
        $choiceCorrect = $request->choiceCorrect ?? [];

        $checkCorrect = false;
        foreach (array_count_values($choiceCorrect) as $key => $value) {
            if ($key == 1 && $value > 1) {
                $checkCorrect = true;
                break;
            }
        }

        if ($checkCorrect) {
            return redirect()->back()
                ->withWarning('Informe somente uma resposta como correta.');
        }

        $question = $questionModel->create($questionData);

        foreach($choiceTitle as $key => $item) {
            $questionChoiceModel->create([
                'question_id' => $question->id,
                'title' => $item,
                'correct' => $choiceCorrect[$key] == "1" ? true : false,
                'order' => $choiceOrder[$key]
            ]);
        }

        return redirect()->route('tests.show', $test->id)
            ->withSuccess('Questão adicionada com sucesso');
    }

    public function editQuestion($test_id, $id)
    {
        $test = $this->model->findOrFail($test_id);

        if (!$test) {
            return redirect()->back()
                ->withWarning('Teste não encontrada na base de dados');
        }

        $question = Question::where('test_id', $test->id)->where('id', $id)->first();

        if (!$question) {
            return redirect()->back()
                ->withWarning('Questão não encontrada na base de dados');
        }

        return view('admin.tests.question.edit', compact('test','question'));
    }

    public function updateQuestion(StoreUpdateQuestionFormRequest $request, Question $question, QuestionChoice $questionChoiceModel, $test_id, $id)
    {
        $test = $this->model->findOrFail($test_id);

        if (!$test) {
            return redirect()->back()
                ->withWarning('Teste não encontrada na base de dados');
        }

        $question = Question::where('test_id', $test->id)->where('id', $id)->first();

        if (!$question) {
            return redirect()->back()
                ->withWarning('Questão não encontrada na base de dados');
        }

        $questionData = $request->only(['title','enunciated','order']);
        $questionData['test_id'] = $test->id;

        $choiceTitle = $request->choiceTitle ?? [];
        $choiceOrder = $request->choiceOrder ?? [];
        $choiceCorrect = $request->choiceCorrect ?? [];

        $checkCorrect = false;
        foreach (array_count_values($choiceCorrect) as $key => $value) {
            if ($key == 1 && $value > 1) {
                $checkCorrect = true;
                break;
            }
        }

        if ($checkCorrect) {
            return redirect()->back()
                ->withWarning('Informe somente uma resposta como correta.');
        }

        $question->update($questionData);

        if (count($choiceTitle) > 0) {
            $question->choices()->delete();
            foreach($choiceTitle as $key => $item) {
                $questionChoiceModel->create([
                    'question_id' => $question->id,
                    'title' => $item,
                    'correct' => $choiceCorrect[$key] == "1" ? true : false,
                    'order' => $choiceOrder[$key]
                ]);
            }
        }

        return redirect()->route('tests.show', $test->id)
            ->withSuccess('Questão atualizada com sucesso');
    }

    public function destroyQuestion(Question $question, $test_id, $id)
    {
        $test = $this->model->findOrFail($test_id);

        if (!$test) {
            return response()->json([
                'data' => [
                    'status' => 'error',
                    'message' => 'Teste não encontrada na base de dados'
                ]
            ]);            
        }

        $question = Question::where('test_id', $test->id)->where('id', $id)->first();

        if (!$question) {
            return response()->json([
                'data' => [
                    'status' => 'error',
                    'message' => 'Questão não encontrada na base de dados'
                ]
            ]);
        }

        $question->choices()->delete();
        $question->delete();

        return response()->json([
            'data' => [
                'status' => 'success',
                'message' => 'Questão deletada com sucesso'
            ]
        ]);
    }
}
