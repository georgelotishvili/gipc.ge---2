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
        $this->seedQuestions('261', '261');
        $this->seedQuestions('garemo', 'გარემო მიკროკლიმატი მდგრადობა');
        $this->seedQuestions('kanoni', 'კანონი არქიტექტურული საქმიანობის შესახებ');
        $this->seedQuestions('kodexi', 'კოდექსი');
        $this->seedQuestions('konstruqciebi', 'კონსტრუქციები');
        $this->seedQuestions('sert', 'სერტიფიცირების წესი');
    }

    public function seedQuestions($table_name, $group_name)
    {
        $questions = Helper::getBase('table_'.$table_name);
        foreach($questions as $question)
        {
            if($question->type == 'QUESTION')
            {
                $text = preg_replace('/^[\d\·]\.\s*|^[\·]\s*[ა-ჰ]\)\s*/u', '', $question->text);

                $group = Group::where('name', $group_name)->first();
    
                $group->questions()->create([
                    'text' => $text,
                    'q_id' => $question->q_id,
                ]);
            }
        }
    }
}
