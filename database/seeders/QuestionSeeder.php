<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Helper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedQuestions('255', '255');
        $this->seedQuestions('256', '256');
        // $this->seedQuestions('261', '261');
        $this->seedQuestions('garemo', 'გარემო მიკროკლიმატი მდგრადობა');
        $this->seedQuestions('kanoni', 'კანონი არქიტექტურული საქმიანობის შესახებ');
        $this->seedQuestions('kodexi', 'კოდექსი');
        $this->seedQuestions('konstruqciebi', 'კონსტრუქციები');
        $this->seedQuestions('sert', 'სერტიფიცირების წესი');

        $this->seedQuestionsUpdated1('10_1', '10 - ე დადგენილება');
        $this->seedQuestionsUpdated1('41_1', '41 - ე დადგენილება');
        $this->seedQuestionsUpdated1('41_3', '41 - ე დადგენილება');
        $this->seedQuestionsUpdated1('41_4', '41 - ე დადგენილება');
        $this->seedQuestionsUpdated1('41_5', '41 - ე დადგენილება');
        $this->seedQuestionsUpdated1('41_6', '41 - ე დადგენილება');
        $this->seedQuestionsUpdated1('41_7', '41 - ე დადგენილება');
        $this->seedQuestionsUpdated1('41_8', '41 - ე დადგენილება');
        $this->seedQuestionsUpdated1('41_9', '41 - ე დადგენილება');
    }

    public function seedQuestions($table_name, $group_title)
    {
        $questions = Helper::getBase('table_'.$table_name);
        foreach($questions as $question)
        {
            if($question->text == '')
            {
                continue;
            }
            if($question->type == 'QUESTION')
            {
                $text = preg_replace('/^[\d\·]\.\s*|^[\·]\s*[ა-ჰ]\)\s*/u', '', $question->text);
                if (strpos($text, 'კითხვა: ') !== false)
                {
                    $text = explode('კითხვა: ', $text)[1];
                }

                $group = Group::where('title', $group_title)->first();
    
                $group->questions()->create([
                    'text' => $text,
                    'q_id' => $question->q_id,
                ]);
            }
        }
    }

    public function seedQuestionsUpdated1($table_name, $group_title)
    {
        $questions = Helper::getBase('table_'.$table_name);
        foreach($questions as $question)
        {
            if($question->question == '')
            {
                continue;
            }
            if($question->type == 'QUESTION')
            {
                $text = preg_replace('/^[\d\·]\.\s*|^[\·]\s*[ა-ჰ]\)\s*/u', '', $question->question);
                if (strpos($text, 'კითხვა: ') !== false)
                {
                    $text = explode('კითხვა: ', $text)[1];
                }

                $group = Group::where('title', $group_title)->first();
    
                $group->questions()->create([
                    'text' => $text,
                    'q_id' => $question->q_id,
                ]);
            }
        }
    }
}
