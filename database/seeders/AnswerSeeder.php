<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Helper;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedAnswers('255', '255');
        $this->seedAnswers('256', '256');
        $this->seedAnswers('261', '261');
        $this->seedAnswers('garemo', 'გარემო მიკროკლიმატი მდგრადობა');
        $this->seedAnswers('kanoni', 'კანონი არქიტექტურული საქმიანობის შესახებ');
        $this->seedAnswers('kodexi', 'კოდექსი');
        $this->seedAnswers('konstruqciebi', 'კონსტრუქციები');
        $this->seedAnswers('sert', 'სერტიფიცირების წესი');
    }

    public function seedAnswers($table_name, $group_name)
    {
        $answers = Helper::getBase('table_'.$table_name);
        foreach($answers as $answer)
        {
            if($answer->type == 'ANSWER')
            {
                $text = preg_replace('/^[\d\·]\.\s*|^[\·]\s*[ა-ჰ]\)\s*/u', '', $answer->text);

                $question = Question::where('name', $group_name)->where('q_id', $answer->q_id)->first();
    
                $question->answers()->create([
                    'text' => $text,
                    'q_id' => $answer->q_id,
                    'is_true' => $answer->if_true,
                ]);
            }
        }
    }
}
