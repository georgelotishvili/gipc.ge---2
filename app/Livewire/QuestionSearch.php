<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;

class QuestionSearch extends Component
{
    public $search = '';
    public $searchResults = [];

    public function updatedSearch()
    {
        $trimmedSearch = preg_replace('/\s+/', ' ', trim($this->search));
        
        if (strlen($trimmedSearch) >= 2) {
            $this->searchResults = Question::where('text', 'like', '%' . $trimmedSearch . '%')
                ->take(10)
                ->get();
        } else {
            $this->searchResults = [];
        }
    }


    public function highlightText($text, $search)
    {
        if (empty($search)) {
            return $text;
        }

        $searchTerm = preg_quote($search, '/');
        return preg_replace("/($searchTerm)/iu", '<span class="bg-red-500 text-white">$1</span>', $text);
    }

    public function render()
    {
        return view('livewire.question-search');
    }
}