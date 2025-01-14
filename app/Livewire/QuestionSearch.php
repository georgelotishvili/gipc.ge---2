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
        $searchTerm = preg_quote($search, '/');
        $highlightedText = preg_replace("/($searchTerm)/i", '<span class="bg-yellow-200">$1</span>', $text);
        return $highlightedText;
    }

    public function render()
    {
        return view('livewire.question-search');
    }
}